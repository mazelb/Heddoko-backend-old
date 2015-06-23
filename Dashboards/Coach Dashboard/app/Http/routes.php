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

Route::group(['prefix' => 'api'], function()
{
	Route::resource('teams', 'TeamController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('teams.athletes', 'TeamAthleteController', ['only' => ['index', 'show', 'store']]);
	Route::resource('athletes', 'AthleteController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('athletes.fmsforms', 'AthleteFMSFormController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('athletes.movements', 'AthleteMovementController', ['only' => ['index', 'show', 'store']]);
	Route::resource('sportcategories', 'SportCategoryController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('sportcategories.sportmovements', 'SportCategorySportMovementController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);	
});

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//@todo: lock this file down env file), wrt filesystem/web server config/perms (.htaccess)
//@todo: remove readme files (etc.). dont share more than you need to.
//@todo database table can only readonly and insert. or maybe only read views.
//@todo: must keep laravel up-to-date, get on mailing list for laravel
//@todo: ssl? GAE
//@todo: sessionid/token to ensure current user belongs to current sessions (laravel equiv.)