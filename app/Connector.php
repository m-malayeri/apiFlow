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
}
