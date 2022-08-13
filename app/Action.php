<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Action extends Model
{
    public static function getActionDetails($actionId)
    {
        $result = DB::table('actions')->where('id', $actionId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }
}
