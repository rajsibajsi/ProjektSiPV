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

Route::get('profile/locationSelector', 'ProfileController@goToLocation')->name("goToLocation");
//AIzaSyC3eL-GsH6hRmRWt9cwYJrONLkGcJCdrxQ
Route::get('profile/locationShower', 'ProfileController@seeLocation')->name("seeLocation");

Route::post('profile/addLocation', 'ProfileController@saveLocation')->name("addLocation");

/* Ajax calls */
Route::post('changeAlbumVar', 'AjaxController@index');

Route::post('getAlbumVar', 'AjaxController@getAlbumSessionVariable');

Route::get('dbCoinOwner', 'AjaxController@settingOwnership');

Route::get('updateNumberOfCoins', 'AjaxController@updateNumberOfCoins');

/* Chat */
Route::get('/chat', 'ChatController@index')->name("chat");

Route::get('/chat/sent', 'ChatController@sent');

Route::get('/chat/inbox', 'ChatController@inbox');

Route::get('/chat/newMessage', 'ChatController@newMessage');

Route::post('/chat', 'ChatController@sendMessage')->name("chat/sendMessage");