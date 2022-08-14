<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    public function store($data)
    {
        ApiLog::insert($data);
        return ApiLog::get()->last()->id;
    }

    public function updateLog($logId, $flowResponse)
    {
        ApiLog::where('id', $logId)->update(['rsp_timestamp' => now(), 'rsp' => $flowResponse]);
    }
}
