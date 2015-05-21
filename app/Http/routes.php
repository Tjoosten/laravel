<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'VariousController@frontpage');

// Auth & User management.
Route::group(['prefix' => 'user'], function() {
  Route::get('/register', ['middleware' => 'Admin', 'uses' => 'AuthController@registerView']);
  Route::post('/register', ['middleware' => 'Admin', 'uses' => 'AuthController@postRegister']);
  Route::get('/admin/{id}', ['middleware' => 'Admin', 'uses' => 'AuthController@DoAdmin']);
  Route::get('/undoAdmin/{id}', ['middleware' => 'Admin', 'uses' => 'AuthController@UndoAdmin']);
  Route::get('/block/{id}', ['middleware' => 'Admin', 'uses' => 'AuthController@doBlock']);
  Route::get('/unblock/{id}', ['middleware' => 'Admin', 'uses' => 'AuthController@UndoBlock']);
  Route::get('/recovery', 'AuthController@recover');
});

Route::group(['prefix' => 'auth'], function() {
  Route::get('/login', 'AuthController@viewLogin');
  Route::post('/verify', 'AuthController@verify');
  Route::get('/logout', 'AuthController@logout');
});
