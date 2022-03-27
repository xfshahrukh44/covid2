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

//auth
Route::group(['middleware' => ['api'], 'prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::put('update', 'AuthController@update');
});


//admin routes
Route::group(['middleware' => ['auth:api'], 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers'], function ($router) {
//    users
    Route::get('/users', 'UserController@index');
});

// user routes
Route::group(['prefix' => 'customer', 'namespace' => 'App\Http\Controllers'], function () {
    Route::post('/register', 'CustomerController@register');
    Route::post('/login', 'CustomerController@login');
    Route::get('/list', 'CustomerController@index');
    Route::put('/update/{id}', 'CustomerController@update_any');
    Route::get('/show/{id}', 'CustomerController@show');
});
