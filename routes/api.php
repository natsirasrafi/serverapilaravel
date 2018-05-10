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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('payments', 'PaymentController@index');
Route::get('getjoin', 'PaymentController@getjoin');
Route::get('payments/{id}', 'PaymentController@show');
Route::post('payments', 'PaymentController@store');
Route::put('payments/{id}', 'PaymentController@update');
Route::delete('payments/{id}', 'PaymentController@delete');
