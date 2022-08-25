<?php

namespace App\Http\Controllers;

use App\InvokeOutput;
use Illuminate\Http\Request;

class InvokeOutputController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function show(InvokeOutput $invokeOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(InvokeOutput $invokeOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvokeOutput $invokeOutput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvokeOutput $invokeOutput)
    {
        //
    }

    public function getInvokeOutputs($invokeId)
    {
        $result = (new InvokeOutput)->getInvokeOutputs($invokeId);
        return $result;
    }
}
