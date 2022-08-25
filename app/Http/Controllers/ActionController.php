<?php

namespace App\Http\Controllers;

use App\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
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
        $actionId = (new Action)->store($request);
        return redirect(url()->previous())->withMessage('Action record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy($actionId)
    {
        $user = (new Action)->where('id', $actionId)->firstorfail()->delete();
        return redirect(url()->previous())->withMessage('Action record deleted successfully');
    }

    public function getActionDetails($actionId)
    {
        $result = (new Action)->getActionDetails($actionId);
        return $result;
    }

    public function getNodeActions($nodeId)
    {
        $result = (new Action)->getNodeActions($nodeId);
        return $result;
    }

    public function getFlowActions($flowId)
    {
        $result = (new Action)->getFlowActions($flowId);
        return $result;
    }
}
