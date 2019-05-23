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
            Route::post('/Admin-update', 'UserAdminController@update')->name('UserAdmin-update');
            Route::delete('/Admin-delete', 'UserAdminController@destroy')->name('UserAdmin-delete');
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
            Route::post('Bots-update', 'PlayersController@updateBot')->name('Bots-update');
            Route::post('Bots-create', 'PlayersController@storeBots')->name('Bots-create');
        });
        Route::group(['prefix'  =>  'Report'], function() {
            Route::get('Report-view', 'ReportController@index')->name('Report-view');
            Route::get('Report-search', 'ReportController@search')->name('Report-search');
        });
        Route::group(['prefix'  =>  'Chip-Player'], function() {
            Route::get('Chip-view', 'ChipController@index')->name('Chip-view');
            Route::get('Chip-search', 'ChipController@search')->name('Chip-search');
        });
        Route::group(['prefix'  =>  'Gold-Player'], function() {
            Route::get('Gold-view', 'GoldController@index')->name('Gold-view');
            Route::get('Gold-search', 'GoldController@search')->name('Gold-search');
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
            Route::post('Table-update', 'TableController@update')->name('Table-update');
            Route::post('Table-create', 'TableController@store')->name('Table-create');
            Route::delete('Table-delete', 'TableController@destroy')->name('Table-delete');
        });
        Route::group(['prefix'  => 'Category'], function() {
            Route::get('Category-view', 'CategoryController@index')->name('Category-view');
            Route::post('Category-create', 'CategoryController@store')->name('Category-create');
            Route::post('Category-update', 'CategoryController@update')->name('Category-update');
            Route::delete('Category-delete', 'CategoryController@destroy')->name('Category-delete');
        });
        Route::group(['prefix'  => 'Season'], function() {
            Route::get('Season-view', 'SeasonController@index')->name('Season-view');
        });
        Route::group(['prefix'  => 'SeasonReward'], function() {
            Route::get('SeasonReward-view', 'SeasonRewardController@index')->name('SeasonReward-view');
            Route::post('SeasonReward-update', 'SeasonRewardController@update')->name('SeasonReward-update');
        });
        Route::group(['prefix'  => 'Tournament'], function() {
            Route::get('Tournament-view', 'TournamentController@index')->name('Tournament-view');
            Route::post('Tournament-update', 'TournamentController@update')->name('Tournament-update');
        });
        Route::group(['prefix'  => 'Jackpot-Paytable'], function() {
            Route::get('JackpotPaytable-view', 'JackpotPaytableController@index')->name('JackpotPaytable-view');
            Route::post('JackpotPaytable-update', 'JackpotPaytableController@update')->name('JackpotPaytable-update');
        });
        Route::group(['prefix'  => 'Find-Room'], function() {
            Route::get('FindRoom-view', 'FindRoomController@index')->name('FindRoom-view');
            Route::post('FindRoom-update', 'FindRoomController@update')->name('FindRoom-update');
        });
    });

    Route::group(['prefix' => 'store'], function() {
        Route::group(['prefix'  =>  'Best-Offer'], function() {
            Route::get('BestOffer-view', 'BestOfferController@index')->name('BestOffer-view');
        });
        Route::group(['prefix'  =>  'Chip-Store'], function() {
            Route::get('ChipStore-view', 'ChipStoreController@index')->name('ChipStore-view');
        });
        Route::group(['prefix'  =>  'Gold-Store'], function() {
            Route::get('GoldStore-view', 'GoldStoreController@index')->name('GoldStore-view');
        });
        Route::group(['prefix'  =>  'Goods-Store'], function() {
            Route::get('GoodsStore-view', 'GoodsStoreController@index')->name('GoodsStore-view');
        });
        Route::group(['prefix'  =>  'Gift-Store'], function() {
            Route::get('GiftStore-view', 'GiftStoreController@index')->name('GiftStore-view');
            Route::post('GiftStore-update', 'GiftStoreController@update')->name('GiftStore-update');
            Route::post('GiftStore-updateimage', 'GiftStoreController@updateimage')->name('GiftStore-updateimage');
        });
        Route::group(['prefix'  =>  'Transaction-Store'], function() {
            Route::get('TransactionStore-view', 'TransactionStoreController@index')->name('TransactionStore-view');
        });
        Route::group(['prefix'  =>  'Payment-Store'], function() {
            Route::get('PaymentStore-view', 'PaymentStoreController@index')->name('PaymentStore-view');
        });
        Route::group(['prefix'  =>  'Report-Store'], function() {
            Route::get('ReportStore-view', 'ReportStoreController@index')->name('ReportStore-view');
        });
    });

    Route::group(['prefix'  =>  'Notification'], function() {
        Route::group(['prefix'  =>  'Push-Notification'], function() {
            Route::get('PushNotification-view', 'PushNotificationController@index')->name('PushNotification-view');
            Route::post('PushNotification-update', 'PushNotificationController@update')->name('PushNotification-update');
        });
        Route::group(['prefix'  =>  'Email-Notification'], function() {
            Route::get('EmailNotification-view', 'EmailNotificationController@index')->name('EmailNotification-view');
            Route::post('EmailNotification-update', 'EmailNotificationController@update')->name('EmailNotification-update');
        });
    });

    Route::group(['prefix'  =>  'Settings'], function() {
        Route::group(['prefix'  =>  'General-Setting'], function() {
            Route::get('GeneralSetting-view', 'GeneralSettingController@index')->name('GeneralSetting-view');
            Route::post('GeneralSetting-update', 'GeneralSettingController@update')->name('GeneralSetting-update');
        });
        Route::group(['prefix'  =>  'Game-Setting'], function() {
            Route::get('GameSetting-view', 'GameSettingController@index')->name('GameSetting-view');
        });
        Route::group(['prefix'  =>  'Admin-Setting'], function() {
            Route::get('AdminSetting-view', 'AdminSettingController@index')->name('AdminSetting-view');
            Route::post('AdminSetting-update', 'AdminSettingController@update')->name('AdminSetting-update');
        });
    });
});

 //logout
 Route::get('/logout', 'LoginController@logout')->name("logout");
