<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Property extends Model
{
    public static function store($invokeResults, $sessionId, $flowNodeId)
    {
        foreach (json_decode($invokeResults) as $propName => $propValue) {
            $array = array(
                'session_id' => $sessionId,
                'flow_node_id' => $flowNodeId,
                'property_name' => $propName,
                'property_value' => $propValue,
                'created_at' => now()
            );
            DB::table('propertys')->insert($array);
        }
    }

    public static function getPropertyDetails($propertyName, $sessionId, $flowNodeId)
    {
        $result = DB::table('propertys')->where(
            ['property_name' => $propertyName, 'session_id' => $sessionId, 'flow_node_id' => $flowNodeId]
        )->get();

        if (count($result) > 0)
            return $result[0];
        else return null;
    }

    public static function getFlowProperties($sessionId, $lastActionId)
    {
        $result = DB::table('propertys')->where(['session_id' => $sessionId, 'flow_node_id' => $lastActionId])->get();

        if (count($result) > 0)
            return $result;
        else return null;
    }
}
