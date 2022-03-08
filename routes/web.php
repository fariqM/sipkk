<?php

use Illuminate\Support\Facades\Auth;
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

Route::namespace('App\Http\Controllers')->group(function(){
    Route::middleware('auth')->group(function(){
        Route::prefix('account')->group(function(){
            Route::get('index', 'AccountController@index')->name('account');
            Route::get('create', 'AccountController@create');
            Route::post('setup', 'AccountCategoryController@store');
            Route::get('parent-update/{account:id}', 'AccountController@parentShow');
            Route::post('parent-update/{account:id}/update', 'AccountController@parentUpdate')->name('parent.update');
            Route::get('child-update/{id}', 'AccountController@childShow');
            Route::post('child-update/{accountcategory:id}/update', 'AccountController@childUpdate')->name('child.update');
        });
        Route::prefix('finance')->group(function(){
            Route::get('index', 'FinanceController@index')->name('finance');
            Route::get('create', 'FinanceController@create');
            Route::post('store', 'FinanceController@store');
            Route::get('show/{finance:id}', 'FinanceController@show');
            Route::post('show/{finance:id}/update', 'FinanceController@update')->name('finance.update');
        });
        Route::prefix('event')->group(function(){
            Route::get('index', 'EventController@index')->name('events');
            Route::get('create', 'EventController@create');
            Route::post('store', 'EventController@store');
        });
        Route::get('/dasbor', [App\Http\Controllers\HomeController::class, 'index'])->name('dasbor');
    });

    Route::middleware('guest')->group(function(){
        Route::get('/', function () {
            return view('auth.login');
        });
    });
});



Auth::routes();

