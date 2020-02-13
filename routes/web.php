<?php

Route::get('/', ['uses' => 'LoginController@loginbefore', 'middleware' => 'home'])->name('login');
Route::post('login', 'LoginController@login')->name('login');
Route::get('/avatars/{avatar}', 'PlayersController@avatar')->name('imageAvatar');
// Item image
Route::get('image-item/Gold/{item_id}.png', 'GoldStoreController@ImageItem')->name('imageItemGold');
Route::get('image-item/Chip/{item_id}.png', 'ChipStoreController@ImageItem')->name('imageItemChip');
Route::get('image-item/Goods/{item_id}.png', 'GoodsStoreController@ImageItem')->name('imageItemGoods');
// image gift
Route::get('image-gift/{gift_id}', 'GiftController@ImageGift')->name('imageshowgift');
Route::get('image-avatar/{avatar_id', 'AvatarPlayerController@ImageAvatar')->name('imageshowavatar');
Route::get('image-emoticon/{emot_id}', 'EmoticonController@ImageEmoticon')->name('imageshowemoticon');

Route::get('GeneralSetting-about/view', 'GeneralSettingController@AboutGame');
Route::get('GeneralSetting-PrivacyPolicy/view', 'GeneralSettingController@PrivacyPolicyGame');
Route::get('GeneralSetting-TermOfService/view', 'GeneralSettingController@TermOfServiceGame');
Route::get('GeneralSetting-about/viewhtml', 'GeneralSettingController@AboutGamehtml');
Route::get('GeneralSetting-PrivacyPolicy/viewhtml', 'GeneralSettingController@PrivacyPolicyGamehtml');
Route::get('GeneralSetting-TermOfService/viewhtml', 'GeneralSettingController@TermOfServiceGamehtml');


