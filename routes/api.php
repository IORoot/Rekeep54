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

/*Route::middleware('cors:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group(['prefix' => '/v1', 'middleware' => ['cors:api']], function(){

    // USERMENU Controllers
    Route::resource('usermenu','API\ApiUsermenuController');
    Route::get('usermenu/{id}/page','API\ApiUsermenuController@showpage');

    // PAGE Controller
    Route::resource('page','API\ApiPageController');
    Route::get('page/{id}/nodes','API\ApiPageController@shownodes');

    // NODE Controller
    Route::resource('node','API\ApiNodeController');

});

/*
|--------------------------------------------------------------------------
| API Routes - For Browser Extensions - Using JWT + CORS.
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'jwt', 'middleware' => ['cors']], function(){

    // AUTHENTICATION Controller
    Route::post('authenticate', 'JWT\JWTAuthController@store');

    // USERMENU Controller
    Route::get('usermenu', 'JWT\JWTUsermenuController@index');

    // NODE Controller
    Route::post('newnode', 'JWT\JWTNodeController@store');


});