<?php

namespace App\Http\Controllers;

use App\InvokeInput;
use Illuminate\Http\Request;

class InvokeInputController extends Controller
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
     * @param  \App\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function show(InvokeInput $invokeInput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function edit(InvokeInput $invokeInput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvokeInput $invokeInput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvokeInput $invokeInput)
    {
        //
    }

    public function getInvokeInputs($invokeId)
    {
        $result = (new InvokeInput)->getInvokeInputs($invokeId);
        return $result;
    }
}
