<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FlowNodeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\InvokeInputController;
use App\Http\Controllers\InvokeOutputController;

use App\Flow;
use App\FlowNode;
use App\Invoke;
use App\InvokeInput;
use App\InvokeOutput;
use App\Property;
use App\Session;
use App\Action;
use App\Decision;
use Illuminate\Http\Request;

use DB;
use PDO;
use Carbon\Carbon;

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
        $sessionId = SessionController::store($request);

        // Get flow seq
        $flowId = Flow::getFlowId($flowName);
        $flowNodes = FlowNode::getFlowNodes($flowId);
        $decisionResult = "true";

        foreach ($flowNodes as $flowNode) {
            $nodeType = $flowNode->node_type;

            if ($nodeType == "Action" && $decisionResult == "true") {
                $actionDetails = Action::getActionDetails($flowNode->node_spec_id);

                if ($actionDetails->action_type == "Invoke") {
                    // Get invoke details
                    $invokeDetails = Invoke::getInvokeDetails($actionDetails->action_spec_id);
                    $invokeInputs = InvokeInput::getInvokeInputs($invokeDetails->id);

                    // Invoke
                    $invokeResults = $this->invoke($request, $invokeDetails, $invokeInputs);

                    // Log properties
                    Property::store($invokeResults, $sessionId, $flowNode->id);
                }
            } else if ($nodeType == "Decision" && $decisionResult == "true") {
                // Get decision details
                $decisionDetails = Decision::getDecisionDetails($flowNode->node_spec_id);
                $propertyDetails = Property::getPropertyDetails($decisionDetails->prop_name, $sessionId, $decisionDetails->flow_node_id);

                // Decide
                $decisionResult = $this->decide($propertyDetails, $decisionDetails);
            }
        }

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
            $flowResponse->ResponseDescription = "Unable to retrive latest action properties";
        }

        return response()->json($flowResponse);
    }

    public function invoke($request, $invokeDetails, $invokeInputs)
    {
        foreach ($invokeInputs as $invokeInput) {
            $inputType = $invokeInput->input_type;
            if ($inputType == "User") {
                $req["body"][$invokeInput->input_name] = $request[$invokeInput->api_input_name];
                //
            } else if ($inputType == "Literal") {
                $req["body"][$invokeInput->input_name] = $invokeInput->literal_value;
                //
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

        if (isset($invokeResults)) {
            return $invokeResults;
        } else {
            return null;
        }
    }

    public function decide($propertyDetails, $decisionDetails)
    {
        $successFlag = false;
        $decisionType = $decisionDetails->decision_type;
        switch ($decisionType) {
            case "Equal":
                if ($propertyDetails->property_value ==  $decisionDetails->prop_value)
                    $successFlag = true;
                break;
            case "Not Equal":
                if ($propertyDetails->property_value !=  $decisionDetails->prop_value)
                    $successFlag = true;
                break;
            case "Greater Than":
                if ($propertyDetails->property_value >  $decisionDetails->prop_value)
                    $successFlag = true;
                break;
            case "Less Than":
                if ($propertyDetails->property_value <  $decisionDetails->prop_value)
                    $successFlag = true;
                break;
        }
        return $successFlag;
    }
}
