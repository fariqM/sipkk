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
            Route::get('index', 'AccountController@index');
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

