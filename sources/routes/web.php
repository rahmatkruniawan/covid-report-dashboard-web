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

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index');

    // Home Controller
    Route::prefix('home')->group(function() {
        Route::get('/', 'HomeController@index')->name('home');
    });

    // Report Module
    Route::prefix('report')->group(function() {
        Route::get('/', 'ReportController@index')->name('report');
        Route::post('/', 'ReportController@setReportData');

        Route::get('{id}/detail', 'ReportController@detailReport')->name('report.detail');
        Route::post('{id}/detail', 'ReportController@setStatusReport');
    });

    // User Module
    Route::prefix('user')->group(function(){
        Route::middleware('can:user')->group(function(){
            Route::get('/', 'UserController@index')->name('user');
            Route::post('/', 'UserController@getData');
        });
        Route::middleware('can:user.add')->group(function(){
            Route::get('add/', 'UserController@form')->name('user.add');
            Route::post('add/', 'UserController@save');
        });
        Route::middleware('can:user.edit')->group(function(){
            Route::get('edit/{id}', 'UserController@form')->name('user.edit');
            Route::post('edit/{id}', 'UserController@save');
        });
        Route::delete('delete/{id}', 'UserController@destroy')->name('user.delete')->middleware('can:user.delete');
    });

    // User Module
    Route::prefix('history')->group(function(){
        Route::middleware('can:history')->group(function(){
            Route::get('/', 'HistoryController@index')->name('history');
            Route::post('/', 'HistoryController@getData');
        });
    });
});

