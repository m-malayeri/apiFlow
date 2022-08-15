<?php

namespace App\Http\Controllers;

use App\ApiLog;
use Illuminate\Http\Request;

class ApiLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request, $sessionId)
    {
        $body = $request->getContent();

        $data = json_decode(json_encode($body), true);

        $array = array(
            'session_id' => $sessionId,
            'endpoint' => $request->path(),
            'req_timestamp' => now(),
            'rsp_timestamp' => "",
            'duration' => 0,
            'req' => $data,
            'rsp' => "",
            'created_at' => now(),
            'updated_at' => now(),
        );

        $result = (new ApiLog)->store($array);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ApiLog  $ApiLog
     * @return \Illuminate\Http\Response
     */
    public function show(APILog $aPILog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApiLog  $ApiLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiLog $ApiLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApiLog  $ApiLog
     * @return \Illuminate\Http\Response
     */
    public function update($apiLog, $flowResponse)
    {
        $flowResponse = json_encode($flowResponse);
        (new ApiLog)->updateLog($apiLog->id, $apiLog->req_timestamp, $flowResponse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApiLog  $ApiLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiLog $ApiLog)
    {
        //
    }
}
