<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/resources');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/resources', 'ManageResourceController@index')->name('getresources');
    Route::post('/resource/upload', 'ManageResourceController@uploadResource')->name('uploadResource');
    Route::post('/resource/update', 'ManageResourceController@updateResource')->name('updateResource');
});
