<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'propertys';

    public function store($array)
    {
        Property::insert($array);
        return "true";
    }

    public function getPropertyDetails($propertyName, $sessionId)
    {
        $result = Property::where(['property_name' => $propertyName, 'session_id' => $sessionId])->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }

    public function getFlowProperties($sessionId, $lastActionId)
    {
        $result = Property::where(['session_id' => $sessionId, 'flow_node_id' => $lastActionId])->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
