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

    Route::group(['prefix'  =>  'Transaction'], function() {
        Route::group(['prefix'  =>  'Banking_Transaction'], function() {
            Route::get('Banking-view', 'Banking_TransactionController@index')->name('Banking-view');
        });
        Route::group(['prefix'  =>  'User_Banking_Transaction'], function() {
            Route::get('User-Banking-view', 'User_Banking_TransactionController@index')->name('UserBank-view');
        });
    });

    Route::group(['prefix'  =>  'Players'], function() {
        Route::group(['prefix'  =>  'Active-Players'], function() {
            Route::get('Active-view', 'PlayersController@indexActive')->name('Active-view');
        });
        Route::group(['prefix'  =>  'High-Roller'], function() {
            Route::get('HighRoller-view', 'PlayersController@indexHighRoller')->name('HighRoller-view');
        });
        Route::group(['prefix'  =>  'Registered-Player'], function() {
            Route::get('RegisteredPlayer-view', 'PlayersController@indexRegisteredPlayer')->name('RegisteredPlayer-view');
        });
        Route::group(['prefix'  =>  'Guest'], function() {
            Route::get('Guest-view', 'PlayersController@indexGuest')->name('Guest-view');
        });
        Route::group(['prefix'  =>  'Bots'], function() {
            Route::get('Bots-view', 'PlayersController@indexBots')->name('Bots-view');
        });
        Route::group(['prefix'  =>  'Report'], function() {
            Route::get('Report-view', 'ReportController@index')->name('Report-view');
        });
        Route::group(['prefix'  =>  'Chip-Player'], function() {
            Route::get('Chip-view', 'ChipController@index')->name('Chip-view');
        });
        Route::group(['prefix'  =>  'Gold-Player'], function() {
            Route::get('Gold-view', 'GoldController@index')->name('Gold-view');
        });
    });

    Route::group(['prefix'  =>  'Slide-Banner'], function() {
        Route::group(['prefix'  => 'SlideBanner'], function() {
            Route::get('SlideBanner-view', 'SlideBannerController@index')->name('SlideBanner-view');
        });
    });

    Route::group(['prefix'  =>  'Daily-Gift'], function() {
        Route::group(['prefix'  => 'Daily-Gift'], function() {
            Route::get('DailyGift-view', 'GiftController@index')->name('DailyGift-view');
        });
    });

    Route::group(['prefix'  =>  'Game-Asta-Poker'], function() {
        Route::group(['prefix'  => 'Table'], function() {
            Route::get('Table-view', 'TableController@index')->name('Table-view');
        });
        Route::group(['prefix'  => 'Category'], function() {
            Route::get('Category-view', 'CategoryController@index')->name('Category-view');
        });
        Route::group(['prefix'  => 'Season'], function() {
            Route::get('Season-view', 'SeasonController@index')->name('Season-view');
        });
        Route::group(['prefix'  => 'SeasonReward'], function() {
            Route::get('SeasonReward-view', 'SeasonRewardController@index')->name('SeasonReward-view');
        });
        Route::group(['prefix'  => 'Tournament'], function() {
            Route::get('Tournament-view', 'TournamentController@index')->name('Tournament-view');
        });
        Route::group(['prefix'  => 'Jackpot-Paytable'], function() {
            Route::get('JackpotPaytable-view', 'JackpotPaytableController@index')->name('JackpotPaytable-view');
        });
    });
});

 //logout
 Route::get('/logout', 'LoginController@logout')->name("logout");
