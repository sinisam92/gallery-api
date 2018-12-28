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
Route::resource('galleries', 'GalleriesController')->except(['create']);

Route::get('authors-galleries/{id}', 'AuthorsGalleriesController@index');

// Route::middleware('auth:api')->group(function(){

//     Route::get('/user', function (Request $request) {
//         return $request->user();
// 	});

// });
Route::group([
	'prefix' => 'auth',
	'namespace' => 'Auth'
], function() {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
});


