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

Route::post('galleries/{id}/comments', 'CommentsController@store');
Route::delete('comments/{id}', 'CommentsController@destroy');
Route::get('author-galleries/{id}', 'AuthorsGalleriesController@index');
Route::post('galleries', 'GalleriesController@store');
Route::get('galleries', 'GalleriesController@index');
Route::get('galleries/{id}', 'GalleriesController@show');
Route::put('galleries/{id}', 'GalleriesController@update');
Route::delete('galleries/{id}', 'GalleriesController@destroy');

// Route::resource('galleries', 'GalleriesController')->except(['create']);

Route::get('authors-galleries/{id}', 'AuthorsGalleriesController@index');

Route::group([
	'prefix' => 'auth',
	'namespace' => 'Auth'
], function() {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
	Route::get('logout', 'AuthController@logout');
});


