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

Route::get('/datatables', function () {
    return view('design.datatables');
});
Route::middleware('authenticated')->group(function(){
    Route::group(['prefix' => 'Edit-Profile'], function(){
        Route::get('/profile', 'ProfileController@index')->name('profile-view');
        Route::post('/profile-password', 'ProfileController@password')->name('profile-password');
        Route::post('/Profile-update', 'ProfileController@update')->name('profile-update');
    });
    
    Route::group(['prefix' => 'Dashboard'], function() {
        Route::get('/home', 'DashboardController@index')->name('home');
    });

    Route::group(['prefix' => 'Admin'], function() {
        Route::group(['prefix' => 'User-Admin'], function() {
            Route::middleware('page_denied:User Admin')->group(function(){
                Route::get('/Admin-view', 'UserAdminController@index')->name('UserAdmin-view');
                Route::post('/Admin-update', 'UserAdminController@update')->name('UserAdmin-update');
                Route::post('/Admin-updatepassword', 'UserAdminController@updatepassword')->name('UserAdmin-updatepassword');
                Route::post('/Admin-create', 'UserAdminController@store')->name('UserAdmin-create');
                Route::delete('/Admin-delete', 'UserAdminController@destroy')->name('UserAdmin-delete');
            });
        });
        Route::group(['prefix' => 'Role-Admin'], function() {
            Route::middleware('page_denied:Role Admin')->group(function(){
                Route::get('/Role-view', 'RoleController@index')->name('Role-view');
                Route::post('/Role-update', 'RoleController@update')->name('Role-update');
                Route::post('/Role-create', 'RoleController@store')->name('Role-create');
                Route::get('/Role-menu/{role}', 'RoleController@menu')->name('Role-menu');
                Route::post('/Role-menu/{role}/edit', 'RoleController@menuupdate')->name('Role-menu-edit');
                Route::delete('/Role-delete', 'RoleController@destroy')->name('Role-delete');
            });
        });
        Route::group(['prefix' => 'Log-Admin'], function() {
            Route::middleware('page_denied:Log Admin')->group(function(){
                Route::get('/Log-view', 'LogController@index')->name('Log-view');
                Route::get('/Log-search', 'LogController@search')->name('Log-search');
            });
        });
    });

    Route::group(['prefix'  =>  'Transaction'], function() {
        Route::group(['prefix'  =>  'Banking_Transaction'], function() {
            Route::middleware('page_denied:Banking transaction')->group(function(){
                Route::get('Banking-view', 'Banking_TransactionController@index')->name('Banking-view');
            });
        });
        Route::group(['prefix'  =>  'User_Banking_Transaction'], function() {
            Route::middleware('page_denied:User Bank Transaction')->group(function(){
                Route::get('User-Banking-view', 'User_Banking_TransactionController@index')->name('UserBank-view');
            });
        });
    });

    Route::group(['prefix'  =>  'Players'], function() {
        Route::group(['prefix'  =>  'Active-Players'], function() {
            Route::middleware('page_denied:Active Players')->group(function(){
                Route::get('Active-view', 'PlayersController@indexActive')->name('Active-view');
            });
        });
        Route::group(['prefix'  =>  'Report-Player'], function() {
            Route::middleware('page_denied:Report Player')->group(function(){
                Route::get('ReportPlayer-view', 'ReportPlayerController@index')->name('ReportPlayer-view');
                Route::get('ReportPlayer-search', 'ReportPlayerController@search')->name('ReportPlayer-search');
            });
        });
        Route::group(['prefix'  =>  'High-Roller'], function() {
            Route::middleware('page_denied:High Rollers')->group(function(){
                Route::get('HighRoller-view', 'PlayersController@indexHighRoller')->name('HighRoller-view');
            });
        });
        Route::group(['prefix'  =>  'Registered-Player'], function() {
            Route::middleware('page_denied:Registered Player')->group(function(){
                Route::get('RegisteredPlayer-view', 'PlayersController@indexRegisteredPlayer')->name('RegisteredPlayer-view');
            });
        });
        Route::group(['prefix'  =>  'Guest'], function() {
            Route::middleware('page_denied:Guest')->group(function(){
                Route::get('Guest-view', 'PlayersController@indexGuest')->name('Guest-view');
            });
        });
        Route::group(['prefix'  =>  'Bots'], function() {
            Route::middleware('page_denied:Bots')->group(function(){
                Route::get('Bots-view', 'PlayersController@indexBots')->name('Bots-view');
                Route::post('Bots-update', 'PlayersController@updateBot')->name('Bots-update');
                Route::post('Bots-create', 'PlayersController@storeBots')->name('Bots-create');
                Route::delete('Bots-delete', 'PlayersController@destroyBots')->name('Bots-delete');
            });
        });
        Route::group(['prefix'  =>  'PlayReport'], function() {
            Route::middleware('page_denied:Report')->group(function(){
                Route::get('PlayReport-view', 'PlayReportController@index')->name('PlayReport-view');
                Route::get('PlayReport-search', 'PlayReportController@search')->name('PlayReport-search');
            });
        });
        Route::group(['prefix'  =>  'Chip-Player'], function() {
            Route::middleware('page_denied:Chip Player')->group(function(){
                Route::get('Chip-view', 'ChipController@index')->name('Chip-view');
                Route::get('Chip-search', 'ChipController@search')->name('Chip-search');
            });
        });
        Route::group(['prefix'  =>  'Gold-Player'], function() {
            Route::middleware('page_denied:Gold Player')->group(function(){
                Route::get('Gold-view', 'GoldController@index')->name('Gold-view');
                Route::get('Gold-search', 'GoldController@search')->name('Gold-search');
            });
        });
    });

    Route::group(['prefix'  =>  'Slide-Banner'], function() {
        Route::group(['prefix'  => 'SlideBanner'], function() {
            Route::middleware('page_denied:Slide Banner')->group(function(){
                Route::get('SlideBanner-view', 'SlideBannerController@index')->name('SlideBanner-view');
                Route::post('SlideBanner-update', 'SlideBannerController@update')->name('SlideBanner-update');
                Route::post('SlideBanner-updateimage', 'SlideBannerController@updateimage')->name('SlideBanner-updateimage');
                Route::delete('SlideBanner-delete', 'SlideBannerController@destroy')->name('SlideBanner-delete');
                Route::post('SlideBanner-create', 'SlideBannerController@store')->name('SlideBanner-create');
            });
        });
    });

    Route::group(['prefix'  =>  'Daily-Gift'], function() {
        Route::group(['prefix'  => 'Daily-Gift'], function() {
            Route::middleware('page_denied:Daily Gift')->group(function(){
                Route::get('DailyGift-view', 'GiftController@index')->name('DailyGift-view');
                Route::post('DailyGift-update', 'GiftController@update')->name('DailyGift-update');
                Route::post('DailyGift-create', 'GiftController@store')->name('DailyGift-create');
                Route::delete('DailyGift-delete', 'GiftController@destroy')->name('DailyGift-delete');
            });
        });
    });

    // Game Asta Poker
    Route::group(['prefix'  =>  'Game-Asta-Poker'], function() {
        Route::group(['prefix'  => 'Table'], function() {
            Route::middleware('page_denied:Table Asta Poker')->group(function(){
                Route::get('Table-view', 'TableController@index')->name('Table-view');
                Route::post('Table-update', 'TableController@update')->name('Table-update');
                Route::post('Table-create', 'TableController@store')->name('Table-create');
                Route::delete('Table-delete', 'TableController@destroy')->name('Table-delete');
            });
        });
        Route::group(['prefix'  => 'Category'], function() {
            Route::middleware('page_denied:Category Asta Poker')->group(function(){
                Route::get('Category-view', 'CategoryController@index')->name('Category-view');
                Route::post('Category-create', 'CategoryController@store')->name('Category-create');
                Route::post('Category-update', 'CategoryController@update')->name('Category-update');
                Route::delete('Category-delete', 'CategoryController@destroy')->name('Category-delete');
            });
        });
        Route::group(['prefix'  => 'Season'], function() {
            // Route::middleware('page_denied:Category Asta Poker')->group(function(){
                Route::get('Season-view', 'SeasonController@index')->name('Season-view');
                Route::post('Season-create', 'SeasonController@store')->name('Season-create');
                Route::post('Season-update', 'SeasonController@update')->name('Season-update');
                Route::delete('Season-delete', 'SeasonController@destroy')->name('Season-delete');
            // });
        });
        Route::group(['prefix'  => 'SeasonReward'], function() {
            // Route::middleware('page_denied:Category Asta Poker')->group(function(){
                Route::get('SeasonReward-view', 'SeasonRewardController@index')->name('SeasonReward-view');
                Route::post('SeasonReward-create', 'SeasonRewardController@store')->name('SeasonReward-create');
                Route::post('SeasonReward-update', 'SeasonRewardController@update')->name('SeasonReward-update');
                Route::delete('SeasonReward-delete', 'SeasonRewardController@destroy')->name('SeasonReward-delete');
            // });
        });
        Route::group(['prefix'  => 'Tournament'], function() {
            // Route::middleware('page_denied:Category Asta Poker')->group(function(){
                Route::get('Tournament-view', 'TournamentController@index')->name('Tournament-view');
                Route::post('Tournament-create', 'TournamentController@store')->name('Tournament-create');
                Route::post('Tournament-update', 'TournamentController@update')->name('Tournament-update');
            // });
        });
        Route::group(['prefix'  => 'Jackpot-Paytable'], function() {
            // Route::middleware('page_denied:Category Asta Poker')->group(function(){
                Route::get('JackpotPaytable-view', 'JackpotPaytableController@index')->name('JackpotPaytable-view');
                Route::post('JackpotPaytable-update', 'JackpotPaytableController@update')->name('JackpotPaytable-update');
            // });
        });
        // Route::group(['prefix'  => 'Find-Room'], function() {
        //     Route::get('FindRoom-view', 'FindRoomController@index')->name('FindRoom-view');
        //     Route::post('FindRoom-update', 'FindRoomController@update')->name('FindRoom-update');
        // });
    });

    // Game Asta Big 2
    Route::group(['prefix'  =>  'Game-Asta-BigTwo'], function() {
        Route::group(['prefix'  => 'Table'], function() {
            Route::middleware('page_denied:Table Asta Big Two')->group(function(){
                Route::get('BigTwoTable-view', 'TableController@BigTwoindex')->name('BigTwoTable-view');
                Route::post('BigTwoTable-update', 'TableController@BigTwoupdate')->name('BigTwoTable-update');
                Route::post('BigTwoTable-create', 'TableController@BigTwostore')->name('BigTwoTable-create');
                Route::delete('BigTwoTable-delete', 'TableController@BigTwodestroy')->name('BigTwoTable-delete');
            });
        });
        Route::group(['prefix'  => 'Category'], function() {
            Route::middleware('page_denied:Category Asta Big Two')->group(function(){
                Route::get('BigTwoCategory-view', 'CategoryController@BigTwoindex')->name('BigTwoCategory-view');
                Route::post('BigTwoCategory-create', 'CategoryController@BigTwostore')->name('BigTwoCategory-create');
                Route::post('BigTwoCategory-update', 'CategoryController@BigTwoupdate')->name('BigTwoCategory-update');
                Route::delete('BigTwoCategory-delete', 'CategoryController@BigTwodestroy')->name('BigTwoCategory-delete');
            });
        });
        Route::group(['prefix'  => 'Season'], function() {
            // Route::middleware('page_denied:Category Asta Big Two')->group(function(){
                Route::get('BigTwoSeason-view', 'SeasonController@BigTwoindex')->name('BigTwoSeason-view');
                Route::post('BigTwoSeason-create', 'SeasonController@BigTwostore')->name('BigTwoSeason-create');
                Route::post('BigTwoSeason-update', 'SeasonController@BigTwoupdate')->name('BigTwoSeason-update');
                Route::delete('BigTwoSeason-delete', 'SeasonController@BigTwodestroy')->name('BigTwoSeason-delete');
            // });
        });
        Route::group(['prefix'  => 'SeasonReward'], function() {
            // Route::middleware('page_denied:Category Asta Big Two')->group(function(){
                Route::get('BigTwoSeasonReward-view', 'SeasonRewardController@BigTwoindex')->name('BigTwoSeasonReward-view');
                Route::post('BigTwoSeasonReward-create', 'SeasonRewardController@BigTwostore')->name('BigTwoSeasonReward-create');
                Route::post('BigTwoSeasonReward-update', 'SeasonRewardController@BigTwoupdate')->name('BigTwoSeasonReward-update');
                Route::delete('BigTwoSeasonReward-delete', 'SeasonRewardController@BigTwodestroy')->name('BigTwoSeasonReward-delete');
            // });
        });
        Route::group(['prefix'  => 'Tournament'], function() {
            // Route::middleware('page_denied:Category Asta Big Two')->group(function(){
                Route::get('BigTwoTournament-view', 'TournamentController@BigTwoindex')->name('BigTwoTournament-view');
                Route::post('BigTwoTournament-create', 'TournamentController@BigTwostore')->name('BigTwoTournament-create');
                Route::post('BigTwoTournament-update', 'TournamentController@BigTwoupdate')->name('BigTwoTournament-update');
            // });
        });
        Route::group(['prefix'  => 'Jackpot-Paytable'], function() {
            // Route::middleware('page_denied:Category Asta Big Two')->group(function(){
                Route::get('BigTwoJackpotPaytable-view', 'JackpotPaytableController@BigTwoindex')->name('BigTwoJackpotPaytable-view');
                Route::post('BigTwoJackpotPaytable-update', 'JackpotPaytableController@BigTwoupdate')->name('BigTwoJackpotPaytable-update');
            // });
        });
        // Route::group(['prefix'  => 'Find-Room'], function() {
        //     Route::get('BigTwoFindRoom-view', 'FindRoomController@BigTwoindex')->name('BigTwoFindRoom-view');
        //     Route::post('BigTwoFindRoom-update', 'FindRoomController@BigTwoupdate')->name('BigTwoFindRoom-update');
        // });
    });

    // Game Asta Domino Susun
    Route::group(['prefix'  =>  'Game-Asta-DominoSusun'], function() {
        Route::group(['prefix'  => 'Table'], function() {
            Route::get('DominoSTable-view', 'TableController@DominoSusunindex')->name('DominoSTable-view');
            Route::post('DominoSTable-update', 'TableController@DominoSusunupdate')->name('DominoSTable-update');
            Route::post('DominoSTable-create', 'TableController@DominoSusunstore')->name('DominoSTable-create');
            Route::delete('DominoSTable-delete', 'TableController@DominoSusundestroy')->name('DominoSTable-delete');
        });
        Route::group(['prefix'  => 'Category'], function() {
            Route::get('DominoSCategory-view', 'CategoryController@DominoSusunindex')->name('DominoSCategory-view');
            Route::post('DominoSCategory-create', 'CategoryController@DominoSusunstore')->name('DominoSCategory-create');
            Route::post('DominoSCategory-update', 'CategoryController@DominoSusunupdate')->name('DominoSCategory-update');
            Route::delete('DominoSCategory-delete', 'CategoryController@DominoSusundestroy')->name('DominoSCategory-delete');
        });
        Route::group(['prefix'  => 'Season'], function() {
            Route::get('DominoSSeason-view', 'SeasonController@BigTwoindex')->name('DominoSSeason-view');
            Route::post('DominoSSeason-create', 'SeasonController@BigTwostore')->name('DominoSSeason-create');
            Route::post('DominoSSeason-update', 'SeasonController@BigTwoupdate')->name('DominoSSeason-update');
            Route::delete('DominoSSeason-delete', 'SeasonController@BigTwodestroy')->name('DominoSSeason-delete');
        });
        Route::group(['prefix'  => 'SeasonReward'], function() {
            Route::get('DominoSSeasonReward-view', 'SeasonRewardController@BigTwoindex')->name('DominoSSeasonReward-view');
            Route::post('DominoSSeasonReward-create', 'SeasonRewardController@BigTwostore')->name('DominoSSeasonReward-create');
            Route::post('DominoSSeasonReward-update', 'SeasonRewardController@BigTwoupdate')->name('DominoSSeasonReward-update');
            Route::delete('DominoSSeasonReward-delete', 'SeasonRewardController@BigTwodestroy')->name('DominoSSeasonReward-delete');
        });
        Route::group(['prefix'  => 'Tournament'], function() {
            Route::get('DominoSTournament-view', 'TournamentController@BigTwoindex')->name('DominoSTournament-view');
            Route::post('DominoSTournament-create', 'TournamentController@BigTwostore')->name('DominoSTournament-create');
            Route::post('DominoSTournament-update', 'TournamentController@BigTwoupdate')->name('DominoSTournament-update');
        });
        Route::group(['prefix'  => 'Jackpot-Paytable'], function() {
            Route::get('DominoSJackpotPaytable-view', 'JackpotPaytableController@BigTwoindex')->name('DominoSJackpotPaytable-view');
            Route::post('DominoSJackpotPaytable-update', 'JackpotPaytableController@BigTwoupdate')->name('DominoSJackpotPaytable-update');
        });
        Route::group(['prefix'  => 'Find-Room'], function() {
            Route::get('DominoSFindRoom-view', 'FindRoomController@BigTwoindex')->name('DominoSFindRoom-view');
            Route::post('DominoSFindRoom-update', 'FindRoomController@BigTwoupdate')->name('DominoSFindRoom-update');
        });
    });

    // Game Asta Domino QQ
    Route::group(['prefix'  =>  'Game-Asta-DominoQQ'], function() {
        Route::group(['prefix'  => 'Table'], function() {
            Route::get('DominoQTable-view', 'TableController@DominoQindex')->name('DominoQTable-view');
            Route::post('DominoQTable-update', 'TableController@DominoQupdate')->name('DominoQTable-update');
            Route::post('DominoQTable-create', 'TableController@DominoQstore')->name('DominoQTable-create');
            Route::delete('DominoQTable-delete', 'TableController@DominoQdestroy')->name('DominoQTable-delete');
        });
        Route::group(['prefix'  => 'Category'], function() {
            Route::get('DominoQCategory-view', 'CategoryController@DominoQindex')->name('DominoQCategory-view');
            Route::post('DominoQCategory-create', 'CategoryController@DominoQstore')->name('DominoQCategory-create');
            Route::post('DominoQCategory-update', 'CategoryController@DominoQupdate')->name('DominoQCategory-update');
            Route::delete('DominoQCategory-delete', 'CategoryController@DominoQdestroy')->name('DominoQCategory-delete');
        });
        Route::group(['prefix'  => 'Season'], function() {
            Route::get('DominoQSeason-view', 'SeasonController@DominoQindex')->name('DominoQSeason-view');
            Route::post('DominoQSeason-create', 'SeasonController@DominoQstore')->name('DominoQSeason-create');
            Route::post('DominoQSeason-update', 'SeasonController@DominoQupdate')->name('DominoQSeason-update');
            Route::delete('DominoQSeason-delete', 'SeasonController@DominoQdestroy')->name('DominoQSeason-delete');
        });
        Route::group(['prefix'  => 'SeasonReward'], function() {
            Route::get('DominoQSeasonReward-view', 'SeasonRewardController@DominoQindex')->name('DominoQSeasonReward-view');
            Route::post('DominoQSeasonReward-create', 'SeasonRewardController@DominoQstore')->name('DominoQSeasonReward-create');
            Route::post('DominoQSeasonReward-update', 'SeasonRewardController@DominoQupdate')->name('DominoQSeasonReward-update');
            Route::delete('DominoQSeasonReward-delete', 'SeasonRewardController@DominoQdestroy')->name('DominoQSeasonReward-delete');
        });
        Route::group(['prefix'  => 'Tournament'], function() {
            Route::get('DominoQTournament-view', 'TournamentController@DominoQindex')->name('DominoQTournament-view');
            Route::post('DominoQTournament-create', 'TournamentController@DominoQstore')->name('DominoQTournament-create');
            Route::post('DominoQTournament-update', 'TournamentController@DominoQupdate')->name('DominoQTournament-update');
        });
        Route::group(['prefix'  => 'Jackpot-Paytable'], function() {
            Route::get('DominoQJackpotPaytable-view', 'JackpotPaytableController@DominoQindex')->name('DominoQJackpotPaytable-view');
            Route::post('DominoQJackpotPaytable-update', 'JackpotPaytableController@DominoQupdate')->name('DominoQJackpotPaytable-update');
        });
        Route::group(['prefix'  => 'Find-Room'], function() {
            Route::get('DominoQFindRoom-view', 'FindRoomController@DominoQindex')->name('DominoQFindRoom-view');
            Route::post('DominoQFindRoom-update', 'FindRoomController@DominoQupdate')->name('DominoQFindRoom-update');
        });
    });

    Route::group(['prefix' => 'store'], function() {
        Route::group(['prefix'  =>  'Best-Offer'], function() {
            Route::middleware('page_denied:Best Offer')->group(function(){
                Route::get('BestOffer-view', 'BestOfferController@index')->name('BestOffer-view');
            });
        });
        Route::group(['prefix'  =>  'Chip-Store'], function() {
            Route::middleware('page_denied:Chip Store')->group(function(){
                Route::get('ChipStore-view', 'ChipStoreController@index')->name('ChipStore-view');
                Route::post('ChipStore-update', 'ChipStoreController@update')->name('ChipStore-update');
                Route::post('ChipStore-create', 'ChipStoreController@store')->name('ChipStore-create');
                Route::delete('ChipStore-delete', 'ChipStoreController@destroy')->name('ChipStore-delete');
            });
        });
        Route::group(['prefix'  =>  'Gold-Store'], function() {
            Route::middleware('page_denied:Gold Store')->group(function(){
                Route::get('GoldStore-view', 'GoldStoreController@index')->name('GoldStore-view');
                Route::post('GoldStore-create', 'GoldStoreController@store')->name('GoldStore-create');
                Route::post('GoldStore-update', 'GoldStoreController@update')->name('GoldStore-update');
                Route::delete('GoldStore-delete', 'GoldStoreController@destroy')->name('GoldStore-delete');
            });
        });
        Route::group(['prefix'  =>  'Goods-Store'], function() {
            Route::middleware('page_denied:Goods Store')->group(function(){
                Route::get('GoodsStore-view', 'GoodsStoreController@index')->name('GoodsStore-view');
                Route::post('GoodsStore-update', 'GoodsStoreController@update')->name('GoodsStore-update');
                Route::post('GoodsStore-updateimage', 'GoodsStoreController@updateimage')->name('GoodsStore-updateimage');
                Route::delete('GoodsStore-delete', 'GoodsStoreController@destroy')->name('GoodsStore-delete');
                Route::post('GoodsStore-create', 'GoodsStoreController@store')->name('GoodsStore-create');
            });
        });
        Route::group(['prefix'  =>  'Gift-Store'], function() {
            Route::middleware('page_denied:Gift')->group(function(){
                Route::get('GiftStore-view', 'GiftStoreController@index')->name('GiftStore-view');
                Route::post('GiftStore-update', 'GiftStoreController@update')->name('GiftStore-update');
                Route::post('GiftStore-updateimage', 'GiftStoreController@updateimage')->name('GiftStore-updateimage');
                Route::delete('GiftStore-delete', 'GiftStoreController@destroy')->name('GiftStore-delete');
                Route::post('GiftStore-create', 'GiftStoreController@store')->name('GiftStore-create');
            });
        });
        Route::group(['prefix'  =>  'Transaction-Store'], function() {
            Route::middleware('page_denied:Transaction Store')->group(function(){
                Route::get('TransactionStore-view', 'TransactionStoreController@index')->name('TransactionStore-view');
            });
        });
        Route::group(['prefix'  =>  'Payment-Store'], function() {
            Route::middleware('page_denied:Payment Store')->group(function(){
                Route::get('PaymentStore-view', 'PaymentStoreController@index')->name('PaymentStore-view');
                Route::post('PaymentStore-update', 'PaymentStoreController@update')->name('PaymentStore-update');
                Route::post('PaymentStore-create', 'PaymentStoreController@store')->name('PaymentStore-create');
                Route::delete('PaymentStore-delete', 'PaymentStoreController@destroy')->name('PaymentStore-delete');
            });
        });
        Route::group(['prefix'  =>  'Report-Store'], function() {
            Route::middleware('page_denied:Report Store')->group(function(){
                Route::get('ReportStore-view', 'ReportStoreController@index')->name('ReportStore-view');
            });
        });
    });

    Route::group(['prefix'  =>  'Notification'], function() {
        Route::group(['prefix'  =>  'Push-Notification'], function() {
            Route::middleware('page_denied:Push Notification')->group(function(){
                Route::get('PushNotification-view', 'PushNotificationController@index')->name('PushNotification-view');
                Route::post('PushNotification-update', 'PushNotificationController@update')->name('PushNotification-update');
                Route::post('PushNotification-create', 'PushNotificationController@store')->name('PushNotification-create');
                Route::delete('PushNotification-delete', 'PushNotificationController@destroy')->name('PushNotification-delete');
            });
        });
        Route::group(['prefix'  =>  'Email-Notification'], function() {
            Route::middleware('page_denied:Email Notification')->group(function(){
                Route::get('EmailNotification-view', 'EmailNotificationController@index')->name('EmailNotification-view');
                Route::post('EmailNotification-update', 'EmailNotificationController@update')->name('EmailNotification-update');
                Route::delete('EmailNotification-delete', 'EmailNotificationController@destroy')->name('EmailNotification-delete');
                Route::post('EmailNotification-create', 'EmailNotificationController@store')->name('EmailNotification-create');
                Route::post('EmailNotification-updateimage', 'EmailNotificationController@updateimage')->name('EmailNotification-updateimage');
            });
        });
    });

    Route::group(['prefix'  =>  'Settings'], function() {
        Route::group(['prefix'  =>  'General-Setting'], function() {
            Route::middleware('page_denied:General Settings')->group(function(){
                Route::get('GeneralSetting-view', 'GeneralSettingController@index')->name('GeneralSetting-view');
                Route::post('GeneralSetting-update', 'GeneralSettingController@update')->name('GeneralSetting-update');
            });
        });
        Route::group(['prefix'  =>  'Game-Setting'], function() {
            // Route::middleware('page_denied:General Settings')->group(function(){
                Route::get('GameSetting-view', 'GameSettingController@index')->name('GameSetting-view');
            // });
        });
        // Route::group(['prefix'  =>  'Admin-Setting'], function() {
        //     Route::get('AdminSetting-view', 'AdminSettingController@index')->name('AdminSetting-view');
        //     Route::post('AdminSetting-update', 'AdminSettingController@update')->name('AdminSetting-update');
        // });
    });
});

 //logout
 Route::get('/logout', 'LoginController@logout')->name("logout");
