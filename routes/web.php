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
        Route::resource('member', 'MemberController');
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::prefix('user')->group(function(){
                Route::get('users-data', 'UserController@IndexAPI');
                Route::get('index', 'UserController@index')->name('users');
                Route::get('create', 'UserController@create');
                Route::post('store', 'UserController@store');
                Route::get('update/{user:id}', 'UserController@show');
                Route::post('update/{user:id}/store', 'UserController@update')->name('user.update');
            });
            Route::prefix('account')->group(function(){
                Route::get('index', 'AccountController@index')->name('account');
                Route::get('create', 'AccountController@create');
                Route::post('setup', 'AccountCategoryController@store');
                Route::get('parent-update/{account}', 'AccountController@parentShow')->name('account.update');
                Route::post('parent-update/{account:id}/update', 'AccountController@parentUpdate')->name('parent.update');
                Route::get('child-update/{id}', 'AccountController@childShow');
                Route::post('child-update/{accountcategory:id}/update', 'AccountController@childUpdate')->name('child.update');
            });
        });
        Route::group(['middleware' => ['role:Super Admin|Bendahara']], function () {
            Route::prefix('finance')->group(function(){
                Route::get('main', 'FinanceController@main')->name('finance');
                Route::get('index/{slug}', 'FinanceController@index');
                Route::get('create', 'FinanceController@create');
                Route::post('store', 'FinanceController@store');
                Route::get('show/{finance:id}', 'FinanceController@show');
                Route::post('show/{finance:id}/update', 'FinanceController@update')->name('finance.update');
            });
            Route::prefix('event')->group(function(){
                Route::get('index', 'EventController@index')->name('events');
                Route::get('create', 'EventController@create');
                Route::post('store', 'EventController@store');
                Route::get('update/{income}', 'EventController@show')->name('event.show');
                Route::post('update/{income}/store', 'EventController@childUpdate')->name('event.update');
            });

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

