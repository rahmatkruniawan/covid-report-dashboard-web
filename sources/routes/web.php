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

    Route::prefix('report')->group(function() {
        Route::get('/', 'ReportController@index')->name('report');
        Route::post('/', 'ReportController@setReportData');
    });

    // Security Module
    Route::prefix('security')->group(function(){
        Route::get('/', 'HomeController@dashboard')->name('security');
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
    });

    // Master Module
    Route::prefix('master')->group(function(){
        Route::get('/', 'HomeController@dashboard')->name('master');
        Route::prefix('city')->group(function(){
            Route::middleware('can:city')->group(function(){
                Route::get('/', 'CityController@index')->name('city');
                Route::post('/', 'CityController@getData');
            });
            Route::middleware('can:city.add')->group(function(){
                Route::get('add/', 'CityController@form')->name('city.add');
                Route::post('add/', 'CityController@save');
            });
            Route::middleware('can:city.edit')->group(function(){
                Route::get('edit/{id}', 'CityController@form')->name('city.edit');
                Route::post('edit/{id}', 'CityController@save');
            });
            Route::delete('delete/{id}', 'CityController@destroy')->name('city.delete')->middleware('can:city.delete');
        });
    });
});

