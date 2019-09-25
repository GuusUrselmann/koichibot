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

Route::get('/0KeWcjGuT9ntMTrCTdHR', 'ApiController@job');

Route::group(['prefix' => '/admin'], function() {
  Route::get('/', 'Admin\AdminDashboardController@dashboard');
  Route::group(['prefix' => 'dashboard'], function() {
      Route::get('/', 'Admin\AdminDashboardController@dashboard');
  });
  Route::group(['prefix' => 'users'], function() {
      Route::get('/', 'Admin\AdminUsersController@users');
      Route::get('/{id}/edit', 'Admin\AdminUsersController@userEdit');
      Route::post('/{id}/edit', 'Admin\AdminUsersController@userEditSave');
  });
  Route::group(['prefix' => 'stands'], function() {
      Route::get('/', 'Admin\AdminStandsController@stands');
  });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
