<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function () {
    Route::resource('tags',  'TagController');
    // Route::post('authenticate',  'AuthenticateController@authenticate');
    // Route::get('users',  'AuthenticateController@getUsers');
    // Route::get('logout',  'AuthenticateController@logout')->middleware('jwt.refresh');
});