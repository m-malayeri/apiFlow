<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvokeOutput extends Model
{
    public function getInvokeOutputs($invokeId)
    {
        $result = InvokeOutput::where('invoke_id', $invokeId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }

    public function getFlowInvokeOutputs($flowId)
    {
        $result = InvokeOutput::where('flow_id', $flowId)->get();
        if (count($result) > 0)
            return $result;
        else return null;
    }
}
