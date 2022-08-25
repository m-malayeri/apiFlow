<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoke extends Model
{
    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'flow_node_id' => $request->input('flow_node_id'),
            'url' => $request->input('url'),
            'method' => $request->input('method'),
            'content_type' => $request->input('content_type'),
            'auth_type' => $request->input('auth_type'),
            'user' => $request->input('user'),
            'password' => $request->input('password'),
            'req_parent_object' => $request->input('req_parent_object'),
            'created_at' => now(),
            'updated_at' => now()
        );
        Action::insert($array);
        $invokeId = Invoke::get()->last()->id;
        return $invokeId;
    }

    public function getInvokeDetails($flowId, $flowNodeId)
    {
        $result = Invoke::where(['flow_id' => $flowId, 'flow_node_id' => $flowNodeId])->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }

    public function getFlowInvokes($flowId)
    {
        $result = Invoke::where('flow_id', $flowId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
