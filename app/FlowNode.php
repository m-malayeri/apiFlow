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

    public function getLastNodeId($flowId, $nodeType)
    {
        $result = FlowNode::where(['flow_id' => $flowId, 'node_type' => $nodeType])->max('node_seq');
        return $result;
    }

    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'node_type' => $request->input('node_type'),
            'node_seq' => $request->input('node_seq'),
            'node_spec_id' => $request->input('node_spec_id'),
            'created_at' => now(),
            'updated_at' => now()
        );
        FlowNode::insert($array);
        $flowNodeId = FlowNode::get()->last()->id;
        return $flowNodeId;
    }
}
