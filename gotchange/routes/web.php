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


// Route to login form
Route::get('/login', 'LoginController@index')->name('login');

// Route to process form
Route::post('/login', 'LoginController@doLogin');

Route::post('/login', 'LoginController@doLogout');
