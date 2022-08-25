<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FlowNodeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\InvokeInputController;
use App\Http\Controllers\ApiLogController;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getHomeData()
    {
        // Query all home date 
        $flows = (new FlowController)->getAllFlows();
        $sessions = (new SessionController)->getAllSessions();
        $logs = (new ApiLogController)->getAllLogs();

        return view('welcome')->with(compact('flows', 'sessions', 'logs'));
    }

    public function getFlowData($flowId)
    {
        if (isset($flowId)) {
            $flowDetails = (new FlowController)->getFlowDetailsById($flowId);
            if ($flowDetails === null) {
                return redirect(url('/'));
            } else {
                $flowNodes = (new FlowNodeController)->getFlowNodes($flowId);
                $maxSeq = count($flowNodes);

                $invokes = (new InvokeController)->getFlowInvokes($flowId);
                $decisions = (new DecisionController)->getFlowDecisions($flowId);

                return view('nodes')->with(compact('flowDetails', 'flowNodes', 'maxSeq', 'invokes', 'decisions'));
            }
        } else {
            return view('welcome');
        }
    }

    public function redirect()
    {
        return redirect(url('/'));
    }

    public function execute($flowName, Request $request)
    {
        // Prepare final flow response
        $flowResponse = new \stdClass();
        $flowResponse->ResponseCode = "";
        $flowResponse->ResponseDescription = "";

        // Log session
        $sessionId = (new SessionController)->store($request);

        // Log REQ
        $apiLog = (new ApiLogController)->store($request, $sessionId);

        // Get flow seq
        $flowDetails = (new FlowController)->getFlowDetailsByName($flowName);

        if ($flowDetails === null) {
            $flowResponse->ResponseCode = "-120";
            $flowResponse->ResponseDescription = "Flow not found, please check flow name";
        } else {
            if ($flowDetails->status == "Enabled") {
                $flowNodes = (new FlowNodeController)->getFlowNodes($flowDetails->id);
                $decisionResult = true;
                $end = false;
                $currentNodeId = (new FlowNodeController)->getFirstNodeId($flowDetails->id);
                $lastNodeId = (new FlowNodeController)->getLastNodeId($flowDetails->id);

                while ($end == false && $currentNodeId <= $lastNodeId) {
                    $flowNode = $flowNodes->where('id', $currentNodeId)->first();
                    $nodeType = $flowNode->node_type;
                    $nodeSubType = $flowNode->sub_type;

                    if ($nodeType == "Action" && $decisionResult == true) {
                        if ($nodeSubType == "Invoke") {
                            // Get invoke details
                            $invokeDetails = (new InvokeController)->getInvokeDetails($flowDetails->id, $flowNode->id);
                            $invokeInputs = (new InvokeInputController)->getInvokeInputs($invokeDetails->id);
                            $invokeOutputs = (new InvokeOutputController)->getInvokeOutputs($invokeDetails->id);

                            // Invoke
                            $invokeResults = $this->invoke($request, $invokeDetails, $invokeInputs);

                            // Log properties
                            (new PropertyController)->store($invokeResults, $invokeOutputs, $sessionId);

                            $currentNodeId += 1;
                        }
                    } else if ($nodeType == "Decision" && $decisionResult == true) {
                        // Get decision details
                        $decisionDetails = (new DecisionController)->getDecisionDetails($flowNode->id);
                        $propertyDetails = (new PropertyController)->getPropertyDetails($decisionDetails->prop_name, $sessionId);

                        // Decide and find next node id
                        $decisionResult = $this->decide($propertyDetails, $decisionDetails);

                        if ($decisionResult == true) {
                            $currentNodeId = $decisionDetails->next_node_id;
                        } else {
                            $end = true;
                        }
                    }
                }

                // Decide flow response code and append last action result into main response
                if (isset($invokeResults)) {
                    $invokeResults = json_decode($invokeResults);
                    $flowResponse->LastActionResult = $invokeResults;
                    if ($decisionResult == true) {
                        $flowResponse->ResponseCode = "0";
                        $flowResponse->ResponseDescription = "Flow execution completed successfully";
                    } else {
                        $flowResponse->ResponseCode = "-100";
                        $flowResponse->ResponseDescription = "Flow execution failed";
                    }
                } else {
                    $flowResponse->ResponseCode = "-110";
                    $flowResponse->ResponseDescription = "Unable to fetch latest action properties";
                }

                // Clear sessions and properties based on flow config.
                if ($flowDetails->log_level == "Property") {
                    (new SessionController)->destroy($sessionId);
                } else if ($flowDetails->log_level == "Session") {
                    (new PropertyController)->destroy($sessionId);
                } else if ($flowDetails->log_level == "None") {
                    (new SessionController)->destroy($sessionId);
                    (new PropertyController)->destroy($sessionId);
                }

                // Update RSP and calculate duration
                (new ApiLogController)->update($apiLog, $flowResponse);
            } else {
                $flowResponse->ResponseCode = "-115";
                $flowResponse->ResponseDescription = "Flow is disabled, please enable it via GUI";
            }
        }
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
