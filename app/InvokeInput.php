<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class InvokeInput extends Model
{
    public static function getInvokeInputs($invokeId)
    {
        $result = DB::table('invoke_inputs')->where('invoke_id', $invokeId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
