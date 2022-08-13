<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlowNode extends Model
{
    public static function getFlowNodes($flowId)
    {
        $result = DB::table('flow_nodes')->where('flow_id', $flowId)->orderBy('node_seq', 'ASC')->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }

    public static function getLastNodeId($flowId, $nodeType)
    {
        $result = DB::table('flow_nodes')->where(['flow_id' => $flowId, 'node_type' => $nodeType])->max('node_seq');
        return $result;
    }
}
