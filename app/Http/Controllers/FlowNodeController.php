<?php

namespace App\Http\Controllers;

use App\FlowNode;
use Illuminate\Http\Request;

class FlowNodeController extends Controller
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
        $flowNodeId = (new FlowNode)->store($request);
        return redirect(url()->previous())->withMessage('Node record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function show(FlowNode $flowNode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowNode $flowNode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowNode $flowNode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function destroy($flowNodeId)
    {
        $user = (new FlowNode)->where('id', $flowNodeId)->firstorfail()->delete();
        return redirect(url()->previous())->withMessage('Node record deleted successfully');
    }

    public function getFlowNodes($flowId)
    {
        $result = (new FlowNode)->getFlowNodes($flowId);
        return $result;
    }

    public function getFirstNodeId($flowId)
    {
        $result = (new FlowNode)->getFirstNodeId($flowId);
        return $result;
    }

    public function getLastNodeId($flowId)
    {
        $result = (new FlowNode)->getLastNodeId($flowId);
        return $result;
    }
}
