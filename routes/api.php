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

Route::post('v1/auth/register', 'App\Http\Controllers\Api\V1\CustomerLoginController@register');
Route::post('v1/auth/login', 'App\Http\Controllers\Api\V1\CustomerLoginController@login');

Route::post('v1/computer/register', 'App\Http\Controllers\Api\V1\CustomerApiController@registerComputer');
Route::post('v1/computer/find', 'App\Http\Controllers\Api\V1\CustomerApiController@findComputer');

Route::get('v1/computer/all', 'App\Http\Controllers\Api\V1\CustomerApiController@getAllComputers');
Route::get('v1/resource/all', 'App\Http\Controllers\Api\V1\CustomerApiController@getResources');
Route::get('v1/resource/{id}', 'App\Http\Controllers\Api\V1\CustomerApiController@resourceDownload');