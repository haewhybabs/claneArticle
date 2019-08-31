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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','UserAuthentication@register')->name('register');
Route::post('login','UserAuthentication@login');
Route::get('login','UserAuthentication@unAuthorized')->name('login');


Route::middleware('auth:api')->group(function () {
    Route::get('user', 'UserAuthentication@details');
    Route::post('articles','Article@create');
    Route::put('articles/{id}','Article@update');
    Route::delete('articles/{id}','Article@delete');

});

Route::get('articles','Article@list');
Route::get('articles/{id}','Article@get');
Route::post('articles/{id}/rating','RateArticle@rating');
Route::get('search/articles','Article@search');
