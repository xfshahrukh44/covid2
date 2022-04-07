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
if (App::environment('production')) {
    URL::forceScheme('https');
}
header('Access-Control-Allow-Origin', "*");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'public', 'middleware' => 'cors'], function ($router) {
//    otp
    Route::get('send_otp', 'PublicController@send_otp');
    Route::get('verify_otp', 'PublicController@verify_otp');
    Route::post('get_civ_data', 'PublicController@get_civ_data');
});

// admin routes
Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin', 'middleware' => 'cors'], function ($router) {
//    entry
    Route::post('login', 'AdminController@login');
    Route::post('register', 'AdminController@register');

    Route::group(['middleware' => ['admin_api']], function ($router) {
//        auth
        Route::post('logout', 'AdminController@logout');
        Route::post('refresh', 'AdminController@refresh');
        Route::get('me', 'AdminController@me');
        Route::put('update', 'AdminController@update');

//        admin crud
        Route::get('/', 'AdminController@index');
        Route::post('/', 'AdminController@store');
        Route::get('/show/{id}', 'AdminController@show');
        Route::put('/update/{id}', 'AdminController@update');
        Route::delete('/delete/{id}', 'AdminController@destroy');

//        user crud
        Route::post('/user', 'AdminController@user_index');
        Route::get('/all_users', 'AdminController@all_users');
        Route::post('/user/', 'AdminController@user_store');
        Route::get('/user/{id}', 'AdminController@user_show');
        Route::put('/user/{id}', 'AdminController@user_update');
        Route::delete('/user/{id}', 'AdminController@user_destroy');


    });
});

// user routes
Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'user', 'middleware' => 'cors'], function () {
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');

    Route::group(['middleware' => ['user_api']], function ($router) {
//        auth
        Route::post('logout', 'UserController@logout');
        Route::post('refresh', 'UserController@refresh');
        Route::get('me', 'UserController@me');

//        user crud
        Route::put('/update', 'UserController@update');
    });
});
