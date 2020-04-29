<?php

use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'file'], function ($router) {
    Route::get('/list/files', 'FileController@files')->middleware(["auth:api"]);
    Route::get('/list/directories', 'FileController@directories')->middleware(["auth:api"]);
    Route::post('/create/file', 'FileController@create')->middleware(["auth:api"]);
    Route::post('/create/directory', 'FileController@createDirectory')->middleware(["auth:api"]);
});

Route::group(['prefix' => 'ps'], function ($router) {
    Route::get('/', 'ProcessController@index')->middleware(["auth:api"]);
});
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout')->middleware(["auth:api"]);
    Route::post('refresh', 'AuthController@refresh')->middleware(["auth:api"]);
    Route::get('me', 'AuthController@me')->middleware(["auth:api"]);

});
