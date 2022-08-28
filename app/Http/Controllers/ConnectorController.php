<?php

namespace App\Http\Controllers;

use App\Connector;
use Illuminate\Http\Request;

class ConnectorController extends Controller
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
        $connectorId = (new Connector)->store($request);
        return redirect(url()->previous())->withMessage('Connector record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function show(Connector $connector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function edit(Connector $connector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Connector $connector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function destroy($connectorId)
    {
        $user = (new Connector)->where('id', $connectorId)->firstorfail()->delete();
        return redirect(url()->previous())->withMessage('Connector record deleted successfully');
    }

    public function getNextNodeId($flowNodeId, $nodeType)
    {
        $result = (new Connector)->getNextNodeId($flowNodeId, $nodeType);
        return $result;
    }

    public function getFlowConnectors($flowId)
    {
        $result = (new Connector)->getFlowConnectors($flowId);
        return $result;
    }
}
