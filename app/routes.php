<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('profile', ['as' => 'profile', 'uses' => 'PagesController@profile'])->before('customAuth');

// Registration
Route::resource('users', 'UsersController', ['only' => ['index', 'create', 'store', 'destroy']]);

// Authentification
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy'] ]);
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

// Projections
Route::resource('projections', 'ProjectionsController', ['only' => ['index', 'create', 'store','show', 'destroy']]);

Route::get('projections/create', 'ProjectionsController@create')->before('role:administrator');

Route::resource('accessrequests', 'AccessRequestsController', ['only' => ['index', 'create', 'store','show', 'destroy']]);
Route::get('accessrequests/{accessrequests}/createUser', ['as' => 'accessrequests.createUser', 'uses' => 'AccessRequestsController@createUser']);

Route::get('/demo', function() {
    $user = User::first();
    $user = User::with('roles')->find(1);
    $role = Role::whereName('administrator')->first();

    return $user;
});