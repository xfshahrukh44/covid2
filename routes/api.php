<?php

use Illuminate\Http\Request;
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
header('Access-Control-Allow-Origin', "*");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// admin routes
Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin'], function ($router) {
//    entry
    Route::post('login', 'AdminController@login');
    Route::post('register', 'AdminController@register');

    Route::group(['middleware' => ['admin_api']], function ($router) {
//        auth
        Route::post('logout', 'AdminController@logout');
        Route::post('refresh', 'AdminController@refresh');
        Route::get('me', 'AdminController@me');
        Route::put('update', 'AdminController@update');

//        users
        Route::get('/', 'AdminController@index');
        Route::post('/', 'AdminController@store');
        Route::get('/{id}', 'AdminController@show');
        Route::put('/{id}', 'AdminController@update');
        Route::delete('/{id}', 'AdminController@destroy');

    });
});

// user routes
Route::group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers'], function () {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::get('/list', 'UserController@index');
    Route::put('/update', 'UserController@update_any');
    Route::get('/show/{id}', 'UserController@show');
});
