<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    public function getDecisionDetails($decisionId)
    {
        $result = Decision::where('id', $decisionId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }

    public function getFlowDecisions($flowId)
    {
        $result = Decision::where('flow_id', $flowId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }

    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'decision_name' => $request->input('decision_name'),
            'flow_node_id' => $request->input('flow_node_id'),
            'prop_name' => $request->input('prop_name'),
            'decision_type' => $request->input('decision_type'),
            'prop_value' => $request->input('prop_value'),
            'created_at' => now(),
            'updated_at' => now()
        );
        Decision::insert($array);
        $decisionId = Decision::get()->last()->id;
        return $decisionId;
    }
}
