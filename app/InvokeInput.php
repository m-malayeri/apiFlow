<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvokeInput extends Model
{
    public function getInvokeInputs($invokeId)
    {
        $result = InvokeInput::where('invoke_id', $invokeId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
