<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Decision extends Model
{
    public static function getDecisionDetails($decisionId)
    {
        $result = DB::table('decisions')->where('id', $decisionId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }
}
