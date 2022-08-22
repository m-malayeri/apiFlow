<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    public function getFlowDetails($flowName)
    {
        $result = Flow::where('flow_name', $flowName)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }

    public function getAllFlows()
    {
        // Query all flows 
        $result = Flow::get();
        return $result;
    }
    public function store($request)
    {
        $array = array(
            'flow_name' => $request->input('flow_name'),
            'status' => "Enabled",
            'log_level' => $request->input('log_level'),
            'created_at' => now(),
            'updated_at' => now()
        );

        $result = Flow::where('flow_name', $request->input('flow_name'))->get('id');
        if (count($result) == 0) {
            Flow::insert($array);
            $flowId = Flow::get()->last()->id;
            return $flowId;
        } else {
            return null;
        }
    }

    public function disable($flowId)
    {
        Flow::where('id', $flowId)->update(['status' => "Disabled"]);
    }

    public function enable($flowId)
    {
        Flow::where('id', $flowId)->update(['status' => "Enabled"]);
    }

    public function show($flowId)
    {
        $result = Flow::where('id', $flowId)->get();
        if (count($result) == 1)
            return $result;
        else return null;
    }
}
