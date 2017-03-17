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

Route::get('/home', 'HomeController@index');

/* FB Auth */
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');

Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

/* Profile */
Route::get('profile', 'ProfileController@index')->name("profile");

Route::get('profile/locationSelector', 'ProfileController@goToLocation');

