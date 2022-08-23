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
}
