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
    Route::get('debit-data', 'ChartController@debitData');
    Route::get('credit-data', 'ChartController@creditData');
    Route::get('balance-data', 'ChartController@balanceData');
    Route::get('sub-account-data/{account:id}', 'AccountController@childShowAPI');



    Route::post('add-account', 'AccountController@store');
    Route::post('add-event', 'EventController@addEventAPI');
    Route::post('update-event/{event:id}', 'EventController@update');
    // Route::post('add-role', 'UserController@addRole');


    Route::delete('delete-account', 'AccountController@destroyParent');
    Route::delete('delete-child-account', 'AccountController@destroyChild');
    Route::delete('delete-finance/{finance:id}', 'FinanceController@destroy');
    Route::delete('delete-event/{event:id}', 'EventController@destroyParent');
    Route::delete('delete-child-event/{income:id}', 'EventController@destroyChild');
    Route::delete('delete-user/{user:id}', 'UserController@destroy');
});