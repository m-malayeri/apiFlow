<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FlowNodeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\InvokeInputController;
use App\Http\Controllers\ApiLogController;

use App\Flow;
use Illuminate\Http\Request;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function show(Flow $flow)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function edit(Flow $flow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flow $flow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flow $flow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function execute($flowName, Request $request)
    {
        // Log session
        $sessionId = (new SessionController)->store($request);

        // Log REQ
        $apiLog = (new ApiLogController)->store($request, $sessionId);

        // Get flow seq
        $flowId = (new Flow)->getFlowId($flowName);
        $flowNodes = (new FlowNodeController)->getFlowNodes($flowId);
        $decisionResult = "true";

        foreach ($flowNodes as $flowNode) {
            $nodeType = $flowNode->node_type;
            if ($nodeType == "Action" && $decisionResult == "true") {
                $actionDetails = (new ActionController)->getActionDetails($flowNode->node_spec_id);

                if ($actionDetails->action_type == "Invoke") {
                    // Get invoke details
                    $invokeDetails = (new InvokeController)->getInvokeDetails($actionDetails->action_spec_id);
                    $invokeInputs = (new InvokeInputController)->getInvokeInputs($invokeDetails->id);

                    // Invoke
                    $invokeResults = $this->invoke($request, $invokeDetails, $invokeInputs);

                    // Log properties
                    (new PropertyController)->store($invokeResults, $sessionId, $flowNode->id);
                }
            } else if ($nodeType == "Decision" && $decisionResult == "true") {
                // Get decision details
                $decisionDetails = (new DecisionController)->getDecisionDetails($flowNode->node_spec_id);
                $propertyDetails = (new PropertyController)->getPropertyDetails($decisionDetails->prop_name, $sessionId, $decisionDetails->flow_node_id);

                // Decide
                $decisionResult = $this->decide($propertyDetails, $decisionDetails);
            }
        }

        // Calculate flow response code and append last action result into main response
        $flowResponse = new \stdClass();
        if (isset($invokeResults)) {
            $invokeResults = json_decode($invokeResults);
            $flowResponse->ResponseCode = "";
            $flowResponse->ResponseDescription = "";
            $flowResponse->LastActionResult = $invokeResults;
            if ($decisionResult == true) {
                $flowResponse->ResponseCode = "0";
                $flowResponse->ResponseDescription = "Flow execution completed successfully";
            } else {
                $flowResponse->ResponseCode = "-100";
                $flowResponse->ResponseDescription = "Flow execution failed";
            }
        } else {
            $flowResponse->ResponseCode = "-101";
            $flowResponse->ResponseDescription = "Unable to fetch latest action properties";
        }

        // Destroy session and properties
        (new SessionController)->destroy($sessionId);
        (new PropertyController)->destroy($sessionId);

        // Update RSP and calculate duration
        (new ApiLogController)->update($apiLog, $flowResponse);

        return response()->json($flowResponse);
    }

    public function invoke($request, $invokeDetails, $invokeInputs)
    {
        foreach ($invokeInputs as $invokeInput) {
            $inputType = $invokeInput->input_type;
            $parentObject = $invokeDetails->req_parent_object;

            if ($inputType == "User") {
                if ($parentObject != "")
                    $req[$parentObject][$invokeInput->input_name] = $request[$invokeInput->api_input_name];
                else
                    $req[$invokeInput->input_name] = $request[$invokeInput->api_input_name];
            } else if ($inputType == "Literal") {
                if ($parentObject != "")
                    $req[$parentObject][$invokeInput->input_name] = $invokeInput->literal_value;
                else
                    $req[$invokeInput->input_name] = $invokeInput->literal_value;
            }
        }

        $req = json_encode($req);
        $auth = $invokeDetails->user . ":" . $invokeDetails->password;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $invokeDetails->url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:' . $invokeDetails->content_type));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $invokeResults = curl_exec($ch);
        curl_close($ch);

        if (isset($invokeResults))
            return $invokeResults;
        else
            return null;
    }

    public function decide($propertyDetails, $decisionDetails)
    {
        $successFlag = false;
        if (isset($propertyDetails) && isset($decisionDetails)) {
            $decisionType = $decisionDetails->decision_type;
            $decisionValue = $decisionDetails->prop_value;
            $propertyValue = $propertyDetails->property_value;
            switch ($decisionType) {
                case "Equal":
                    if ($propertyValue ==  $decisionValue)
                        $successFlag = true;
                    break;
                case "Not Equal":
                    if ($propertyValue !=  $decisionValue)
                        $successFlag = true;
                    break;
                case "Greater Than":
                    if ($propertyValue >  $decisionValue)
                        $successFlag = true;
                    break;
                case "Less Than":
                    if ($propertyValue <  $decisionValue)
                        $successFlag = true;
                    break;
            }
        }
        return $successFlag;
    }
}
