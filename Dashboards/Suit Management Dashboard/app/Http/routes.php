<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('suits-editor');
});

Route::resource('suits', 'SuitController', ['only' => ['index', 'store', 'update', 'destroy']]);
Route::resource('sensortypes', 'SensorTypeController', ['only' => ['index']]);
Route::resource('anatomicalpositions', 'AnatomicalPositionController', ['only' => ['index']]);
