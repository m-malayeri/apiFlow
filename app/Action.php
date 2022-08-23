<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public function getActionDetails($actionId)
    {
        $result = Action::where('id', $actionId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }

    public function getFlowActions($flowId)
    {
        $result = Action::where('flow_id', $flowId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
