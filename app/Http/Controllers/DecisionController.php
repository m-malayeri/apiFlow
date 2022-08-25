<?php

namespace App\Http\Controllers;

use App\Decision;
use Illuminate\Http\Request;

class DecisionController extends Controller
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
        $decisionId = (new Decision)->store($request);
        return redirect(url()->previous())->withMessage('Decision record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function show(Decision $decision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function edit(Decision $decision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Decision $decision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function destroy($decisionId)
    {
        $user = (new Decision)->where('id', $decisionId)->firstorfail()->delete();
        return redirect(url()->previous())->withMessage('Decision record deleted successfully');
    }

    public function getDecisionDetails($decisionId)
    {
        $result = (new Decision)->getDecisionDetails($decisionId);
        return $result;
    }

    public function getFlowDecisions($flowId)
    {
        $result = (new Decision)->getFlowDecisions($flowId);
        return $result;
    }
}
