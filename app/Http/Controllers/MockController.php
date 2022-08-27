<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockController extends Controller
{
    public function execute($apiName, Request $request)
    {
        $Response = new \stdClass();
        if ($apiName == "T1") {
            $Response->ResponseCode = "100";
            $Response->ResponseDescription = "Success1";
        } else if ($apiName == "T2") {
            $Response->ResponseCode = "200";
            $Response->ResponseDescription = "Success2";
        } else if ($apiName == "T3") {
            $Response->ResponseCode = "300";
            $Response->ResponseDescription = "Success3";
        } else {
            $Response->ResponseCode = "400";
            $Response->ResponseDescription = "Success4";
        }

        return response()->json($Response);
    }
}
