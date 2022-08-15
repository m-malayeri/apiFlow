<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    public function store($data)
    {
        ApiLog::insert($data);
        return ApiLog::get()->last();
    }

    public function updateLog($id, $reqTimestamp, $flowResponse)
    {
        $duration = now()->diffInMilliSeconds($reqTimestamp);
        ApiLog::where('id', $id)->update(['rsp_timestamp' => now(), 'duration' => $duration, 'rsp' => $flowResponse]);
    }
}
