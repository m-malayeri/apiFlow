<?php

namespace App\Http\Controllers;

use App\Invoke;
use Illuminate\Http\Request;

class InvokeController extends Controller
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
    public function store(Request $request)
    {
        $invokeId = (new Invoke)->store($request);
        return redirect(url()->previous())->withMessage('Invoke record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function show(Invoke $invoke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoke $invoke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoke $invoke)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoke $invoke)
    {
        //
    }

    public function getInvokeDetails($flowId, $flowNodeId)
    {
        $result = (new Invoke)->getInvokeDetails($flowId, $flowNodeId);
        return $result;
    }

    public function getFlowInvokes($flowId)
    {
        $result = (new Invoke)->getFlowInvokes($flowId);
        return $result;
    }
}
