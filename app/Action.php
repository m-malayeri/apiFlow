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
    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'action_name' => $request->input('action_name'),
            'action_type' => $request->input('action_type'),
            'action_spec_id' => $request->input('action_spec_id'),
            'created_at' => now(),
            'updated_at' => now()
        );
        Action::insert($array);
        $actionId = Action::get()->last()->id;
        return $actionId;
    }
}
