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
			return redirect('/')->withError('Duplicate record is not allowed, please try again with another name');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Flow  $flow
	 * @return \Illuminate\Http\Response
	 */
	public function show($flowId)
	{
		$flowDetails = (new Flow)->show($flowId);
		return view('nodes')->with(compact('flowDetails'));
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
	public function destroy($flowId)
	{
		$user = (new Flow)->where('id', $flowId)->firstorfail()->delete();
		return redirect(url()->previous())->withMessage('Record deleted successfully');
	}

	public function getFlowDetailsByName($flowName)
	{
		$result = (new Flow)->getFlowDetailsByName($flowName);
		return $result;
	}

	public function getFlowDetailsById($flowId)
	{
		$result = (new Flow)->getFlowDetailsById($flowId);
		return $result[0];
	}

	public function getAllFlows()
	{
		$result = (new Flow)->getAllFlows();
		return $result;
	}

	public function disable($flowId)
	{
		(new Flow)->disable($flowId);
		return redirect('/')->withMessage('Record updated successfully');
	}

	public function enable($flowId)
	{
		(new Flow)->enable($flowId);
		return redirect('/')->withMessage('Record updated successfully');
	}
}
