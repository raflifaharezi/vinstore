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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

route::get('register/check', 'Auth\RegisterController@check')->name('api-check');
route::get('provincies', 'API\LocationController@provinces')->name('api-provincies');
route::get('regencies/{provinces_id}', 'API\LocationController@regencies')->name('api-regencies');

