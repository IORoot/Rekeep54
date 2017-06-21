<?php

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::group(['middleware' => ['web']], function () {

    // Dashboard
    Route::get('/', 'RekeepController@index');

    // Authentication Routes.
    Route::auth();
    Route::get('auth/{provider}', 'AuthSocialiteController@login');
    Route::get('auth/{provider}/callback', 'AuthSocialiteController@login');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
