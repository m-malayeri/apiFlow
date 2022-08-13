<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invoke extends Model
{
    public static function getInvokeDetails($invokeId)
    {
        $result = DB::table('invokes')->where('id', $invokeId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }
}
