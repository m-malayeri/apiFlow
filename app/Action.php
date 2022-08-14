<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public static function getActionDetails($actionId)
    {
        $result = Action::where('id', $actionId)->get();
        if (count($result) > 0)
            return $result[0];
        else return null;
    }
}
