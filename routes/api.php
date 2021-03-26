<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Dingo\Api\Routing\Router;

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

Route::group(['prefix' => 'v1/auth'], function($router) {
    Route::post('login', 'App\Http\Controllers\Api\V1\CustomerLoginController@login');
    Route::post('register', 'App\Http\Controllers\Api\V1\CustomerLoginController@register');
});

Route::group(['middleware' => ['assign.guard:api', 'jwt.auth'], 'prefix' => 'v1'], function($router) {
    Route::get('devices', 'App\Http\Controllers\Api\V1\CustomerApiController@getAllPhones');
    Route::get('groups', 'App\Http\Controllers\Api\V1\CustomerApiController@getAllGroups');
    Route::get('resources', 'App\Http\Controllers\Api\V1\CustomerApiController@getResources');
    Route::get('resources/{id}', 'App\Http\Controllers\Api\V1\CustomerApiController@resourceDownload');

    Route::post('devices/update', 'App\Http\Controllers\Api\V1\CustomerApiController@updateAllPhones');
    Route::post('groups/update', 'App\Http\Controllers\Api\V1\CustomerApiController@updateAllGroups');
});


Route::post('v1/computer/find', 'App\Http\Controllers\Api\V1\CustomerApiController@findComputer');
Route::get('v1/computer/all', 'App\Http\Controllers\Api\V1\CustomerApiController@getAllComputers');