<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoke extends Model
{
    public function getInvokeDetails($invokeId)
    {
        $result = Invoke::where('id', $invokeId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }
}
