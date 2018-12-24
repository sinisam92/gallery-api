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
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: PUT,GET,POST,DELETE,OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type, Accept,Origin');

Route::middleware('auth:api')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
	});

	Route::resource('galleries', GalleriesController::class)->except(['create', 'edit']);
});

Route::group([
	'prefix' => 'auth',
	'namespace' => 'Auth'
], function() {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
});


