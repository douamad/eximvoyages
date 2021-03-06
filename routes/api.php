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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');
Route::group(['middleware'=>'api'], function (){
    Route::get('/articles', 'ArticleApiController@index');
    Route::delete('/articles/{id}', 'ArticleApiController@destroy');
    Route::put('/articles/{id}', 'ArticleApiController@update');
    Route::post('/articles', 'ArticleApiController@store');

});