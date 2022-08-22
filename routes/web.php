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
Route::post('node', array('uses' => 'FlowNodeController@store'));
Route::get('node/delete/{flowId}', array('uses' => 'FlowNodeController@destroy'));

/*
Route::get('/', function () {
    return view('welcome');
});
*/