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

Route::get('equipment/search', 'EquipmentController@search');
Route::get('suitsequipment/search', 'SuitEquipmentController@search');
Route::resource('suitsequipment', 'SuitEquipmentController', ['only' => ['index', 'store', 'update', 'destroy']]);
Route::resource('equipment', 'EquipmentController', ['only' => ['index', 'store']]);
Route::resource('statuses', 'StatusController', ['only' => ['index']]);
Route::resource('materials', 'MaterialController', ['only' => ['index']]);
Route::resource('anatomicalpositions', 'AnatomicalPositionController', ['only' => ['index']]);
