<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    public function getFlowId($flowName)
    {
        $result = Flow::where('flow_name', $flowName)->get('id');
        if (count($result) > 0)
            return $result[0]->id;
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
            'created_at' => now(),
            'updated_at' => now()
        );

        $result = Flow::where('flow_name', $request->input('flow_name'))->get('id');
        if (isset($result)) {
            Flow::insert($array);
            $flowId = Flow::get()->last()->id;
            return $flowId;
        } else {
            return false;
        }
    }
}
