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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>'login'],function(){
    Route::post('login','API\LoginController@login');
});

Route::group(['middleware'=>'api_auth'],function(){
    Route::group(['prefix'=>'user'],function(){
        Route::post('get','API\User\UserController@get');
        Route::post('simpan','API\User\UserController@simpan');
        Route::post('hapus','API\User\UserController@hapus');
    });
});