Route::middleware('authenticated')->group(function(){

    Route::group(['prefix' => 'Edit-Profile'], function(){
        Route::get('/profile', 'ProfileController@index')->name('profile-view');
        Route::post('/profile-password', 'ProfileController@password')->name('profile-password');
        Route::post('/Profile-update', 'ProfileController@update')->name('profile-update');
    });
    
    Route::group(['prefix' => 'Dashboard'], function() {
        Route::middleware('page_denied:Dashboard')->group(function(){
            Route::get('/home', 'DashboardController@index')->name('Dashboard');
        });
    });

    Route::group(['prefix' => 'Admin'], function() {
        Route::group(['prefix' => 'User_Admin'], function() {
            Route::middleware('page_denied:User Admin')->group(function(){
                Route::get('/Admin-view', 'UserAdminController@index')->name('User_Admin');
                Route::post('/Admin-update', 'UserAdminController@update')->name('UserAdmin-update');
                Route::post('/Admin-updatepassword', 'UserAdminController@updatepassword')->name('UserAdmin-updatepassword');
                Route::post('/Admin-create', 'UserAdminController@store')->name('UserAdmin-create');
                Route::delete('/Admin-delete', 'UserAdminController@destroy')->name('UserAdmin-delete');
                Route::delete('/Admin-deleteAll', 'UserAdminController@deleteAll')->name('UserAdmin-DeleteAllSelected');
            });
        });

        Route::group(['prefix' => 'Role_Admin'], function() {
            Route::middleware('page_denied:Role Admin')->group(function(){
                Route::get('/Role-view', 'RoleController@index')->name('Role_Admin');
                Route::post('/Role-update', 'RoleController@update')->name('Role-update');
                Route::post('/Role-create', 'RoleController@store')->name('Role-create');
                Route::get('/Role-menu/{role}', 'RoleController@menu')->name('Role-menu');
                Route::post('/Role-menu/{role}/edit', 'RoleController@menuupdate')->name('Role-menu-edit');
                Route::delete('/Role-delete', 'RoleController@destroy')->name('Role-delete');
                Route::delete('/Role-deleteAllSelected', 'RoleController@deleteAllSelected')->name('Role-DeleteAllSelected');
            });
        });

        Route::group(['prefix' => 'Log_Admin'], function() {
            Route::middleware('page_denied:Log Admin')->group(function(){
                Route::get('/Log-view', 'LogController@index')->name('Log_Admin');
                Route::get('/Log-search', 'LogController@search')->name('Log-search');
            });
        });

        Route::group(['prefix' => 'Report_Admin'], function() {
            Route::middleware('page_denied:Report Admin')->group(function() {
                Route::get('ReportAdmin-view', 'ReportAdminController@index')->name('Report_Admin');
                Route::get('ReportAdmin-search', 'ReportAdminController@Search')->name('ReportAdmin-search');
            });
        });

        Route::group(['prefix' => 'Active_Admin'], function() {
            Route::middleware('page_denied:Active Admin')->group(function(){
                Route::get('ActiveAdmin-view', 'ActiveAdminController@index')->name('Active_Admin');
            });
        });
        
    });

    Route::group(['prefix'  =>  'Transaction'], function() {
        Route::group(['prefix'  =>  'Transaction_Day'], function() {
            Route::middleware('page_denied:Transaction Day')->group(function(){
                Route::get('Transaction_Day-view', 'TransactionDayController@index')->name('Transaction_Day');
                Route::get('Transaction_Day-search', 'TransactionDayController@search')->name('TransactionDay-search');
                Route::get('Transaction_Day-search/detail', 'TransactionDayController@detail')->name('detailTransactionDay');

            });
        });

        Route::group(['prefix'  =>  'User_Bank_Transaction'], function() {
            Route::middleware('page_denied:User Bank Transaction')->group(function(){
                Route::get('User-Banking-view', 'User_Banking_TransactionController@index')->name('User_Bank_Transaction');
                Route::post('User-Banking-approve', 'User_Banking_TransactionController@approve')->name('UserBankTransaction-Approve');
                Route::post('User-Banking-decline', 'User_Banking_TransactionController@decline')->name('UserBankTransaction-Decline');
            });
        });

        Route::group(['prefix'  =>  'Reward_Transaction'], function() {
            Route::middleware('page_denied:Reward Transaction')->group(function(){
                Route::get('RewardTransaction-view', 'RewardTransactionController@index')->name('Reward_Transaction');
                Route::post('Reward-Transaction-Approve', 'RewardTransactionController@approve')->name('RewardTransaction-Approve');
                Route::post('Reward-Transaction-Decline', 'RewardTransactionController@decline')->name('RewardTransaction-Decline');
                Route::post('Reward-Transaction-DeliveryProgress', 'RewardTransactionController@DeliveryProgress')->name('RewardTransaction-DeliveryProgress');
            });
        });

        Route::group(['prefix'  =>  'Add_Transaction'], function() {
            Route::middleware('page_denied:Add Transaction')->group(function(){
                Route::get('AddTransaction-view', 'Add_TransactionController@index')->name('Add_Transaction');
                Route::get('AddTrasanction-search', 'Add_TransactionController@search')->name('AddTransaction-search');
                Route::post('AddvalueCurrency', 'Add_TransactionController@update')->name('AddTransaction-update');
            });
        });

        Route::group(['prefix'  =>  'Transaction_Point'], function() {
            Route::middleware('page_denied:Transaction Point')->group(function(){
                Route::get('Transaction_Point-view', 'TransactionPointController@index')->name('Transaction_Point');
                Route::get('Transaction_Point-search', 'TransactionPointController@search')->name('TransactionPoint-search');
                Route::get('Transaction_Point-search/detail', 'TransactionPointController@detail')->name('detailTransactionPoint');

            });
        });
    });

    Route::group(['prefix'  =>  'Players'], function() {
        Route::group(['prefix'  =>  'Active_Players'], function() {
            Route::middleware('page_denied:Active Players')->group(function(){
                Route::get('Active-view', 'PlayersController@indexActive')->name('Active_Players');
                Route::get('Active-search', 'PlayersController@searchactive')->name('ActivePlayers-search');
            });
        });

        Route::group(['prefix'  =>  'Report_Players'], function() {
            Route::middleware('page_denied:Report Player')->group(function(){
                Route::get('ReportPlayer-view', 'ReportPlayerController@index')->name('Report_Players');
                Route::get('ReportPlayer-search', 'ReportPlayerController@search')->name('ReportPlayer-search');
            });
        });

        Route::group(['prefix'  =>  'High_Roller'], function() {
            Route::middleware('page_denied:High Rollers')->group(function(){
                Route::get('HighRoller-view', 'PlayersController@indexHighRoller')->name('High_Roller');
            });
        });

        Route::group(['prefix'  =>  'Registered_Players'], function() {
            Route::middleware('page_denied:Registered Player')->group(function(){
                Route::get('RegisteredPlayer-view', 'PlayersController@indexRegisteredPlayer')->name('Registered_Players');
                Route::get('RegisteredPlayer-search', 'PlayersController@SearchRegisteredPlayer')->name('RegisteredPlayer-search');
                Route::post('RegisteredPlayer-update', 'PlayersController@updateBannedAccount')->name('RegisteredPlayer-update');
                Route::get('loguser/{user_id}', 'PlayersController@loguserregister')->name('showloguser');
                Route::get('RegisteredPlayer-profile/{userId}/detail', 'PlayersController@detailRegistered')->name('RegisteredPlayer-detaildevice');
                Route::get('profile/{user_id}.jpg', 'PlayersController@ImageProfilePlayer')->name('image-profile');
            });
        });

        Route::group(['prefix'  =>  'Guest'], function() {
            Route::middleware('page_denied:Guest')->group(function(){
                Route::get('Guest-view', 'PlayersController@indexGuest')->name('Guest');
                Route::get('Guest-search', 'PlayersController@searchGuest')->name('Guest-search');
                Route::post('Guest-create', 'PlayersController@storeGuest')->name('Guest-create');
            });
        });

        Route::group(['prefix'  =>  'Bots'], function() {
            Route::middleware('page_denied:Bots')->group(function(){
                Route::get('Bots-view', 'PlayersController@indexBots')->name('Bots');
                Route::post('Bots-update', 'PlayersController@updateBot')->name('Bots-update');
                Route::post('Bots-create', 'PlayersController@storeBots')->name('Bots-create');
                Route::delete('Bots-delete', 'PlayersController@destroyBots')->name('Bots-delete');
            });
        });

        Route::group(['prefix'  =>  'Play_Report'], function() {
            Route::middleware('page_denied:Play Report')->group(function(){
                Route::get('PlayReport-view', 'PlayReportController@index')->name('Play_Report');
                Route::get('PlayReport-search', 'PlayReportController@search')->name('PlayReport-search');
            });
        });

        Route::group(['prefix'  =>  'Chip_Players'], function() {
            Route::middleware('page_denied:Chip Player')->group(function(){
                Route::get('Chip-view', 'ChipController@index')->name('Chip_Players');
                Route::get('Chip-search', 'ChipController@search')->name('Chip-search');
                Route::get('Chip-all', 'ChipController@registerplayerchip')->name('chip_detail');
            });
        });

        Route::group(['prefix'  =>  'Gold_Players'], function() {
            Route::middleware('page_denied:Gold Player')->group(function(){
                Route::get('Gold-view', 'GoldController@index')->name('Gold_Players');
                Route::get('Gold-search', 'GoldController@search')->name('Gold-search');
                Route::get('Gold-all', 'GoldController@registerplayergold')->name('gold_detail');
            });
        });

        Route::group(['prefix'  =>  'Point_Players'], function() {
            Route::middleware('page_denied:Point Player')->group(function(){
                Route::get('Point-view', 'PointController@index')->name('Point_Players');
                Route::get('Point-search', 'PointController@search')->name('Point-search');
                Route::get('Point-all', 'PointController@registerplayerpoint')->name('point_detail');
            });
        });

        Route::group(['prefix'  =>  'Log_Players'], function() {
            Route::middleware('page_denied:Log Player')->group(function(){
                Route::get('LogPlayer-view', 'LogPlayerController@index')->name('Log_Players');
                Route::get('LogPlayer', 'LogPlayerController@search')->name('LogPlayer-search');
            });
        });
        
        Route::group(['prefix' => 'Register_Player_ID'], function() {
            Route::middleware('page_denied:Register Player ID')->group(function(){
                Route::get('RegisterPlayerID-view', 'RegisterPlayerIdController@index')->name('Register_Player_ID');
                Route::post('RegisterPlayerID-create', 'RegisterPlayerIdController@store')->name('RegisterPlayerID-create');
            });
        });

        Route::group(['prefix'  =>  'Transaction_Players'], function() {
            Route::middleware('page_denied:Transaction Players')->group(function(){
                Route::get('Banking-view', 'TransactionPlayersController@index')->name('Transaction_Players');
                Route::get('Banking-search', 'TransactionPlayersController@search')->name('TransactionPlayers-search');
                Route::get('Banking-search/detail', 'TransactionPlayersController@detail')->name('detailTransactionPlayers');

            });
        });

        Route::group(['prefix'  =>  'Players_Level'], function() {
            Route::middleware('page_denied:Players Level')->group(function(){
                Route::get('PlayersLevel-view', 'PlayersLevelController@index')->name('Players_Level');
                Route::post('PlayersLevel-LevelCreate', 'PlayersLevelController@store')->name('playerslevel_create');
                Route::post('PlayersLevel-RankCreate', 'PlayersLevelController@store_rank')->name('playersrank_create');
                Route::post('PlayersLevel-LevelUpdate', 'PlayersLevelController@update')->name('playerslevel_update');
                Route::post('PlayersLevel-RankUpdate', 'PlayersLevelController@update_rank')->name('playersrank_update'); 
                Route::delete('PlayersLevel-LevelDelete', 'PlayersLevelController@destroy')->name('playerslevel_delete');
                Route::delete('PlayersLevel-RankDelete', 'PlayersLevelController@destroy_rank')->name('playersrank_delete'); 
                Route::delete('PlayersLevel-DeleteAlllevel', 'PlayersLevelController@delete_all')->name('playerslevel_deleteall');
                Route::delete('PlayersLevel-DeleteAllrank', 'PlayersLevelController@delete_allRank')->name('playersrank_deleteall');
            });
        });

        Route::group(['prefix'  =>  'Avatar_player'], function() {
            Route::middleware('page_denied:avatar player')->group(function(){
                Route::get('AvaPlayer-view', 'AvatarPlayerController@index')->name('avatar_player');
                Route::post('AvaPlayer-AvaCreate', 'AvatarPlayerController@store')->name('avatar_playerCreate');
                Route::delete('AvaPlayer-AvaDelete', 'AvatarPlayerController@destroy')->name('avatar_playerDelete');
                Route::delete('AvaPlayer-AvaDeleteAll', 'AvatarPlayerController@deleteAll')->name('avatar_playerDelete-DeleteAllSelected');
                Route::post('AvaPlayer-AvaUpdateImage', 'AvatarPlayerController@updateImage')->name('avatar_playerUpdateImage');
                Route::post('AvaPlayer-AvaUpdate', 'AvatarPlayerController@update')->name('avatar_playerUpdate');
            });
        });
    });

    Route::group(['prefix'  =>  'Slide_Banner'], function() {
            Route::middleware('page_denied:Slide Banner')->group(function(){
                Route::get('SlideBanner-view', 'SlideBannerController@index')->name('Slide_Banner');
                Route::post('SlideBanner-update', 'SlideBannerController@update')->name('SlideBanner-update');
                Route::post('SlideBanner-updateimage', 'SlideBannerController@updateimage')->name('SlideBanner-updateimage');
                Route::delete('SlideBanner-delete', 'SlideBannerController@destroy')->name('SlideBanner-delete');
                Route::post('SlideBanner-create', 'SlideBannerController@store')->name('SlideBanner-create');
            });
    });

    Route::group(['prefix'  =>  'Item'], function() {

        Route::group(['prefix' => 'Table_Gift'], function() {
            Route::middleware('page_denied:Table Gift')->group(function(){
                Route::get('TableGift-view', 'GiftController@index')->name('Table_Gift');
                Route::post('TableGift-update', 'GiftController@update')->name('TableGift-update');
                Route::post('TableGift-updateimage', 'GiftController@updateimage')->name('TableGift-updateimage');
                Route::delete('TableGift-delete', 'GiftController@destroy')->name('TableGift-delete');
                Route::post('TableGift-create', 'GiftController@store')->name('TableGift-create');
                Route::delete('TableGift-deleteAllSelected', 'GiftController@deleteAllSelected')->name('TableGift-deleteAllSelected');

            });
        });

        Route::group(['prefix' => 'Report_Gift'], function() {
            Route::middleware('page_denied:Report Gift')->group(function(){
                Route::get('ReportGift-view', 'ReportGiftController@index')->name('Report_Gift');
                Route::get('ReportGift-search', 'ReportGiftController@search')->name('ReportGift-search');
            });
        });

        Route::group(['prefix' => 'Emoticon'], function() {
            Route::middleware('page_denied:Emoticon')->group(function(){
                Route::get('Emoticon-view', 'EmoticonController@index')->name('Emoticon');
                Route::post('Emoticon-update', 'EmoticonController@update')->name('Emoticon-update');
                Route::post('Emoticon-UpdateImage', 'EmoticonController@updateimage')->name('Emoticon-updateimage');
                Route::post('Emoticon-create', 'EmoticonController@store')->name('Emoticon-create');
                Route::delete('Emoticon-delete', 'EmoticonController@destroy')->name('Emoticon-delete');
                Route::delete('Emoticon-deleteAllSelected', 'EmoticonController@deleteAllSelected')->name('Emoticon-deleteAllSelected');
            });
        });

    });

    // Game Asta Poker
    Route::group(['prefix' => 'Game'], function(){


        Route::group(['prefix'  =>  'Asta-Poker'], function() {
            Route::group(['prefix'  => 'Table_Asta_Poker'], function() {
                Route::middleware('page_denied:Table Asta Poker')->group(function(){
                    Route::get('Table-view', 'TableController@index')->name('Table_Asta_Poker');
                    Route::post('Table-update', 'TableController@update')->name('Table-update');
                    Route::post('Table-create', 'TableController@store')->name('Table-create');
                    Route::delete('Table-delete', 'TableController@destroy')->name('Table-delete');
                    Route::delete('Table-deleteAllTpk', 'TableController@deleteAllSelectedTpk')->name('Table-deleteAllTpk');
                });
            });

            Route::group(['prefix'  => 'Category_Asta_Poker'], function() {
                Route::middleware('page_denied:Category Asta Poker')->group(function(){
                    Route::get('Category-view', 'CategoryController@index')->name('Category_Asta_Poker');
                    Route::post('Category-create', 'CategoryController@store')->name('Category-create');
                    Route::post('Category-update', 'CategoryController@update')->name('Category-update');
                    Route::delete('Category-delete', 'CategoryController@destroy')->name('Category-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Asta_Poker'], function() {
                Route::middleware('page_denied:Season Asta Poker')->group(function(){
                    Route::get('Season-view', 'SeasonController@index')->name('Season_Asta_Poker');
                    Route::post('Season-create', 'SeasonController@store')->name('Season-create');
                    Route::post('Season-update', 'SeasonController@update')->name('Season-update');
                    Route::delete('Season-delete', 'SeasonController@destroy')->name('Season-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Reward_Asta_Poker'], function() {
                Route::middleware('page_denied:Season Reward Asta Poker')->group(function(){
                    Route::get('SeasonReward-view', 'SeasonRewardController@index')->name('Season_Reward_Asta_Poker');
                    Route::post('SeasonReward-create', 'SeasonRewardController@store')->name('SeasonReward-create');
                    Route::post('SeasonReward-update', 'SeasonRewardController@update')->name('SeasonReward-update');
                    Route::delete('SeasonReward-delete', 'SeasonRewardController@destroy')->name('SeasonReward-delete');
                });
            });

            Route::group(['prefix'  => 'Tournament_Asta_Poker'], function() {
                Route::middleware('page_denied:Tournament Asta Poker')->group(function(){
                    Route::get('Tournament-view', 'TournamentController@index')->name('Tournament_Asta_Poker');
                    Route::post('Tournament-create', 'TournamentController@store')->name('Tournament-create');
                    Route::post('Tournament-update', 'TournamentController@update')->name('Tournament-update');
                });
            });

            Route::group(['prefix'  => 'Jackpot_Paytable_Asta_Poker'], function() {
                Route::middleware('page_denied:Jackpot Paytable Asta Poker')->group(function(){
                    Route::get('JackpotPaytable-view', 'JackpotPaytableController@index')->name('Jackpot_Paytable_Asta_Poker');
                    Route::post('JackpotPaytable-update', 'JackpotPaytableController@update')->name('JackpotPaytable-update');
                });
            });
           

            Route::group(['prefix'  =>  'Monitoring_Table_Asta_Poker'], function() {
                Route::middleware('page_denied:Monitoring Table Asta Poker')->group(function(){
                    Route::get('Monitor_Asta_Poker-view', 'AstaPokerMonitoringTableController@index')->name('Monitoring_Table_Asta_Poker'); 
                    Route::get('Monitor_Asta_Poker-intermediate', 'AstaPokerMonitoringTableController@indexIntermediate')->name('Monitoring_Table_Asta_Poker-intermediate'); 
                    Route::get('Monitor_Asta_Poker-pro', 'AstaPokerMonitoringTableController@indexPro')->name('Monitoring_Table_Asta_Poker-pro');   
                    Route::get('Monitor_Asta_Poker-Game', 'AstaPokerMonitoringTableController@Game')->name('Monitoring_Table_Asta_Poker-game');                    
                });
            });

        });


        // Game Asta Big 2
        Route::group(['prefix'  =>  'Big-Two'], function() {
            Route::group(['prefix'  => 'Table_Big_Two'], function() {
                Route::middleware('page_denied:Table Big Two')->group(function(){
                    Route::get('BigTwoTable-view', 'TableController@BigTwoindex')->name('Table_Big_Two');
                    Route::post('BigTwoTable-update', 'TableController@BigTwoupdate')->name('BigTwoTable-update');
                    Route::post('BigTwoTable-create', 'TableController@BigTwostore')->name('BigTwoTable-create');
                    Route::delete('BigTwoTable-delete', 'TableController@BigTwodestroy')->name('BigTwoTable-delete');
                    Route::delete('BigTwoTable-deleteAllB2', 'TableController@BigTwoDeleteAll')->name('BigTwoTable-deleteAllB2');
                });
            });

            Route::group(['prefix'  => 'Category_Big_Two'], function() {
                Route::middleware('page_denied:Category Big Two')->group(function(){
                    Route::get('BigTwoCategory-view', 'CategoryController@BigTwoindex')->name('Category_Big_Two');
                    Route::post('BigTwoCategory-create', 'CategoryController@BigTwostore')->name('BigTwoCategory-create');
                    Route::post('BigTwoCategory-update', 'CategoryController@BigTwoupdate')->name('BigTwoCategory-update');
                    Route::delete('BigTwoCategory-delete', 'CategoryController@BigTwodestroy')->name('BigTwoCategory-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Big_Two'], function() {
                Route::middleware('page_denied:Season Big Two')->group(function(){
                    Route::get('BigTwoSeason-view', 'SeasonController@BigTwoindex')->name('Season_Big_Two');
                    Route::post('BigTwoSeason-create', 'SeasonController@BigTwostore')->name('BigTwoSeason-create');
                    Route::post('BigTwoSeason-update', 'SeasonController@BigTwoupdate')->name('BigTwoSeason-update');
                    Route::delete('BigTwoSeason-delete', 'SeasonController@BigTwodestroy')->name('BigTwoSeason-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Reward_Big_Two'], function() {
                Route::middleware('page_denied:Season Reward Big Two')->group(function(){
                    Route::get('BigTwoSeasonReward-view', 'SeasonRewardController@BigTwoindex')->name('Season_Reward_Big_Two');
                    Route::post('BigTwoSeasonReward-create', 'SeasonRewardController@BigTwostore')->name('BigTwoSeasonReward-create');
                    Route::post('BigTwoSeasonReward-update', 'SeasonRewardController@BigTwoupdate')->name('BigTwoSeasonReward-update');
                    Route::delete('BigTwoSeasonReward-delete', 'SeasonRewardController@BigTwodestroy')->name('BigTwoSeasonReward-delete');
                });
            });

            Route::group(['prefix'  => 'Tournament_Big_Two'], function() {
                Route::middleware('page_denied:Tournament Big Two')->group(function(){
                    Route::get('BigTwoTournament-view', 'TournamentController@BigTwoindex')->name('Tournament_Big_Two');
                    Route::post('BigTwoTournament-create', 'TournamentController@BigTwostore')->name('BigTwoTournament-create');
                    Route::post('BigTwoTournament-update', 'TournamentController@BigTwoupdate')->name('BigTwoTournament-update');
                });
            });

            Route::group(['prefix'  => 'Jackpot_Paytable_Big_Two'], function() {
                Route::middleware('page_denied:Jackpot Paytable Big Two')->group(function(){
                    Route::get('BigTwoJackpotPaytable-view', 'JackpotPaytableController@index')->name('Jackpot_Paytable_Big_Two');
                    Route::post('BigTwoJackpotPaytable-update', 'JackpotPaytableController@BigTwoupdate')->name('BigTwoJackpotPaytable-update');
                });
            });

            
            Route::group(['prefix' => 'Monitoring_Table_Big_Two'], function() {
                Route::middleware('page_denied:Monitoring Table Big Two')->group(function(){
                    Route::get('Monitoring_Big_Two-view', 'BigTwoMonitoringTableController@index')->name('Monitoring_Table_Big_Two');
                    Route::get('Monitor_Big_Two-intermediate', 'BigTwoMonitoringTableController@indexIntermediate')->name('Monitoring_Table_Big_Two-intermediate'); 
                    Route::get('Monitor_Big_Two-pro', 'BigTwoMonitoringTableController@indexPro')->name('Monitoring_Table_Big_Two-pro'); 
                    Route::get('Monitoring_Big_Two_Game', 'BigTwoMonitoringTableController@Game')->name('Monitoring_Table_Big_Two-game');
                });
            });
        });

        // Game Asta Domino Susun
        Route::group(['prefix'  =>  'Domino-Susun'], function() {
            Route::group(['prefix'  => 'Table_Domino_Susun'], function() {
                Route::middleware('page_denied:Table Domino Susun')->group(function(){
                    Route::get('DominoSTable-view', 'TableController@DominoSusunindex')->name('Table_Domino_Susun');
                    Route::post('DominoSTable-update', 'TableController@DominoSusunupdate')->name('DominoSTable-update');
                    Route::post('DominoSTable-create', 'TableController@DominoSusunstore')->name('DominoSTable-create');
                    Route::delete('DominoSTable-delete', 'TableController@DominoSusundestroy')->name('DominoSTable-delete');
                    Route::delete('DominoSTable-deleteAllDominoS', 'TableController@DominoSDeleteAll')->name('DominoSTable-deleteAllDominoS');
                });
            });

            Route::group(['prefix'  => 'Category_Domino_Susun'], function() {
                Route::middleware('page_denied:Category Domino Susun')->group(function(){
                    Route::get('DominoSCategory-view', 'CategoryController@DominoSusunindex')->name('Category_Domino_Susun');
                    Route::post('DominoSCategory-create', 'CategoryController@DominoSusunstore')->name('DominoSCategory-create');
                    Route::post('DominoSCategory-update', 'CategoryController@DominoSusunupdate')->name('DominoSCategory-update');
                    Route::delete('DominoSCategory-delete', 'CategoryController@DominoSusundestroy')->name('DominoSCategory-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Domino_Susun'], function() {
                Route::middleware('page_denied:Season Domino Susun')->group(function(){
                    Route::get('DominoSSeason-view', 'SeasonController@BigTwoindex')->name('Season_Domino_Susun');
                    Route::post('DominoSSeason-create', 'SeasonController@BigTwostore')->name('DominoSSeason-create');
                    Route::post('DominoSSeason-update', 'SeasonController@BigTwoupdate')->name('DominoSSeason-update');
                    Route::delete('DominoSSeason-delete', 'SeasonController@BigTwodestroy')->name('DominoSSeason-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Reward_Domino_Susun'], function() {
                Route::middleware('page_denied:Season Reward Domino Susun')->group(function(){
                    Route::get('DominoSSeasonReward-view', 'SeasonRewardController@BigTwoindex')->name('Season_Reward_Domino_Susun');
                    Route::post('DominoSSeasonReward-create', 'SeasonRewardController@BigTwostore')->name('DominoSSeasonReward-create');
                    Route::post('DominoSSeasonReward-update', 'SeasonRewardController@BigTwoupdate')->name('DominoSSeasonReward-update');
                    Route::delete('DominoSSeasonReward-delete', 'SeasonRewardController@BigTwodestroy')->name('DominoSSeasonReward-delete');
                });
            });

            Route::group(['prefix'  => 'Tournament_Domino_Susun'], function() {
                Route::middleware('page_denied:Tournament Domino Susun')->group(function(){
                    Route::get('DominoSTournament-view', 'TournamentController@BigTwoindex')->name('Tournament_Domino_Susun');
                    Route::post('DominoSTournament-create', 'TournamentController@BigTwostore')->name('DominoSTournament-create');
                    Route::post('DominoSTournament-update', 'TournamentController@BigTwoupdate')->name('DominoSTournament-update');
                });
            });

            Route::group(['prefix'  => 'Jackpot_Paytable_Domino_Susun'], function() {
                Route::middleware('page_denied:Jackpot Paytable Domino Susun')->group(function(){
                    Route::get('DominoSJackpotPaytable-view', 'JackpotPaytableController@index')->name('Jackpot_Paytable_Domino_Susun');
                    Route::post('DominoSJackpotPaytable-update', 'JackpotPaytableController@BigTwoupdate')->name('DominoSJackpotPaytable-update');
                });
            });

            Route::group(['prefix'  =>  'Monitoring_Table_DominoS'], function() {
                Route::middleware('page_denied:Monitoring Table Domino Susun')->group(function(){
                   Route::get('Monitoring_Domino_Susun-view', 'DominoSusunMonitoringTableController@index')->name('Monitoring_Table_DominoS');
                   Route::get('Monitoring_Domino_Susun-intermediate', 'DominoSusunMonitoringTableController@indexIntermediate')->name('Monitoring_Table_DominoS-intermediate');
                   Route::get('Monitoring_Domino_Susun-pro', 'DominoSusunMonitoringTableController@indexPro')->name('Monitoring_Table_DominoS-pro');
                   Route::get('Monitoring_Domino_Susun-Game', 'DominoSusunMonitoringTableController@Game')->name('Monitoring_Table_DominoS-game'); 
                });
            });
        });

        // Game Asta Domino QQ
        Route::group(['prefix'  =>  'Domino-QQ'], function() {
            Route::group(['prefix'  => 'Table_Domino_QQ'], function() {
                Route::middleware('page_denied:Table Domino QQ')->group(function(){
                    Route::get('DominoQTable-view', 'TableController@DominoQindex')->name('Table_Domino_QQ');
                    Route::post('DominoQTable-update', 'TableController@DominoQupdate')->name('DominoQTable-update');
                    Route::post('DominoQTable-create', 'TableController@DominoQstore')->name('DominoQTable-create');
                    Route::delete('DominoQTable-delete', 'TableController@DominoQdestroy')->name('DominoQTable-delete');
                    Route::delete('DominoQTable-deleteAllDominoQ', 'TableController@DominoQDeleteAll')->name('DominoQTable-deleteAllDominoQ');
                });
            });

            Route::group(['prefix'  => 'Category_Domino_QQ'], function() {
                Route::middleware('page_denied:Category Domino QQ')->group(function(){
                    Route::get('DominoQCategory-view', 'CategoryController@DominoQindex')->name('Category_Domino_QQ');
                    Route::post('DominoQCategory-create', 'CategoryController@DominoQstore')->name('DominoQCategory-create');
                    Route::post('DominoQCategory-update', 'CategoryController@DominoQupdate')->name('DominoQCategory-update');
                    Route::delete('DominoQCategory-delete', 'CategoryController@DominoQdestroy')->name('DominoQCategory-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Domino_QQ'], function() {
                Route::middleware('page_denied:Season Domino QQ')->group(function(){
                    Route::get('DominoQSeason-view', 'SeasonController@BigTwoindex')->name('Season_Domino_QQ');
                    Route::post('DominoQSeason-create', 'SeasonController@DominoQstore')->name('DominoQSeason-create');
                    Route::post('DominoQSeason-update', 'SeasonController@DominoQupdate')->name('DominoQSeason-update');
                    Route::delete('DominoQSeason-delete', 'SeasonController@DominoQdestroy')->name('DominoQSeason-delete');
                });
            });

            Route::group(['prefix'  => 'Season_Reward_Domino_QQ'], function() {
                Route::middleware('page_denied:Season Reward Domino QQ')->group(function(){
                    Route::get('DominoQSeasonReward-view', 'SeasonRewardController@BigTwoindex')->name('Season_Reward_Domino_QQ');
                    Route::post('DominoQSeasonReward-create', 'SeasonRewardController@DominoQstore')->name('DominoQSeasonReward-create');
                    Route::post('DominoQSeasonReward-update', 'SeasonRewardController@DominoQupdate')->name('DominoQSeasonReward-update');
                    Route::delete('DominoQSeasonReward-delete', 'SeasonRewardController@DominoQdestroy')->name('DominoQSeasonReward-delete');
                });
            });

            Route::group(['prefix'  => 'Tournament_Domino_QQ'], function() {
                Route::middleware('page_denied:Tournament Domino QQ')->group(function(){
                    Route::get('DominoQTournament-view', 'TournamentController@BigTwoindex')->name('Tournament_Domino_QQ');
                    Route::post('DominoQTournament-create', 'TournamentController@DominoQstore')->name('DominoQTournament-create');
                    Route::post('DominoQTournament-update', 'TournamentController@DominoQupdate')->name('DominoQTournament-update');
                });
            });

            Route::group(['prefix'  => 'Jackpot_Paytable_Domino_QQ'], function() {
                Route::middleware('page_denied:Jackpot Paytable Domino QQ')->group(function(){
                    Route::get('DominoQJackpotPaytable-view', 'JackpotPaytableController@index')->name('Jackpot_Paytable_Domino_QQ');
                    Route::post('DominoQJackpotPaytable-update', 'JackpotPaytableController@DominoQupdate')->name('DominoQJackpotPaytable-update');
                });
            });

            Route::group(['prefix' => 'Monitoring_Table_DominoQ'], function() {
                Route::middleware('page_denied:Monitoring Table Domino QQ')->group(function(){
                    Route::get('Monitoring_Domino_QQ-view', 'DominoQQMonitoringTableController@index')->name('Monitoring_Table_DominoQ');
                    Route::get('Monitoring_Domino_QQ-intermediate', 'DominoQQMonitoringTableController@indexIntermediate')->name('Monitoring_Table_DominoQ-intermediate');
                    Route::get('Monitoring_Domino_QQ-pro', 'DominoQQMonitoringTableController@indexPro')->name('Monitoring_Table_DominoQ-pro');
                    Route::get('Monitoring_Domino_QQ-Game', 'DominoQQMonitoringTableController@Game')->name('Monitoring_Table_DominoQ-game');
                });
            });

        });

        //Game Setting 
        Route::group(['prefix'  =>  'Game_Setting'], function() {
            Route::middleware('page_denied:Game Setting')->group(function(){
                Route::get('GameSetting-view', 'GameSettingController@index')->name('Game_Setting');
                Route::post('GameSetting-updateTpk', 'GameSettingController@updateTpk')->name('GameSetting-updateTpk');
                Route::post('GameSetting-updateBgt', 'GameSettingController@updateBgt')->name('GameSetting-updateBgt');
                Route::post('GameSetting-updateDms', 'GameSettingController@updateDms')->name('GameSetting-updateDms');
                Route::post('GameSetting-updateDmq', 'GameSettingController@updateDmq')->name('GameSetting-updateDmq');
            });
        });

    });

    Route::group(['prefix' => 'Store'], function() {
        Route::group(['prefix'  =>  'Best_Offer'], function() {
            Route::middleware('page_denied:Best Offer')->group(function(){
                Route::get('BestOffer-view', 'BestOfferController@index')->name('Best_Offer');
            });
        });
        Route::group(['prefix'  =>  'Chip_Store'], function() {
            Route::middleware('page_denied:Chip Store')->group(function(){
                Route::get('ChipStore-view', 'ChipStoreController@index')->name('Chip_Store');
                Route::post('ChipStore-update', 'ChipStoreController@update')->name('ChipStore-update');
                Route::post('ChipStore-updateimage','ChipStoreController@updateImage')->name('ChipStore-updateimage');
                Route::post('ChipStore-updateimageBonus', 'ChipStoreController@updateImageBonus')->name('ChipStore-updateimageBonus');
                Route::post('ChipStore-create', 'ChipStoreController@store')->name('ChipStore-create');
                Route::delete('ChipStore-delete', 'ChipStoreController@destroy')->name('ChipStore-delete');
                Route::delete('ChipStore-deleteAllSelected', 'ChipStoreController@deleteAllSelected')->name('ChipStore-deleteAllSelected');
            });
        });
        Route::group(['prefix'  =>  'Gold_Store'], function() {
            Route::middleware('page_denied:Gold Store')->group(function(){
                Route::get('GoldStore-view', 'GoldStoreController@index')->name('Gold_Store');
                Route::post('GoldStore-create', 'GoldStoreController@store')->name('GoldStore-create');
                Route::post('GoldStore-update', 'GoldStoreController@update')->name('GoldStore-update');
                Route::post('GoldStore-updateimage', 'GoldStoreController@updateimage')->name('GoldStore-updateimage');
                Route::post('GoldStore-updateimageBonus', 'GoldStoreController@updateImageBonus')->name('GoldStore-updateimageBonus');
                Route::delete('GoldStore-delete', 'GoldStoreController@destroy')->name('GoldStore-delete');
                Route::delete('GoldStore-deleteAllSelected', 'GoldStoreController@deleteAllSelected')->name('GoldStore-deleteAllSelected');
            });
        });
        Route::group(['prefix'  =>  'Goods_Store'], function() {
            Route::middleware('page_denied:Goods Store')->group(function(){
                Route::get('GoodsStore-view', 'GoodsStoreController@index')->name('Goods_Store');
                Route::post('GoodsStore-update', 'GoodsStoreController@update')->name('GoodsStore-update');
                Route::post('GoodsStore-updateimage', 'GoodsStoreController@updateimage')->name('GoodsStore-updateimage');
                Route::delete('GoodsStore-delete', 'GoodsStoreController@destroy')->name('GoodsStore-delete');
                Route::post('GoodsStore-create', 'GoodsStoreController@store')->name('GoodsStore-create');
                Route::delete('GoodsStore-deleteAllSelected', 'GoodsStoreController@deleteAllSelected')->name('GoodsStore-deleteAllSelected');
            });
        });
        // Route::group(['prefix'  =>  'Transaction-Store'], function() {
        //     Route::middleware('page_denied:Transaction Store')->group(function(){
        //         Route::get('TransactionStore-view', 'TransactionStoreController@index')->name('TransactionStore-view');
        //     });
        // });
        Route::group(['prefix'  =>  'Payment_Store'], function() {
            Route::middleware('page_denied:Payment Store')->group(function(){
                Route::get('PaymentStore-view', 'PaymentStoreController@index')->name('Payment_Store');
                Route::post('PaymentStore-update', 'PaymentStoreController@update')->name('PaymentStore-update');
                Route::post('PaymentStore-create', 'PaymentStoreController@store')->name('PaymentStore-create');
                Route::delete('PaymentStore-delete', 'PaymentStoreController@destroy')->name('PaymentStore-delete');
                Route::delete('PaymentStore-deleteAllSelected', 'PaymentStoreController@deleteAllSelectedpayment')->name('PaymentStore-deleteAllSelected');
            });
        });
        Route::group(['prefix'  =>  'Report_Store'], function() {
            Route::middleware('page_denied:Report Store')->group(function(){
                Route::get('ReportStore-view', 'ReportStoreController@index')->name('Report_Store');
                Route::get('ReportStore-search', 'ReportStoreController@search')->name('ReportStore-search');
            });
        });
    });

    Route::group(['prefix'  =>  'Notification'], function() {
        Route::group(['prefix'  =>  'Push_Notification'], function() {
            Route::middleware('page_denied:Push Notification')->group(function(){
                Route::get('PushNotification-view', 'PushNotificationController@index')->name('Push_Notification');
                Route::post('PushNotification-update', 'PushNotificationController@update')->name('PushNotification-update');
                Route::post('PushNotification-create', 'PushNotificationController@store')->name('PushNotification-create');
                Route::delete('PushNotification-delete', 'PushNotificationController@destroy')->name('PushNotification-delete');
            });
        });
        Route::group(['prefix'  =>  'Email_Notification'], function() {
            Route::middleware('page_denied:Email Notification')->group(function(){
                Route::get('EmailNotification-view', 'EmailNotificationController@index')->name('Email_Notification');
                Route::post('EmailNotification-update', 'EmailNotificationController@update')->name('EmailNotification-update');
                Route::delete('EmailNotification-delete', 'EmailNotificationController@destroy')->name('EmailNotification-delete');
                Route::post('EmailNotification-create', 'EmailNotificationController@store')->name('EmailNotification-create');
                Route::post('EmailNotification-updateimage', 'EmailNotificationController@updateimage')->name('EmailNotification-updateimage');
            });
        });
    });

    Route::group(['prefix'  =>  'FeedBack'], function() {
        Route::group(['prefix' => 'Report_Abuse_Player'], function(){
            Route::middleware('page_denied:Report Abuse Player')->group(function(){
                Route::get('ReportAbusePlayer-view', 'ReportAbusePlayerController@index')->name('Report_Abuse_Player');
                Route::get('ReportAbusePlayer-search', 'ReportAbusePlayerController@search')->name('ReportAbusePlayer-search');
            });
        });

        Route::group(['prefix' => 'Feedback_Game'], function() {
            Route::middleware('page_denied:Feedback Game')->group(function(){
                Route::get('FeedbackGame-view', 'FeedbackGameController@index')->name('Feedback_Game');
                Route::get('FeedbackGameAll-PDF', 'FeedbackGameController@pdfall')->name('FeedbackGame-PDFall');
                Route::get('FeedbackGamePersonal-PDF/{feedbackgame}', 'FeedbackGameController@pdfpersonal')->name('FeedbackGame-PDFpersonal');
            });
        });

        Route::group(['prefix' => 'Abuse_Transaction_Report'], function(){
            Route::middleware('page_denied:Abuse Transaction Report')->group(function(){
                Route::get('AbuseTransactionReport-view', 'AbuseTransactionReportController@index')->name('Abuse_Transaction_Report');
                Route::get('AbuseTransactionReportAll-PDF', 'AbuseTransactionReportController@pdfall')->name('AbuseTransactionReport-PDFall');
                Route::get('AbuseTransactionReportPersonal-PDF/{reporttransaction}', 'AbuseTransactionReportController@pdfpersonal')->name('AbuseTransactionReport-PDFpersonal');
                Route::get('AbuseTransactionReport-search', 'AbuseTransactionReportController@search')->name('AbuseTransactionReport-search');
            });
        });
    });

    Route::group(['prefix'  =>  'Settings'], function() {
        Route::group(['prefix'  =>  'General_Setting'], function() {
            Route::middleware('page_denied:General Setting')->group(function(){
                Route::get('GeneralSetting-view', 'GeneralSettingController@index')->name('General_Setting');
                Route::post('GeneralSetting-update', 'GeneralSettingController@update')->name('GeneralSetting-update');
                Route::post('GeneralSetting-about', 'GeneralSettingController@putAbout')->name('AboutGeneralSetting');
            });
        });

        // Route::group(['prefix'  =>  'Admin-Setting'], function() {
        //     Route::get('AdminSetting-view', 'AdminSettingController@index')->name('AdminSetting-view');
        //     Route::post('AdminSetting-update', 'AdminSettingController@update')->name('AdminSetting-update');
        // });
    });


    Route::group(['prefix' => 'Reseller'], function() {
        Route::group(['prefix'  =>  'List_Reseller'], function() {
            Route::middleware('page_denied:List Reseller')->group(function(){
                Route::get('List-Reseller-view', 'ResellerController@index')->name('List_Reseller');
                Route::post('List-Reseller-update', 'ResellerController@update')->name('ListReseller-update');
                Route::delete('List-Reseller-delete', 'ResellerController@destroy')->name('ListReseller-delete');
                Route::post('List-Reseller-Password-update', 'ResellerController@PasswordUpdate')->name('ListResellerPassword-update');
                Route::delete('List-Reseller-deleteAllSelected', 'ResellerController@deleteAllSelected')->name('ListReseller-deleteAllSelected');
            });
        });

        Route::group(['prefix' => 'Reseller-Transaction'], function() {
            Route::group(['prefix' => 'Transaction_Day_Reseller'], function() {
                Route::middleware('page_denied:Transaction Day Reseller')->group(function() {
                    Route::get('TransactionDayReseller-view', 'ResellerController@TransactionDayReseller')->name('Transaction_Day_Reseller');
                    Route::get('TransactionDayReseller-search', 'ResellerController@searchTransactionDayReseller')->name('Transaction_Day_Reseller-search');
                    Route::get('TransactionDayReseller-search/detail', 'ResellerController@detailTransactionDayReseller')->name('Transaction_Day_Reseller-detail');
                });
            });

            Route::group(['prefix' => 'Request_Transaction'], function() {
                Route::middleware('page_denied:Request Transaction')->group(function() {
                    Route::get('RequestTransaction-view', 'ResellerController@RequestTransaction')->name('Request_Transaction');
                    Route::post('RequestTransaction-approve', 'ResellerController@RequestTransactionApprove')->name('RequestTransaction-Approve');
                    Route::post('RequestTransaction-decline', 'ResellerController@RequestTransactionDecline')->name('RequestTransaction-Decline');
                });
            });

            Route::group(['prefix' => 'Add_Transaction_Reseller'], function() {
                Route::middleware('page_denied:Add Transaction Reseller')->group(function() {
                    Route::get('AddTransactionReseller-view', 'ResellerController@AddTransactionReseller')->name('Add_Transaction_Reseller');
                    Route::get('AddTransactionReseller-search', 'ResellerController@searchAddTransactionReseller')->name('Add_Transaction_Reseller-search');
                    Route::post('AddTransactionReseller-update', 'ResellerController@UpdateGoldReseller')->name('Add_Transaction_Reseller-update');                    
                });
            });

            Route::group(['prefix'  =>  'Report_Transaction'], function() {
                Route::middleware('page_denied:Report Transaction')->group(function(){
                    Route::get('ReportTransaction-view', 'ResellerController@ReportTransaction')->name('Report_Transaction');
                    Route::get('ReportTransaction-search', 'ResellerController@searchReportTransaction')->name('ResellerTransaction-search');
                    Route::get('ReportTransaction-search/{month}/{year}/detail', 'ResellerController@detailTransaction')->name('detailResellerTransaction');
                });
            });
        });

        Route::group(['prefix' => 'Store_Reseller'], function(){
            Route::group(['prefix' => 'Item_Store_Reseller'], function(){
                Route::middleware('page_denied:Item Store Reseller')->group(function(){
                    Route::get('ItemStoreReseller-view', 'ResellerController@ItemStoreReseller')->name('Item_Store_Reseller');
                    Route::post('ItemStoreReseller-create', 'ResellerController@ItemResellerstore')->name('ItemStoreReseller-create');
                    Route::post('ItemStore-update', 'ResellerController@updateItemstoreReseller')->name('ItemStore-update');
                    Route::post('ItemStoreReselle-updateimageBonus', 'ResellerController@updateImageBonusitemstoreresller')->name('ItemStoreReseller-updateimageBonus');
                    Route::post('ItemStoreReseller-updateimage', 'ResellerController@updateImageItemStoreReseller')->name('ItemStoreReseller-updateimage');
                    Route::delete('ItemStore-delete', 'ResellerController@destroyItemStoreReseller')->name('ItemStore-delete');
                    Route::delete('ItemStore-deleteAll', 'ResellerController@deleteAllSelected')->name('ItemStore-deleteAllSelected');
                });
            });

            Route::group(['prefix' => 'Store_reseller_report'], function(){
                Route::middleware('page_denied:Store reseller report')->group(function)
            });
        });

        Route::group(['prefix'  =>  'Reseller_Rank'], function() {
            Route::middleware('page_denied:Reseller Rank')->group(function(){
                Route::get('ResellerRank-view', 'ResellerController@ResellerRank')->name('Reseller_Rank');
                Route::post('ResellerRank-update', 'ResellerController@updateRank')->name('ResellerRank-update');
                Route::delete('ResellerRank-delete', 'ResellerController@destroyRank')->name('ResellerRank-delete');
                Route::post('ResellerRank-create', 'ResellerController@storeRankReseller')->name('ResellerRank-create');
                Route::delete('ResellerRank-deleteAllSelected', 'ResellerController@deleteAllSelectedRank')->name('ResellerRank-deleteAllSelectedRank');
            });
        });

        Route::group(['prefix'  =>  'Balance_Reseller'], function() {
            Route::middleware('page_denied:Balance Reseller')->group(function(){
                Route::get('BalanceReseller-view', 'ResellerController@BalanceReseller')->name('Balance_Reseller');
                Route::get('BalanceReseller-search', 'ResellerController@searchBalance')->name('BalanceReseller-search');
            });
        });

        Route::group(['prefix'  =>  'Register_Reseller'], function() {
            Route::middleware('page_denied:Register Reseller')->group(function(){
                Route::get('RegisterReseller-view', 'ResellerController@RegisterReseller')->name('Register_Reseller');
                Route::post('RegisterReseller-create', 'ResellerController@store')->name('RegisterReseller-create');
            });
        });       
    });

    Route::group(['prefix' => 'Version_Asset_Apk'], function() {
        Route::middleware('page_denied:Version Asset Apk')->group(function(){
            Route::get('VersionAsset-view', 'VersionAssetController@index')->name('Version_Asset_Apk');
            Route::post('VersionAsset-update', 'VersionAssetController@update')->name('VersionAssetApk-update');
            Route::post('VersionAsset-updateIos', 'VersionAssetController@update_ios')->name('VersionAssetApkIos-update');
            Route::post('VersionAssetdata-updateWindows', 'VersionAssetController@update_windows')->name('VersionAssetApkWindows-update');
            Route::post('VersionAsset-store', 'VersionAssetController@store')->name('VersionAssetApkAndroid-create');
            Route::post('VersionAsset-storeIos', 'VersionAssetController@storeIos')->name('VersionAssetApkIos-create');
            Route::post('VersionAsset-storeWindows', 'VersionAssetController@storeWindows')->name('VersionAssetApkwindows-create');
            Route::post('VersionAsset-updateAndroid', 'VersionAssetController@updateAssetAndroid')->name('VersionAssetApkAndroid-updateAsset');
            Route::post('VersionAsset-updateIOS', 'VersionAssetController@updateAssetIOS')->name('VersionAssetApkIOS-updateAsset');
            Route::post('VersionAsset-updateWindows', 'VersionAssetController@updateAssetWindows')->name('VersionAssetApkWindows-updateAsset');
            Route::delete('VersionAsset-deleteAndroid', 'VersionAssetController@destroy')->name('VersionAssetApkAndroid-deleteAsset');
            Route::delete('VersionAsset-deleteIOS', 'VersionAssetController@destroyIOS')->name('VersionAssetApkIOS-deleteAsset');
            Route::delete('VersionAsset-deleteWindows', 'VersionAssetController@destroyWindows')->name('VersionAssetApkWindows-deleteAsset');
            Route::delete('VersionAsset-deleteAssetAllSelected', 'VersionAssetController@deleteAllSelectedADR')->name('VersionAssetApkAndroid-deleteAssetAllSelected');
            Route::delete('VersionAsset-deleteAssetAllSelectedIOS', 'VersionAssetController@deleteAllSelectedIOS')->name('VersionAssetApkIOS-deleteAssetAllSelected');
            Route::delete('VersionAsset-deleteAssetAllSelectedWindows', 'VersionAssetController@deleteAllSelectedWindows')->name('VersionAssetApkWindows-deleteAssetAllSelected');
            Route::post('VersionAssetfile-updateLangId', 'VersionAssetController@update_languageindo')->name('VersionAssetApkLangId-update');
            Route::post('VersionAssetfile-updateLangEn', 'VersionAssetController@update_languageEnglish')->name('VersionAssetApkLangEn-update');
        });

    });

});
 //logout
 Route::get('/logout', 'LoginController@logout')->name("logout");
