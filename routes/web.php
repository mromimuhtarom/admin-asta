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
    return view('login');
})->middleware('home');
Route::post('login', 'LoginController@login')->name('login');

Route::middleware('authenticated')->group(function(){
    Route::group(['prefix' => 'Dashboard'], function() {
        Route::get('/home', 'DashboardController@index')->name('home');
    });
    Route::group(['prefix' => 'Admin'], function() {
        Route::group(['prefix' => 'User-Admin'], function() {
            Route::get('/Admin-view', 'UserAdminController@index')->name('UserAdmin-view');
        });
        Route::group(['prefix' => 'Role-Admin'], function() {
            Route::get('/Role-view', 'RoleController@index')->name('Role-view');
        });
        Route::group(['prefix' => 'Log-Admin'], function() {
            Route::get('/Log-view', 'LogController@index')->name('Log-view');
        });
    });
});

 //logout
 Route::get('/logout', 'LoginController@logout')->name("logout");
