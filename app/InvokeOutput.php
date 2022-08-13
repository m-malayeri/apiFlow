<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class InvokeOutput extends Model
{
    public static function getInvokeOutputs($invokeId)
    {
        $result = DB::table('invoke_outputs')->where('invoke_id', $invokeId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
