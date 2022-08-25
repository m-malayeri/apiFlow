<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowNode extends Model
{
    public function getFlowNodes($flowId)
    {
        $result = FlowNode::where('flow_id', $flowId)->orderBy('node_seq', 'ASC')->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }

    public function getLastNodeId($flowId)
    {
        $result = FlowNode::where(['flow_id' => $flowId])->orderBy('node_seq', 'DESC')->first()->id;
        return $result;
    }

    public function getFirstNodeId($flowId)
    {
        $result = FlowNode::where(['flow_id' => $flowId])->orderBy('node_seq', 'ASC')->first()->id;
        return $result;
    }

    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'node_name' => $request->input('node_name'),
            'node_type' => $request->input('node_type'),
            'sub_type' => $request->input('sub_type'),
            'node_seq' => $request->input('node_seq'),
            'created_at' => now(),
            'updated_at' => now()
        );
        FlowNode::insert($array);
        $flowNodeId = FlowNode::get()->last()->id;
        return $flowNodeId;
    }
}
