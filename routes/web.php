<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', array('uses' => 'MainController@getHomeData'));
Route::any('execute/{flowName}', array('uses' => 'MainController@execute'));

Route::post('flow', array('uses' => 'FlowController@store'));
Route::get('flow/show/{flowId}', array('uses' => 'FlowController@show'));
Route::get('flow/disable/{flowId}', array('uses' => 'FlowController@disable'));
Route::get('flow/enable/{flowId}', array('uses' => 'FlowController@enable'));
Route::get('flow/delete/{flowId}', array('uses' => 'FlowController@destroy'));

Route::get('node/{flowId}', array('uses' => 'MainController@getFlowData'));
Route::get('node', array('uses' => 'MainController@redirect'));
Route::post('node', array('uses' => 'FlowNodeController@store'));
Route::get('node/delete/{flowId}', array('uses' => 'FlowNodeController@destroy'));

Route::post('action', array('uses' => 'ActionController@store'));
Route::get('action/delete/{actionId}', array('uses' => 'ActionController@destroy'));

Route::post('invoke', array('uses' => 'InvokeController@store'));
Route::get('invoke/delete/{invokeId}', array('uses' => 'InvokeController@destroy'));

Route::post('decision', array('uses' => 'DecisionController@store'));
Route::get('decision/delete/{decisionId}', array('uses' => 'DecisionController@destroy'));

Route::post('connector', array('uses' => 'ConnectorController@store'));
Route::get('connector/delete/{connectorId}', array('uses' => 'ConnectorController@destroy'));

Route::any('mock/{apiName}', array('uses' => 'MockController@execute'));
