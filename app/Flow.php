<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    public static function getFlowId($flowName)
    {
        $result = Flow::where('flow_name', $flowName)->get('id');
        if (count($result) > 0)
            return $result[0]->id;
        else return null;
    }
}
