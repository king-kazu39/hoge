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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/account', 'UsersController@show')->name('show');

// Route::get('/account{id}', 'UsersController@show2')->name('show2');

Route::get('/account{id}', 'UsersController@show_other')->name('show');

Route::get('/search', 'TargetsController@index')->name('index');

Route::post('/search', 'TargetsController@search')->name('search');

Route::get('/setting', 'HomeController@setting')->name('setting');

Route::get('/create', 'TargetsController@create')->name('create');

Route::post('/create', 'TargetsController@store')->name('store');