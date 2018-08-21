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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',['as'=>'index','uses'=>'EnableDeviceController@index']);
Route::post('/',['as'=>'enable','uses'=>'EnableDeviceController@enable']);
Route::get('/configure',['middleware'=>'enable.lock','as'=>'configure','uses'=>'ConfigureController@configure']);
