<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    public function getNextNodeId($flowNodeId, $nodeType)
    {
        $result = Connector::where(['src_id' => $flowNodeId, 'src_type' => $nodeType])->first();
        if (count($result) > 0)
            return $result;
        else return null;
    }

    public function getFlowConnectors($flowId)
    {
        $result = Connector::where('flow_id', $flowId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }

    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'src_type' => $request->input('src_type'),
            'src_id' => $request->input('src_id'),
            'target_type' => $request->input('target_type'),
            'target_id' => $request->input('target_id'),
            'created_at' => now(),
            'updated_at' => now()
        );
        Connector::insert($array);
        $connectorId = Connector::get()->last()->id;
        return $connectorId;
    }
}
