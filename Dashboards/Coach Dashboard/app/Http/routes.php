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

Route::get('/', ['middleware' => 'auth', function()
{
	return view('angularapp');
}]);

Route::get('/test', function()
{
	return view('index');
});

Route::group(['prefix' => 'api'], function()
{
	Route::resource('fmsforms', 'FMSFormController', ['only' => ['index', 'show', 'store']]);
});

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
