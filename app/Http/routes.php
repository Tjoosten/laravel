<?php

/**
 * --------------------------------------------------------------------------
 * Application Routes
 * --------------------------------------------------------------------------
 *
 * Here is where you can register all of the routes for an application.
 * It's a breeze. Simply tell Laravel the URIs it should respond to
 * and give it the controller to call when that URI is requested.
 *
 * @todo Set route groups for the middleware
*/

Route::get('/', 'VariousController@frontpage');

// Auth & User management.
Route::group(['prefix' => 'user'], function() {
  Route::get('/register', 'AuthController@registerView');
  Route::post('/register', 'AuthController@postRegister');
  Route::get('/admin/{id}', 'AuthController@DoAdmin');
  Route::get('/undoAdmin/{id}', 'AuthController@UndoAdmin');
  Route::get('/block/{id}', 'AuthController@doBlock');
  Route::get('/unblock/{id}','AuthController@UndoBlock');
  Route::get('/recovery', 'AuthController@recover');
  Route::get('/delete/{id}', 'AuthController@deleteLogin');
});

Route::group(['prefix' => 'auth'], function() {
  Route::get('/management', 'AuthController@index');
  Route::get('/login', 'AuthController@viewLogin');
  Route::post('/verify', 'AuthController@verify');
  Route::get('/logout', 'AuthController@logout');
});

Route::group(['prefix' => 'api'], function() {
    Route::resource('/kloekecode', 'ApiKloekcode');
});

Route::resource('words','WordController');