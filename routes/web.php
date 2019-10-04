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
Route::group(['prefix' => 'api'], function() {
    Route::post('/0KeWcjGuT9ntMTrCTdHR', 'ApiController@stand');
    Route::post('/bR950ZQhGcirjEVdj7Iu', 'ApiController@setup');
});

Route::group(['prefix' => '/admin'], function() {
  Route::get('/', 'Admin\AdminDashboardController@dashboard');
  Route::group(['prefix' => 'dashboard'], function() {
      Route::get('/', 'Admin\AdminDashboardController@dashboard');
  });
  Route::group(['prefix' => '/users'], function() {
      Route::get('/', 'Admin\AdminUsersController@users');
      Route::get('/add', 'Admin\AdminUsersController@userAdd');
      Route::get('/{id}/edit', 'Admin\AdminUsersController@userEdit');
      Route::get('/{id}/delete', 'Admin\AdminUsersController@userDelete');
      Route::post('/add', 'Admin\AdminUsersController@userAddSave');
      Route::post('/{id}/edit', 'Admin\AdminUsersController@userEditSave');
      Route::post('/ajaxLevel','Admin\AdminUsersController@ajaxLevel');
  });
  Route::group(['prefix' => '/stands'], function() {
      Route::get('/', 'Admin\AdminStandsController@stands');
  });
  Route::group(['prefix' => '/levels'], function() {
      Route::get('/', 'Admin\AdminLevelsController@levels');
      Route::get('/add', 'Admin\AdminLevelsController@levelAdd');
      Route::get('/{id}/edit', 'Admin\AdminLevelsController@levelEdit');
      Route::get('/{id}/delete', 'Admin\AdminLevelsController@levelDelete');
      Route::post('/add', 'Admin\AdminLevelsController@levelAddSave');
      Route::post('/{id}/edit', 'Admin\AdminLevelsController@levelEditSave');
  });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
