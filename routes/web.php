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

/*
Route::get('/', function () {
    return view('welcome');
});
*/