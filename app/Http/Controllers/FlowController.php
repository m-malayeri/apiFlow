<?php

namespace App\Http\Controllers;

use App\Flow;
use Illuminate\Http\Request;

class FlowController extends Controller
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
		$flowId = (new Flow)->store($request);
		if (isset($flowId)) {
			return redirect('/')->withMessage('Record inserted successfully');
		} else {
			return redirect('/')->withError('Record inserted failed, please try again');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Flow  $flow
	 * @return \Illuminate\Http\Response
	 */
	public function show(Flow $flow)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Flow  $flow
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Flow $flow)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Flow  $flow
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Flow $flow)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Flow  $flow
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Flow $flow)
	{
		//
	}

	public function getFlowId($flowName)
	{
		$result = (new Flow)->getFlowId($flowName);
		return $result;
	}

	public function getAllFlows()
	{
		$result = (new Flow)->getAllFlows();
		return $result;
	}
}
