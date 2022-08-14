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
}
