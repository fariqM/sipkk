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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('account-data', 'AccountController@index_data');
    Route::get('finance-data', 'FinanceController@indexAPI');
    Route::get('events-data', 'EventController@indexAPI');

    Route::post('add-account', 'AccountController@store');

    Route::delete('delete-account', 'AccountController@destroyParent');
    Route::delete('delete-child-account', 'AccountController@destroyChild');
    Route::delete('delete-finance/{finance:id}', 'FinanceController@destroy');
});