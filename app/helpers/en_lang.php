<?php

// function xmlfile()
// {
//     // $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
//     $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    
//     return $xml;
// }

//===========================TRANSLATE SIDEMENU===========================//
function translate_menu($menu){

    // dd(xmlfile()->L_Email_Notification->attributes()->val);
  
    $array_menu = [
      'L_DASHBOARD'                         => 'Dashboard',
      'L_ADMIN'                             => 'Admin',
      'L_USER_ADMIN'                        => 'User Admin',
      'L_ROLE_ADMIN'                        => 'Role Admin',
      'L_LOG_ADMIN'                         => 'Log Admin',
      'L_ACTIVE_ADMIN'                      => 'Active Admin',
      'L_REPORT_ADMIN'                      => 'Report Admin',
      'L_TRANSACTION'                       => 'Transaction',
      'L_TRANSACTION_DAY'                   => 'Transaction Day',
      'L_USER_BANK_TRANSACTION'             => 'User Bank Transaction',
      'L_REWARD_TRANSACTION'                => 'Reward Transaction',
      'L_ADD_TRANSACTION'                   => 'Add Transaction',
      'L_TRANSACTION_POINT'                 => 'Transaction Point',
      'L_PLAYERS'                           => 'Players',
      'L_ACTIVE_PLAYERS'                    => 'Active Players',
      'L_REPORT_PLAYERS'                    => 'Players Report',
      'L_HIGH_ROLLER'                       => 'High roller',
      'L_REGISTERED_PLAYERS'                => 'Registered Players',
      'L_GUEST'                             => 'Guest',
      'L_BOTS'                              => 'Bots',
      'L_PLAY_REPORT'                       => 'Play Report',
      'L_CHIP_PLAYERS'                      => 'Player Chip',
      'L_GOLD_PLAYERS'                      => 'Player Gold',
      'L_POINT_PLAYERS'                     => 'Player Point',
      'L_REGISTER_PLAYER_ID'                => 'Registered Player ID',
      'L_LOG_PLAYER'                        => 'Player Log',
      'L_TRANSACTION_PLAYERS'               => 'Players Log',
      'L_PLAYERS_LEVEL'                     => 'Players level',
      'L_AVATAR_PLAYER'                     => 'Avatar Players',
      'L_SLIDE_BANNER'                      => 'Slide Banner',
      'L_ITEM'                              => 'Item',
      'L_TABLE_GIFT'                        => 'Table Gift',
      'L_REPORT_GIFT'                       => 'Gift Report',
      'L_EMOTICON'                          => 'Emoticon',
      'L_GAMES'                             => 'Games',
      'L_ASTA_POKER'                        => 'Asta-Poker',
      'L_TABLE_ASTA_POKER'                  => 'Asta Poker Table',
      'L_CATEGORY_ASTA_POKER'               => 'Asta Poker Category',
      'L_SEASON_ASTA_POKER'                 => 'Asta Poker Season',
      'L_SEASON_REWARD_ASTA_POKER'          => 'Asta Poker Season Reward',
      'L_TOURNAMENT_ASTA_POKER'             => 'Asra Poker Tournament',
      'L_JACKPOT_PAYTABLE_ASTA_POKER'       => 'Jackpot Paytable Asta Poker',
      'L_MONITORING_TABLE_ASTA_POKER'       => 'Table Monitoring',
      'L_BIG_TWO'                           => 'Big Two',
      'L_TABLE_BIG_TWO'                     => 'Big Two Table',
      'L_CATEGORY_BIG_TWO'                  => 'Big Two Category',
      'L_SEASON_BIG_TWO'                    => 'Big Two Season',
      'L_SEASON_REWARD_BIG _TWO'            => 'Big Two Season Reward',
      'L_TOURNAMENT_BIG_TWO'                => 'Big Two Reward',
      'L_JACKPOT_PAYTABLE_BIG_TWO'          => 'Jackpot Paytable Big Two',
      'L_DOMINO_SUSUN'                      => 'Domino susun',
      'L_TABLE_DOMINO_SUSUN'                => 'Domino Susun Table',
      'L_CATEGORY_DOMINO_SUSUN'             => 'Domino Susun Category',
      'L_SEASON_DOMINO_SUSUN'               => 'Domino Susun Season',
      'L_SEASON_REWARD_DOMINO_SUSUN'        => 'Domino Susun Season Reward',
      'L_TOURNAMENT_DOMINO_SUSUN'           => 'Domino Susun Tournament',
      'L_JACKPOT_PAYTABLE_DOMINO_SUSUN'     => 'Jackpot paytable Domino susun',
      'L_DOMINO_QQ'                         => 'Domino-QQ',
      'L_TABLE_DOMINO_QQ'                   => 'Domino QQ Table',
      'L_CATEGORY_DOMINO_QQ'                => 'Domino QQ Category',
      'L_SEASON_DOMINO_QQ'                  => 'Domino QQ Season',
      'L_SEASON_REWARD_DOMINO_QQ'           => 'Domino QQ Season Reward',
      'L_TOURNAMENT_DOMINO_QQ'              => 'Domino QQ Tournament',
      'L_JACKPOT_PAYTABLE_DOMINO_QQ'        => 'Jackpot paytable Domino-QQ',
      'L_GAME_SETTING'                      => 'Game Setting',
      'L_STORE'                             => 'Store',
      'L_BEST_OFFER'                        => 'Best Offer',
      'L_CHIP_STORE'                        => 'Chip Store',
      'L_GOLD_STORE'                        => 'Gold Coin',
      'L_GOODS_STORE'                       => 'Goods Store',
      'L_PAYMENT_STORE'                     => 'Payment Store',
      'L_REPORT_STORE'                      => 'Store Report',
      'L_NOTIFICATION'                      => 'Notification Report',
      'L_PUSH_NOTIFICATION'                 => 'Push Notification',
      'L_EMAIL_NOTIFICATION'                => 'Email Notification',
      'L_FEEDBACK'                          => 'Feedback',
      'L_REPORT_ABUSE_PLAYER'               => 'Abuse Player Report',
      'L_ABUSE_TRANSACTION_REPORT'          => 'Abuse Transaction Report',
      'L_FEEDBACK_GAME'                     => 'Feedback game',
      'L_SETTINGS'                          => 'Settings',
      'L_GENERAL_SETTING'                   => 'General Setting',
      'L_RESELLER'                          => 'Reseller',
      'L_LIST_RESELLER'                     => 'List Reseller',
      'L_RESELLER_TRANSACTION'              => 'Reseller Transaction',
      'L_TRANSACTION_DAY_RESELLER'          => 'Transactoion day reseller',
      'L_REQUEST_TRANSACTION'               => 'Request Transaction',
      'L_ADD_TRANSACTION_RESELLER'          => 'Add Transaction',
      'L_REPORT_TRANSACTION'                => 'Report Transaction',
      'L_SALES_REPORT_TRANSACTION_RESELLER' => 'Sales Reseller Transaction Report',
      'L_BALANCE_RESELLER'                  => 'Balance Reseller',
      'L_ITEM_STORE_RESELLER'               => 'Item Store Reseller',
      'L_RESELLER_RANK'                     => 'Reseller Rank',
      'L_REGISTER_RESELLER'                 => 'Register reseller',
      'L_VERSION_ASSET_APK'                 => 'Versi asset apk',
      'L_LOG_OUT'                           => 'Log out',
      'L_MONITORING_TABLE_DOMINO_SUSUN'     => 'Table Monitoring Domino Susun',
      'L_MONITORING_TABLE_DOMINO_QQ'        => 'Table Monitoring Domino QQ',
      'L_MONITORING_TABLE_BIG_TWO'          => 'Table Monitoring Table Big Two',
      'L_STORE_RESELLER'                    => 'Store Reseller',
      'L_STORE_RESELLER_REPORT'             => 'Store Reseller Report',
      'L_GAME'                              => 'Game'
    ];

    return $array_menu[$menu];
}


//=================================MENU ADMIN===============================//
function translate_MenuContentAdmin($menu){
    
    $array_menuContent = [

        'L_ADMIN'                => 'Admin',
        'L_ROLE_ADMIN'           => 'Admin Role',
        'L_CREATE_USER_ADMIN'    => 'Create User Admin',
        'L_CREATE_ROLE_ADMIN'    => 'Create Role Admin',
        'L_CHOOSE_ACTION'        => 'Choose Category',
        'Create Admin'           => 'Buat admin',
        'Delete Admin'           => 'Hapus admin',
        'Edit Admin'             => 'Edit admin',
        'Decline Admin'          => 'Tolak admin',
        'Approve Admin'          => 'Terima admin',
        'Change Password Admin'  => 'Ganti katasandi admin',
        'L_CHOOSE_LOG_TYPE'      => 'Choose Log Type',
        'L_PLAYERS_ONLINE'       => 'Online Players',
        'L_SAVE'                 => 'Save',
        'L_SEARCH'               => 'Search',
        'L_CANCEL'               => 'Cancel',
        'L_CREATE_NEW_USER'      => 'Create New User',
        'L_SELECT_ALL'           => 'Select All',
        'L_ADMIN_ID'             => 'Admin ID',
        'L_ADMIN_REPORT'         => 'Admin Report',
        'L_STATUS'               => 'Status',
        'L_ROLE_NAME'            => 'Role Name',
        'L_USERNAME'             => 'Username',
        "L_FULLNAME"             => "Full Name",
        "L_ROLE_TYPE"            => "Role Type",
        'L_DATE'                 => 'Date',
        'L_DATE_LOGIN'           => 'Date Login',
        'L_TIMESTAMP'            => 'Time Stamp',
        'L_IP'                   => 'IP',
        'L_DESCRIPTION'          => 'Description',
        'L_ACTION'               => 'Category',
        'L_RESET_PASSWORD'       => 'Reset Password',
        'L_DELETE_DATA'          => 'Delete Data',
        'L_VIEW_EDIT'            => 'View and Edit',
        'L_QUESTION_DELETE'      => 'Are you sure want to delete it?',
        'L_YES'                  => 'Yes',
        'L_NO'                   => 'No',
        'L_STATEMENT_DELETE_ALL' => 'Delete all data selected?',
        'L_QUESTION_DELETE_ALL'  => 'Are you sure want to delete all data selected?',
        'L_DESCRIPTION_NULL'     => 'Description cannot be empty',
        'L_EDIT_USER_ADMIN'      => 'Edit User Admin',
        'L_EDIT_ROLE_ADMIN'      => 'Edit Role',
        'L_EDIT_USER_BANK_TRANSACTION'  =>  'Edit User Bank Transaction',
        'L_EDIT_GOODS_TRANSACTION'   => 'Edit Goods Transaction',
        'L_EDIT_ADD_TRANSACTION_PLAYERS' =>  'Edit Add Transaction Players',
        'L_EDIT_REGISTER_PLAYER'    =>  'Edit Register Player',
        'L_EDIT_GUEST'           => 'Edit Guest',
        'L_EDIT_REGISTER_PLAYER_ID' =>  'Edit Register Player ID',
        'L_EDIT_PLAYERS_LEVEL'   => 'Edit Player Level',
        'L_EDIT_AVATAR_PLAYERS'  => 'Edit Avatar Players',
        'L_EDIT_TABLE_GIFT'      => 'Edit Table Gift',
        'L_EDIT_EMOTICON'        => 'Edit Emoticon',
        'L_EDIT_TABLE_ASTA_POKER'=> 'Edit Asta Poker Table',
        'L_EDIT_CATEGORY_ASTA_POKER'   => 'Edit Asta Poker Table',
        'L_EDIT_MONITORING_TABLE_ASTA_POKER' =>  'Edit Monitoring Asta Poker Table',
        'L_EDIT_TABLE_BIG_TWO'  =>  'Edit Big Two Table',
        'L_EDIT_CATEGORY_BIG_TWO'   =>  'Edit Big Two Category',
        'L_EDIT_MONITORING_TABLE_BIG_TWO' =>  'Edit Monitoring Big Two Table',
        'L_EDIT_TABLE_DOMINO_SUSUN' =>  'Edit Domino Susun Table',
        'L_EDIT_CATEGORY_DOMINO_SUSUN'  =>  'Edit Domino Susun Category',
        'L_EDIT_MONITORING_TABLE_DOMINO_SUSUN'  =>  'Edit Monitoring Domino Susun Table',
        'L_EDIT_TABLE_DOMINO_QQ'    =>  'Edit Domino QQ Table',
        'L_EDIT_CATEGORY_DOMINO_QQ' =>  'Edit Domino QQ Category',
        'L_EDIT_MONITORING_TABLE_DOMINO_QQ' =>  'Edit Monitoring Domino QQ Table',
        'L_EDIT_GAME_SETTING'       =>  'Edit Game Setting',
        'L_EDIT_CHIP_STORE'         =>  'Edit Chip Store',
        'L_EDIT_GOLD_STORE'         =>  'Edit Gold Store',
        'L_EDIT_GOODS_STORE'        =>  'Edit Goods Store',
        'L_EDIT_PAYMENT_STORE'      =>  'Edit Payment Type',
        'L_EDIT_GENERAL_SETTING'    =>  'Edit General Setting',
        'L_EDIT_LIST_RESELLER'      =>  'Edit List Reseller',
        'L_EDIT_REQUEST_TRANSACTION_RESELLER' =>'Edit Request Reseller Transaction',
        'L_EDIT_ADD_TRANSACTION_RESELLER'   =>  'Edit Add Reseller Transaction',
        'L_EDIT_ITEM_STORE_RESELLER'    =>  'Edit Item Store Reseller',
        'L_EDIT_RANK_RESELLER'      =>  'Edit Rank Reseller',
        'L_EDIT_REGISTER_RESELLER'  =>  'Edit Register Reseller',
        'L_EDIT_VERSION_ASSET_APK'  =>  'Edit Version Asset Apk',

        
        
    ];

    return $array_menuContent[$menu];
}


// //=========================MENU TRANSACTION========================//
function translate_MenuTransaction($menu){

    $array_menuContent = [

        'L_TRANSACTION'           =>  'Transaction',
        'L_REWARD_TRANSACTION'    =>  'Transaction Reward',
        'L_BANKING_TRANS'   =>  'Banking Transaction',
        'L_USER_BANK_TRANS' =>  'User Banking Transaction',
        'L_SEARCH'          =>  'Search',
        'L_ADD_TRANSC'      =>  'Add Transaction',
        'L_USER_ID'         =>  'User ID',
        'L_BALANCE_CHIP'    =>  'Balance Chip',
        'L_MIN_TRANSC_CHIP' =>  'Reduce Chip Transaction',
        'L_TRANSC_POINT'    =>  'Point Transaction',
        'L_BALANCE_POINT'   =>  'Point Balance',
        'L_TRANSC_GOLD'     =>  'Gold Transaction',
        'L_BALANCE_GOLD'    =>  'Gold Balance',
        'L_MIN_TRANSC_GOLD' =>  'Reduce Gold Transaction',

        
        //PILIH AKSI
        'L_SEARCH'                =>  'Search',
        'Choose Time'             =>  'Pilih waktu',
        'Choose Game'             =>  'Pilih Game',
        'L_ALL_GAME'              =>  'All Game',
        'Today'                   =>  'Hari ini',
        'L_DAY'                   =>  'Daily',
        'L_WEEK'                  =>  'Weekly',
        'L_MONTH'                 =>  'Monthly',
        'L_ALL_TIME'              =>  'All Time',
        'L_GAME'                  =>  'Game',
        'L_TIME_STAMP'            =>  'Time Stamp',
        'L_BANK_TRANSACTION'      =>  'Bank Transaction',
        'L_BANK_MANUAL_TRANSFER'  =>  'Bank Manual Transfer',
        'L_ID_PLAYER'             =>  'Player ID',
        'L_ITEM'                  =>  'Item',
        'L_QUANTITY'              =>  'Quantity',
        'L_PRICE'                 =>  'Price',
        'buy'                     =>  'Buy',
        'using'                   =>  'Using',
        'at price'                =>  'At price',
        'Awarded'                 =>  'Awarded',
        'L_TYPE'                  =>  'type',
        'L_ITEM_STATUS'           =>  'Item Status',
        'L_DECLINE'               =>  'Decline',
        'L_DECLINE_TRANS'   =>  'Decline Transaction',
        'L_APPROVE_TRANS'   =>  'Approve Transaction',
        'L_QUESTION_DECLINE_TRANS'    =>  'Are you sure to Decline this transaction?',
        'L_QUESTION_APPROVE_TRANS'    =>  'Are you sure to Approve this transaction?',
        'L_APPROVE'               =>  'Approve',
        'L_PENDING'               =>  'Pending',
        'L_STATUS_PAYMENT'        =>  'Payment Status',
        'L_CONFIRM_REQUEST'       =>  'Confirm Request',
        'L_USERNAME'              =>  'Username',
        'L_STATUS'                =>  'Status',
        'L_DATE'                  =>  'Date',
        'L_WIN'                   =>  'Win',
        'L_LOSE'                  =>  'Lose',
        'L_TURN_OVER'             =>  'Turn Over',
        'L_FEE'                   =>  'Fee',
        'L_YES'                   =>  'Yes',
        'L_NO'                    =>  'No',
        'L_PENDING'               =>  'Pending',
        'L_DELIVERY_CONFIRM' =>  'Delivery Confirmation',
        'L_DELIVERY_STATUS'       =>  'Delivery Status',
        'L_DETAIL_INFO'           =>  'Detail Info',
        'L_FULL_NAME'             =>  'Fullname',
        'L_EMAIL'                 =>  'Email',
        'L_PHONE'                 =>  'No. Telp',
        'L_PROVINCE'              =>  'Province',
        'L_ADDRESS'               =>  'Address',
        'L_CITY'                  =>  'City',
        'L_POSTAL_CODE'           =>  'Zip Code',
        'L_ON_PROCESS'            =>  'On proccess',
        'On Process'              =>  'On proccess',
        'L_REQUEST'               =>  'Request',
        'Pending'                 =>  'Pending',
        'L_REQ_DELIVERY_STS'      =>  'Required shipping status',
        'L_IF_THE_ITEM_HAS_BEEN_SENT' =>  'If the item has been sent',
        'L_DATE_SENT'             =>  'Date sent',
        'L_ITEM_NAME'             =>  'Item Name',
        'L_TYPE_OF_SHIPMENT'      =>  'Type of shipment (Transfer, JNE, TIKI, DLL)',
        'L_SHIPPING_CODE'         =>  'Shipment code (No Resi / No Transferan)',
        'L_COMPLETED'             =>  'Completed',
        'Confirmation'            =>  'Confirmation',
        'L_JACKPOT'               =>  'Jackpot',
        'L_WIN_LOSE'              =>  'Win Lose',
        'L_CASH_DEBIT'            =>  'Cash Debit',
        'L_CASH_CREDIT'           =>  'Cash credit',
        'L_GOLD_DEBIT'            =>  'Gold Debit',
        'L_GOLD_CREDIT'           =>  'Gold Credit',
        'L_CHIP_DEBIT'            =>  'Chip Debit',
        'L_CHIP_CREDIT'           =>  'Chip credit',
        'L_REWARD_GOLD'           =>  'Gold reward',
        'L_REWARD_CHIP'           =>  'Chip reward',
        'L_REWARD_POINT'          =>  'Poin reward',
        'L_CORRECTION_GOLD'       =>  'Gold ccorrection',
        'L_CORRECTION_CHIP'       =>  'Chip correction',
        'L_CORRECTION_POINT'      =>  'Point correction', 
        'L_POINT_GET'             =>  'Point earned',
        'L_POINT_SPEND'           =>  'Point spend',
        'L_POINT_EXPIRED'         =>  'Point expired',
        'L_TRANSC_DAY'            =>  'Daily transaction',
        'Detail Information'      =>  'Detail Information',
        'L_QUESTION_DECLINE_TRANS'=> 'Are you sure want to decline this transaction?',
        'L_QUESTION_APPROVE_TRANS'=> 'Are you sure want to approve this transaction?',
        'L_TRANSPLAYER'           =>  'Player Transaction',
        'L_TOTAL_RECORD'          =>  'Total Record is',
        'L_TRANSC_CHIP'           =>  'Transaction chip',
    ];
    return $array_menuContent[$menu];
}

function Translate_menuPlayers($menu){

    $array_menuContent = [

        'L_PLAYERS'                   =>  'Players',
        'L_ACTIVE_PLAYERS'            =>  'Active Players',
        'L_REPORT_PLAYER'             =>  'Player Report',
        'L_PLAY_REPORT'               =>  'Play Report',
        'L_PLAYERS_ONLINE'            =>  'Online Players',
        'L_REGISTERED_PLAYER'         =>  'Registered Player',
        'L_REGISTERED_PLAYERID'       =>  'Registered Player ID',
        'L_LOG_PLAYERS'               =>  'Player Log',
        'L_DATA_TOBE_ADDED'           =>  'Number of ID to be added',
        'L_CHIP_PLAYERS'              =>  'Player Chip',
        'L_GOLD_PLAYERS'              =>  'Player Gold',
        'L_POINT_PLAYERS'             =>  'Player Point',
        'L_GUEST'                     =>  'Guest',
        'L_CHOOSE_REGISTER_TYPE'      =>  'Choose register type',
        'L_ALLGAMES'                  =>  'all game',
        'L_CHOOSE_LOG_TYPE'           =>  'Choose log type',
        'L_CHOOSE_STATUS'             =>  'Choose status',
        'L_CHOOSE_USER_TYPE'          =>  'Choose user type',
        'L_CHOOSE_ACTION'             =>  'Choose action',
        'L_TOTAL_RECORD'              =>  'Total Record entry is',
        'L_CREATE_GUESTID'            =>  'Create ID user guest',
        'L_BANK_ACCOUNT'              =>  'Bank Account',
        'L_COUNTRY'                   =>  'Country',
        'L_CREATE_PLAYER'             =>  'Create Player',
        'L_DELETE_PLAYER'             =>  'Delete Player',
        'L_EDIT_PLAYER'               =>  'Edit Player',
        'L_CHANGE_PASSWORD_PLAYER'    =>  'Change password player',
        'L_TOTAL_RECORD'              =>  'Total Record Entry is',
        'L_PLAYER_ID'                 =>  'Player ID',
        'L_GUEST_ID'                  =>  'Guest ID',
        'L_DEVICE_ID'                 =>  'Perangkat ID',
        'L_ROUND_ID'                  =>  'Round ID',
        'L_DETAIL_ROUND_ID'           =>  'Detail Round ID',
        'L_ID_PLAYER_ALREADY'         =>  'ID Player Already',
        'L_PLAYER_ID_USED'            =>  'Player ID Used',
        'L_GUEST_ID_USED'             =>  'Guest ID  Used',
        'L_BOT_ID_USED'               =>  'Bot ID used ',
        'L_PLAYER_ID_DIDNT_USE'       =>  'Player ID didnt use',
        'L_GUEST_ID_DIDNT_USE'        =>  'Guest ID didnt use',
        'L_BOT_ID_DIDNT_USE'          =>  'ID Bot didnt use',
        'L_TOTAL_PLAYER_ID'           =>  'Total Player ID',
        'L_TOTAL_GUEST_ID'            =>  'Total Guest ID',
        'L_TOTAL_BOT_ID'              =>  'Total ID bot',
        'L_PLAYERNAME'                =>  'Playername',
        'L_GAME'                      =>  'Game',
        'L_USERTYPE'                  =>  'Usertype',
        'L_USERNAME'                  =>  'Username',
        'L_DESC'                      =>  'Description',
        'L_PLAYING_GAME'              =>  'Playing Game',
        'L_RANK'                      =>  'Rank',
        'L_LEVEL'                     =>  'Level',
        'L_TABLE'                     =>  'Table',
        'L_HAND_CARD'                 =>  'Hand card',
        'L_SEAT'                      =>  'Seat',
        'L_SIT'                       =>  'Sit',
        'L_BET'                       =>  'Bet',
        'L_WIN_LOSE'                  =>  'Win Lose',
        'L_CHIP'                      =>  'Chip',
        'L_GOODS'                     =>  'Goods',
        'L_POINT'                     =>  'Point',
        'L_ACTION'                    =>  'Action',
        'L_GOLD_COINS'                =>  'Gold Coins',
        'L_CARD'                      =>  'Card',
        'L_DOMINO'                    =>  'Domino',
        'L_CARD_TABLE'                =>  'Card Table',
        'L_DEVICE_TIMER'              =>  'Device Timer',
        'L_USER'                      =>  'Used',
        'L_NON_USED'                  =>  'Non Used',
        'L_FROM'                      =>  'From',
        'L_DEBIT'                     =>  'Debit',
        'L_CREDIT'                    =>  'Credit',
        'L_TOTAL'                     =>  'Total',
        'L_PLAYING_GAMES'             =>  'Category game',
        'L_TABLE_NAME'                =>  'Nama table',
        'L_TIMESTAMP'                 =>  'Time stamp',
        'L_STATUS'                    =>  'Status',
        'L_DATE_CREATED'              =>  'Date created',
        'L_REGISTER_FORM'             =>  'Register form',
        'L_IP'                        =>  'IP',
        'L_PLAYER'                    =>  'Player',
        'L_GUEST'                     =>  'Guest',
        'L_APPROVE'                   =>  'Approve',
        'L_BANNED'                    =>  'Banned',
        'L_PROBLEM'                   =>  'Problem',
        'L_SAVE'                      =>  'Save',
        'L_CANCEL'                    =>  'Cancel',
        'L_PLAYERS_LEVEL'             =>  'Players Level',
        'L_CREATE_PLAYER_LEVEL'       =>  'Create Players Level',
        'L_LEVEL'                     =>  'Level max',
        'L_EXPERIENCE'                =>  'XP Max',
        'L_PLAYER_RANK'               =>  'Player Rank',
        'L_CREATE_RANK_PLAYER'        =>  'Create Players Rank',
        'L_SAVE_AVATAR'               =>  'Save avatar',
        'L_EDIT_AVATAR'               =>  'Edit avatar',
        'L_EDIT'                      =>  'Edit',
        'L_MAIN'                      =>  'Utama',
        'L_CONFIRMATION'              =>  'Konfirmasi',
        'L_LOBBY'                     =>  'Lobi',
        'L_CREATE_NEW_AVATAR'         =>  'Buat avatar baru',
        'L_AVATAR_PLAYER'             =>  'Avatar pemain',
        'L_CARD'                      =>  'Card',
        'L_CREATE_PLAYER'             =>  'Create Player',
        'L_DELETE_PLAYER'             =>  'Delete Player',
        'L_EDIT_PLAYER'               =>  'Edit Player',
        'L_CHIP_PLAYERS'              =>  'Chip Player',
        'L_BET'                       =>  'Bet',
        'L_COUNT_CARD'                =>  'Count Card',
        'L_CARD_HAND'                 =>  'Hand Card',
        'L_CARD_OUT'                  =>  'Card Out',
        'L_NEW_ROUND'                 =>  'New Round',
        'L_DIVIDED_CARD'              =>  'Card dealt',
        'L_WIN'                       =>  'Win',
        'L_LOSE'                      =>  'Lose',
        'L_DRAW'                      =>  'Draw',
        'L_BET_CALL'                  =>  'Bet / Call',
        'L_CHECK'                     =>  "Check",
        'L_RAISE'                     =>  'Raise',
        'L_FOLD'                      =>  'Fold',
        'L_PLAY'                      =>  'Play',
        'L_PASS'                      =>  'Pass',
        'L_BIG_BLIND'                 =>  'Big Blind',
        'L_SMALL_BLIND'               =>  'Small Blind',
        'L_ALL_IN'                    =>  'All In',
        'L_REMAINING_TYPE'            =>  'Remaining Type',
        'L_LOGIN_PLAYER'              =>  'Login Player',
        'L_APPROVE_ACCOUNT_PLAYER'    =>  'Approve account player',
        'L_BANNED_ACCOUNT_PLAYER'     =>  'Banned account player',
        'L_PROBLEM_ACCOUNT_PLAYER'    =>  'Problem account player',
        'L_UPGRADE_ACCOUNT'           =>  'Upgrade account',
        'L_CARD_TYPE'                 =>  'Card Type',
        'L_CARD_TABLE'                =>  'Card Table',
        'L_DEALER'                    =>  'Dealer',
        'L_HIGH_CARD'                 =>  'High Card',
        'L_PAIR'                      =>  'Pair',
        'L_2_PAIR'                    =>  'Two Pair',
        'L_3_KIND'                    =>  'Three Of Kind',
        'L_4_KIND'                    =>  'Four Of Kind',
        'L_FULL_HOUSE'                =>  'Full House',
        'L_STRAIGHT'                  =>  'Straight',
        'L_FLUSH'                     =>  'Flush',
        'L_STRAIGHT_FLUSH'            =>  'Straight Flush',
        'L_ROYAL_FLUSH'               =>  'Royal Flush',
        'L_CARD_VALUE'                =>  'Card value',
        'L_CHANGE_PLAYER_STATUS'      =>  'Change player status',
        'L_USER_ID'                   =>  'User ID',
        'L_DATE_TIME'                 =>  'Date Time',
        'L_PROFILE'                   =>  'Profile Player',
        'L_REGISTER_IN'               =>  'Register in',
        'L_EMAIL'                     =>  'Email',
        'L_COUNTRY'                   =>  'Country',
        'L_GOLD'                      =>  'Gold',
        'L_CHIP'                      =>  'Chip',
        'L_POINT'                     =>  'Poin',
        'L_DEVICE_ID'                 =>  'Device ID',
        'L_DEVICE_NAME'               =>  'Device Name',
        'L_DATE_IN'                   =>  'Date In',
        'L_SEARCH'                    =>  'Search',
        'L_USED'                      =>  'Used',
        'L_NON_USED'                  =>  'Tidak terpakai',
        'L_EXIT'                      =>  'Exit',
        'L_USERNAME'                  =>  'Username',
        ''                          =>  ''


    ];
    return $array_menuContent[$menu];
}


function TranslateMenuItem($menu){

    $array_menuContent = [

        'L_ITEM'              =>  'Item',
        'L_TABLE_GIFT'        =>  'Table gift',
        'L_CREATE_NEW_GIFT'   =>  'Create New Gift',
        'L_REPORT_GIFT'       =>  'Gift Report',
        'L_SELECT_ALL'        =>  'Select all',
        'L_IMAGE'             =>  'Image',
        'L_TITLE'             =>  'Title',
        'L_PRICE'             =>  'Price',
        'L_CATEGORY'          =>  'Category',
        'L_STATUS'            =>  'Status',
        'L_MAIN_IMAGE'        =>  'Main Image',
        'L_SAVE_GIFT'         =>  'Save gift',
        'L_SAVE'              =>  'Save',
        'L_CANCEL'            =>  'Cancel',
        'L_EDIT_GIFT'         =>  'Edit gift',
        'L_CREATE_GIFT_STORE' =>  'Create Gift Store',
        'L_DELETE_DATA'       =>  'Delete data',
        'L_QUESTION_DELETE_IT'=> 'Are you sure want to delete it?',
        'L_YES'               =>  'Yes',
        'L_NO'                =>  'No',
        'L_DELETE_ALL_SELECTED_DATA' => 'Delete All Selected Data',
        'L_ARE_U_SURE'        =>  'Are you sure want to delete all selected data?',
        'L_CHOOSE_GAME'       =>  'Choose game',
        'L_USERNAME'          =>  'Username',
        'L_ACTION_GAME'       =>  'Action Game',
        'L_DATE'              =>  'Date',
        'L_DESCRIPTION'       =>  'Description',
        'L_EMOTICON'          =>  'Emoticon',
        'L_CREATE_NEW_EMOTICON'=> 'Create New Emoticon',
        'L_CREATE_EMOTICON'   =>  'Create Emoticon',
        'L_EDIT'              =>  'Edit',
        'L_GIFT_ID'           =>  'Gift ID',
        'L_EMOTICON_ID'       =>  'Emoticon ID',
        'L_SEE_DETAIL_IMAGE'  =>  'See Detail Image / Gif',
        'L_DETAIL_INFO'       =>  'Image preview',
        'L_DETAIL_IMAGE'      =>  'Detail Image'
    ];

    return $array_menuContent[$menu];

}


function TranslateMenuGame($menu){

    $array_menuContent = [
        'L_TABLE'                => 'Table',
        'L_TABLE_PLAYER'         => 'Table Player',
        'L_CHANGE_TITLE'         => 'Change Title',
        'L_CREATE_NEW_TABLE'     => 'Create New Table',
        'L_TABLE_NAME'           => 'Table Name',
        'L_GROUP'                => 'Group',
        'L_MAX_PLAYER'           => 'Max Player',
        'L_SMALL_BLIND'          => 'Small blind',
        'L_BIG_BLIND'            => 'Big blind',
        'L_JACKPOT'              => 'Jackpot',
        'L_MIN_BUY'              => 'Min Buy',
        'L_MAX_BUY'              => 'Max Buy',
        'L_TIMER'                => 'Timer',
        'L_ACTION'               => 'Action',
        'L_CREATE_TABLE'         => 'Create Table',
        'L_SELECT_CATEGORY'      => 'Select Category',
        'L_SAVE'                 => 'Save',
        'L_CANCEL'               => 'Cancel',
        'L_DELETE_DATA'          => 'Delete Data',
        'L_ARE_YOU_SURE'         => 'Are you sure want to delete it?',
        'L_YES'                  => 'Yes',
        'L_NO'                   => 'No',
        'L_CATEGORY'             => 'Category',
        'L_ASTA_POKER_TABLE'     => 'Asta Poker Table',
        'L_TITLE'                => 'Title',
        'L_CREATE_CATEGORY'      => 'Create Category',
        'L_ASTA_BIG_TWO_TABLE'   => 'Asta Big Two Table',
        'L_ASTA_DOMINO_QQ_TABLE' => 'Asta Domino QQ Table',
        'L_ASTA_DOMINO_SUSUN_TABLE' => 'Asta Domino susun Table',
        'L_CREATE_NEW_TABLE'     => 'Create New table',
        'L_TURN'                 => 'Turn',
        'L_TOTAL_BET'            => 'Total Bet',
        'L_STAKE'                => 'Stake',
        'L_GAME_STATE'           => 'Game State',
        'L_ROOM_NAME'            => 'Room Name',
        'L_NAME'                 => 'Name',
        'L_LANGUAGE'             => 'Language',
        'L_INDONESIA'            => 'Indonesia',
        'L_ENGLISH'              => 'English',
        'L_UPLOAD_FILE_LANGUAGE' => 'Upload language File',
        'L_PLAY_TIME'            => 'Play Time',
        'L_SEAT'                 => 'Seat',
        'L_USERNAME_PLAYER'      => 'Username Player',
        'L_SEE_DETAIL'           => 'See Detail',
        'L_ONLINE'               => 'Online',
        'L_PLAYERS'              => 'Players',
        'L_REFRESH'              => 'Refresh',
        'L_AUTO_REFRESH'         => 'Auto Refresh',
        'L_NOVICE'               => 'Novice',
        'L_INTERMEDIATE'         => 'Intermediate',
        'L_PRO'                  => 'Pro',
        'L_SEE'                  => 'See'  

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuToko($menu){

    $array_menuContent = [

        'L_BEST_OFFER'        =>  'Best Offer',
        'L_STORE'             =>  'Store',
        'L_IMAGE'             =>  'Image',
        'L_TITLE'             =>  'Title',
        'L_RATE'              =>  'Rate',
        'L_CATEGORY'          =>  'Category',
        'L_PRICE_CASH'        =>  'Price Cash',
        'L_AS_LONG'           =>  'As long',
        'L_PAY_TRANSACTION'   =>  'Pay Transaction',
        'L_ACTION'            =>  'Action',
        'L_CREATE_BEST_OFFER' =>  'Create Best offer',
        'L_DAY'               =>  'Day',
        'L_PAYMENT_METHODE'   =>  'Payment method',
        'L_TRANSACTION_TYPE'  =>  'Transaction Type',
        'L_BANK_TRANSFER'     =>  'Bank Transfer',
        'L_INTERNET_BANKING'  =>  'Imternet banking',
        'L_CASH_DIGITAL'      =>  'E Money',
        'L_MANUAL_TRANSFER'   =>  'Manual transfer',
        'L_SHOP'              =>  'Shop',
        'L_CREDIT_CARD'       =>  'Credit Card',
        'L_STORE'             =>  'Store',
        'L_CHIP_STORE'        =>  'Chip Store',
        'L_GOODS_STORE'       =>  'Goods Store',
        'L_REPORT_STORE'      =>  'Report Store',
        'L_PAYMENT_STORE'     =>  'Payment Store',
        'L_CREATE_NEW_CHIP_STORE'   =>  'Create New Chip Store',
        'L_CREATE_NEW_GOODS_STORE'  =>  'Create New Goods Store',
        'L_CREATE_NEW_PAYMENT_STORE'=>  'Create New Payment Store',
        'L_ORDER'             =>  'Order',
        'L_CHIP_AWARDED'      =>  'Chip Obtained',
        'L_GOLD_AWARDED'      =>  'Gold Obtained',
        'L_GOLD_COST'         =>  'Gold Price',
        'L_ACTIVE'            =>  'Active',
        'L_MAIN_IMAGE'       =>  'Main Image',
        'L_SAVE_IMAGE'        =>  'Save Image',
        'L_EDIT'              =>  'Edit',
        'L_CREATE_NEW_GOLD_STORE'   =>  'Create New Gold Store',
        'L_ITEM_TYPE'         =>  'Item Type',
        'L_PAY_TRANSACTION'   =>  'Pay Transaction',
        'L_PRICE_POINT'       =>  'Price point',
        'L_CHOOSE_TYPE_DATE'  =>  'Choose Type Date',
        'L_DATEAPPROVE_DECLINE'  => 'Date approved and decline',
        'L_DATE_REQUEST'      =>  'Date Request',
        'L_ITEM_AWARDED'      =>  'Item awarded',
        'L_BONUS_ITEM'        =>  'Bonus Item',
        'L_STATUS_INFORMATION'=>  'Status Information',
        'L_PLAYER_ID'         =>  'Player ID',
        'L_USERNAME'          =>  'Username',
        'L_ITEM'              =>  'Item',
        'L_QUANTITY'          =>  'Quantity',
        'L_DESCRIPTION'       =>  'Description',
        'L_PRICE'             =>  'Price',
        'L_CONFIRMATION'      =>  'Confirmation',
        'L_STATUS'            =>  'Status',
        'L_DATE_SENT'         =>  'Date Sent',
        'L_THE_DATE_THE_ITEM_WAS_RECEIVED'    =>  'Date Received',
        'L_TYPE_OF_DELIVERY'  =>  'Delivery Type',
        'L_CODE_RECEIPT'      =>  'Shipping Code (no. resi / no. transfers)',
        'L_SUCCESS'           =>  'Success',
        'L_DECLINE'           =>  'Decline',
        'L_RECEIVED_AND_SENT' =>  'Received and sent',
        'L_PAYMENT_TYPE'      =>  'Payment type',
        'L_ITEM_BONUS'        =>  'Item Bonus',
        'L_ITEM_BONUS_IMAGE'  =>  'Item Bonus Image',
        'L_ITEM_BONUS_GET'    =>  'Item Bonus Obtained',
        'L_GOOGLE_KEY'        =>  'Google key',
        'L_TRANSACTION'       =>  'Transaction',
        'L_SEARCH'            =>  'Search'
    ];

    return $array_menuContent[$menu];
}


function TranslateMenuFeedback($menu){

    $array_menuContent = [

        'L_FEEDBACK'                  =>  'Feedback',
        'L_ABUSE_TRANS_REPORT'  =>  'Abuse Transaction Report',
        'L_REPORT_ABUSE_PLAYER'       =>  'Report Abuse Player',
        'Image Proof'               =>  'Image Proof',
        'Rating'                    =>  'Rating',
        'Message'                   =>  'Message',
        'User ID sender'            =>  'ID Sender',
        'Username sender'           =>  'Username Sender',
        'Reported User ID'          =>  'Report user ID',
        'Reported User'             =>  'Reported User',
        'Reason'                    =>  'Reason',
    
    ];
    return $array_menuContent[$menu];
}

function TranslateGeneralSettings($menu){

    $array_menuContent = [

        'System settings'           =>  'System Settings',
        'Maintenance'               =>  'Maintenance',
        'Point expired'             =>  'Point expired',
        'Award Signup'              =>  'Sign Up Award',
        'Award Signup Guest'        =>  'Sign Up Guest Award',
        'Award Daily Chips'         =>  'Daily chip Award',
        'Award Daily Chips Guest'   =>  'Daily chip guest Award',
        'Award Daily Days'          =>  'Daily award',
        'Award Daily Multiply'      =>  'Daily multiply award',
        'Bank Settings'             =>  'Bank Settings',
        'Info Settings'             =>  'Info Settings',
        'About'                     =>  'About',
        'Edit About'                =>  'Edit About',
        'CS & Legal Settings'       =>  'CS & Legal Settings',
        'Edit privacy & policy'     =>  'Edit Privacy & policy',
        'Edit Term of Service'      =>  'Edit Term of service',
        'days'                      =>  'Days',
        'Edit Asta Poker'           =>  'Edit Asta Poker',
        'Edit Big Two'              =>  'Edit Big two',
        'Edit Domino QQ'            =>  'Edit Domino QQ',
        'Edit Domino Susun'         =>  'Edit Domino susun',

    ];
    return $array_menuContent[$menu];
}

function TranslateReseller($menu){

    $array_menuContent = [

        'L_RESELLER_ID'          => 'Reseller ID',
        'L_PHONE'                => 'Phone',
        'L_BALANCE_GOLD'         => 'Balance Gold',
        'L_REPORT_TRANSACTION'   => 'Report Transaction',
        'Bonus Item'             => 'Bonus item',
        'L_BALANCE'              => 'Balance',
        'Gold Group'             => 'Gold Group',
        'Create Reseller Rank'   => 'Create Reseller Rank',
        'L_PASSWORD'             => 'Password',
        'L_IDENTITY_CARD'        => 'Identity Card',
        'L_ACCESS_DENIED'        => 'Access Denied',
        'L_UCANT_ACCESS'         => 'You cannot access',
        'Create new asset'       => 'Create New Asset',
        'Link'                   => 'Link',
        'Version'                => 'Version',
        'Edit Asset'             => 'Edit asset',
        'Choose a file'          => 'Choose a file',
        'Create new reseller'    => 'Create new reseller',
        'Select All'             => 'Select All',
        'L_WEEKLY'               => 'Weekly',
        'L_MONTHLY'              => 'Monthly',
        'L_YEARLY'               => 'Yearly',
        'Create new'             => 'Create new',
        'L_USERNAME_/_RESELLER_ID' => 'Reseller name / Reseller ID',
        'L_GOLD'                   => 'Gold',
        'L_REASON_GOLD'            => 'Reason coin are reduced',
        'L_DATE_CREATED'           => 'Date created',
        'L_BUY_GOLD'               => 'Buy Gold',
        'L_BUY_AMOUNT'             => 'Buy amount',
        'L_SELL_GOLD'              => 'Sell Gold',
        'L_REWARD_GOLD'            => 'Reward Gold',
        'L_CORRECTION_GOLD'        => 'Correction Gold',
        'L_USERNAME_RESELLER'    => 'Username reseller',
        'L_RESELLER_ID'          => 'Reseller ID',
        'L_ADD_TRANS_GOLD'       => 'Add Transaction Gold',
        'L_ORDER_ID'             => 'Order ID',
        'L_DATE_APPROVE'         => 'Date Approve',
        'L_ITEM_NAME'            => 'Item Name',
        'L_QUANTITY'             => 'Quantity',
        'L_PRICE_ITEM'           => 'Item Price',
        'L_BONUS_ITEM'           => 'Item Bonus',
        'L_DATE_REQUEST'         => 'Date Request',
        'L_DATE_APPROVE_DECLINE' => 'Date approve and decline',
        'L_CONFIRMATION_REQUEST' => 'Request confirmation',
        'L_INFORMATION_DETAIL'   => 'Information Detail',
        'L_DATE_SELL'            => 'Date Sell ',
        'L_PLAYER_ID'            => 'Player ID',
        'L_USERNAME_PLAYER'      => 'Username Player',
        'L_STATUS'               => 'Status',
        'L_TOTAL_GOLD'           => 'Total Gold',
        'L_USERNAME'             => 'Username Reseller',
        'L_ACTION'               => 'Action',
        'L_STATUS_TRANSACTION'   => 'Status Transaction',
        'L_TIMESTAMP'            => 'TimeStamp',
        'L_ORDER_TRANSACTION'    => 'ID Order / Transaction',
        'L_DATE_BUY_SELL'        => 'Date Buy / Sell',
        'L_SEARCH'               => 'Search',
        'L_MAKE_NEW'             => 'Create new',
        'L_ITEM_BONUS'           => 'Item bonus',
        'L_ITEM_BONUS_IMAGE'     => 'Image Item Bonus',
        'L_ITEM_BONUS_GET'       => 'Item bonus get',
        'L_SEARCH'               => 'Search',
        'L_ALL_BANK'             => 'All Bank'

    ];
    return $array_menuContent[$menu];
}


function ConfigTextTranslate($menu){

    $array_menuContent = [

        "L_DENIED"       => "Denied",
        "L_ACCESS"       => "Access",
        "L_EDIT"         => "Edit",
        "L_LOGIN"        => "Login",
        "L_LOGOUT"       => "Logout",
        "L_PENDING"      => "Pending",
        "L_SUCCESS"      => "Success",
        "L_FAILED"       => "Failed",
        "L_BET"          => "Bet",
        "L_WIN"          => "Win",
        "L_LOSE"         => "Lose",
        "L_DRAW"         => "Draw",
        "L_TRANSFER_IN"  => "Transfer In",
        "L_TRANSFER_OUT" => "Transfer Out",
        "L_FREE"         => "Free",
        "L_BONUS"        => "Bonus",
        "L_GIFT"         => "Gift",
        "L_REWARD"       => "Reward",
        "L_BUY"          => "Buy",
        "L_PLAYER"       => "Player",
        "L_GUEST"        => "Guest",
        "L_BOT"          => "Bot",
        "L_DISABLED"     => "Disabled",
        "L_ENABLED"      => "Enabled",
        "L_CHIP"         => "Chip",
        "L_GOLD"         => "Gold",
        "L_GOOD"         => "Goods",
        "L_FOOD"         => "Food",
        "L_DRINK"        => "Drink",
        "L_ITEM"         => "Item",
        "L_ACTION"       => "Action",
        "L_CORRECTION"   => "Correction",
        "L_ADJUST"       => "Adjust",
        "Lose"           => "Lose",
        "Win"            => "Win",
        // "1"                                                 =>  "1",
        "" => ""

    ];
    return $array_menuContent[$menu];
};

function alertTranslate($menu){

    $array_menuContent = [

        "insert data successful"                                        =>  "Insert Data successfull",
        'L_INSERT_SUCCESSFULL'                                          =>  "Inser Data successfull",
        "Successful image"                                              =>  "Successfull Image",
        "Failed"                                                        =>  "Failed",
        "end date can't be less than start date"                        =>  "end date can't be less than start date",
        "balance cannot be reduced"                                     =>  "balance cannot be reduced",
        "balance cannot be reduced, please enter the appropriate amount"=>  "balance cannot be reduced, please enter the appropriate amount",
        "Successful update"                                             =>  "Successfull update",
        "Name can't be NULL"                                            =>  "Nama can't be Null",
        "File extensions are not allowed, you must use .jpg"            =>  "File extensions are not allowed, you must use .jpg",
        "Update Image Successfull"                                      =>  "Update image successfull",
        "format must be jpg and pictorial"                              =>  "Format must be jpg and pictorial",
        "Data deleted"                                                  =>  "Date deleted",
        "Something wrong"                                               =>  "Something wrong",
        "Min Date And Max Date Must be Filled In"                       =>  "Min Date and Max Date must be filled In",
        "Data Added"                                                    =>  "Data added",
        "Max Buy can't be under Min Buy"                                =>  "Max buy can't be under min buy",
        "Size Image it's too Big"                                       =>  "Size image it's too Big",
        "Image must be in png"                                          =>  "Image must be in png",
        "Price can't be NULL"                                           =>  "Price can't be Null",
        "File extensions are not allowed"                               =>  "File extensions are not allowed",
        "Data Updated"                                                  =>  "Data updated",
        "Update can't be process"                                       =>  "Updated can't be process",
        "Category can't be NULL"                                        =>  "Category can't be Null",
        "Your image source size height is more than 319 px and width is more than 384" => "Your image source size height is more than 319 px dan width is more than 384",
        "format must be png and pictorial"                              =>  "Format must be png and pictorial",
        "ID must be fill"                                               =>  "ID must be fill",
        "Username or Password are wrong!!"                              =>  "Username or Password are wrong!",
        "You are already Log Out"                                       =>  "You are already Log out",
        "Update status successfull"                                     =>  "Update status successfull",
        "Input Data successfull with "                                  =>  "Input data successfull with",
        "Number of inputs filled in player ID can't be NULL"            =>  "Number of inputs filled in player ID can't be NULL",
        "You must to Choose Status"                                     =>  "You must to choose status",
        "Data input successfull"                                        =>  "Data input successfull", 
        "L_RESET_PASSWORD_SUCCESS"                                      =>  "Reset password successfull",
        "L_PASSWORD_NULL"                                               =>  "Password NULL",
        "REGISTER SUCCESSFULL"                                          =>  "Register Successfull",
        "L_APPROVED_SUCCESSFULL"                                        =>  "Approved successfull",
        "L_DECLINED_SUCCESSFULL"                                        =>  "Declinde successfull",
        "File size too large"                                           =>  "File size too large",
        "Receiving request Transaction has been successful"             =>  "Receiving request transaction has been successfull",
        "Reject request Transaction has been successful"                =>  "Reject request Transaction has been successfull",
        "Role Name is Null"                                             =>  "Role name is Null",
        "your Big blind can't be under Minbuy divided 10 "              =>  "Your Big blind can't be under minbuy",
        "your Small Blind can't be under Big Blind divided 2 "          =>  "Your small blind can't be under big blind divided 2",
        "Min buy table can't be under Min Buy room"                     =>  "Min buy table can't be under min buy room",
        "Max buy table can't be up to max buy room"                     =>  "Max buy table can't be under max buy room",
        "Min Buy can't be under Stake multiplied by 3 multiplied 13 or under "  =>  "Min Buy can't be under Stake multiplied by 3 multiplied 13 or under",
        "Max buy can't be under min buy"                                =>  "Max buy can't be under min buy",
        "Min buy can't be under max buy"                                =>  "Min buy can't be under max buy",
        "Max buy can't be up to max buy room"                           =>  "Max buy can't be up to max room max buy",
        "Max buy can't be under Stake multiplied by 10 or under "       =>  "Max buy can't be under Stake multiplied by 10 or under",
        "Max buy can't be under Min buy multiplied by 4 or under "      =>  "Max buy can't be under Min buy multiplied by 4 or under",
        "Min buy can't be under stake multiplied by 10 or under"        =>  "Min buy can't be under stake multiplied by 10 or under",
        "Max buy can't be under Min Buy multiplied by 2 or under"       =>  "Max buy can't be under Min Buy multiplied by 2 or under",
        "your Small Blind can't be under Big Blind divided 2 or under"  =>  "your Small Blind can't be under Big Blind divided 2 or under",
        "Max buy can't be under Stake multiplied by 2 or under"         =>  "Max buy can't be under Stake multiplied by 2 or under",
        "Min buy can't be under to min buy room "                       =>  "Min buy can't be under to min buy room",
        "Max Buy can't be under Stake multiplied by 4 or under "        =>  "Max Buy can't be under Stake multiplied by 4 or under",
        "Max Buy table can't be Up to Max Buy room"                     =>  "Max Buy table can't be Up to Max Buy room",
        "You didn't allow to delete your account"                       =>  "You didn't allow to delete your account",
        "Data saved"                                                    =>  "Data saved!",
        "Data added"                                                    =>  "Data added",
        "Operator Still use this role, wait until role didnott use"     =>  "Operator Still use this role, wait until role didnott use",
        "For Type Adjust number didnot allowed negative"                =>  "For Type Adjust number didnot allowed negative",
        "For type Bonus or Free number not allowed negative number"     =>  "For type Bonus or Free number not allowed negative number",
        "User ID"                                                       =>  "User ID",
        "Balance Chip"                                                  =>  "Chip balance",
        "Balance Point"                                                 =>  "Point Balance",
        "Balance Gold"                                                  =>  "Koin Balance",
        "Transaction Chip"                                              =>  "Chip Transaction",
        "Transaction Gold"                                              =>  "Gold Transaction",
        "Transaction Point"                                             =>  "Poin Transaction",
        "L_PASSWORD_FAILED"                                             =>  "Passwords do not match, please try again",
        "L_LOGOUT_CHANGE_PASSWORD"                                      =>  "Your password has been changed",
        "Update image successfull"                                      =>  "Update image succesfull",
        'L_HEIGHT_IMAGE'                                                =>  "Image height cannot be less or more than {1}"
    ];
    return $array_menuContent[$menu];
};

function Translateaction_id($menu){

    $array_menuContent  =   [
        
        "Change Password Admin"     =>      "Change password admin",
        "Edit Admin"                =>      "Edit admin",
        "Create Admin"              =>      "Creat admin",
        "Delete Admin"              =>      "Delete admin",
        "Approve Admin"             =>      "Approve admin",
        "Decline Admin"             =>      "Decline admin",
        "Log In Admin"              =>      "login Admin",
        "Log Out Admin"             =>      "logout Admin",
        "Buy chip with gold"        =>      "Buy chip with gold",
        "Daily Award"               =>      "Daily award",
        "Bot Join Table"            =>      "Bot join Table",
        "Join Game"                 =>      "Join the game",
        "Sitout Game"               =>      "Sitout Game",
        "Register User"             =>      "User Register",
        "Give Gold"                 =>      "Give Gold",
        "Buy Gold"                  =>      "Buy Gold",
        "Skilled Bonus Gold"        =>      "Skilled Gold Bonus",
        "Newbie Bonus Gold"         =>      "Newbie Gold Bonus",
        "Create Player"             =>      "Create Player",
        "Delete Player"             =>      "Delete Player",
        "Edit Player"               =>      "Edit Player",
        "Change Password Player"    =>      "Change Password Player",
        "Login Player"              =>      "Login Player",
        "Approve Account Player"    =>      "Approved player account",
        "Banned Account Player"     =>      "Banned player account",
        "Problem Account Player"    =>      "Proble player account",
        "Upgrade Account"           =>      "Upgrade account",
        "L_EDIT_CHIP_STORE"         =>      "Edit Chip Store",
        'L_EDIT_GOODS_STORE'        =>      'Edit Goods Store',
        "L_EDIT_PLAYER"             =>      'Edit Player',
        'L_LOGIN_PLAYER'            =>      'Login Player',
        'L_UPGRADE_ACCOUNT'         =>      'Upgrade account',
        'L_PROBLEM_ACCOUNT_PLAYER'  =>      'Problem player account',
        'L_BANNED_ACCOUNT_PLAYER'   =>      'Banned player account',
        'L_EDIT_GAME_SETTING'       =>      'Edit Game setting'
    ];
    return $array_menuContent[$menu];
};

function TranslateTransactionHist($menu){

    $array_menuContent = [
        
        "success"                   =>  "success",
        "pending"                   =>  "pending",
        "Decline"                   =>  "decline",
        "Approve"                   =>  "approve",
        "GPA.3355-0553-1720-23050"  =>  "GPA.3355-0553-1720-23050",
        "nothing"                   =>  "nothing",
        "tidak jelas"               =>  "not clear",
    

    ];
    return $array_menuContent[$menu];
};

function TranslateTransaksiAgen($menu){

    $array_menuContent = [
    
        "L_PURCHASE_DATE"   =>  "Purchase date",
        "L_USER_ID"         =>  "User ID",
        "L_ID_ORDER"        =>  "Order ID",
        "L_TRANSACTION_TYPE"=>  "Transaction type"
    ];
    return $array_menuContent[$menu];
};


function TranslateVersionAsetApk($menu)
{
    $array_menuContent = [
        
        "L_IMAGE"   =>  "Image",
        "L_AUDIO"   =>  "Audio",
        "L_SCENE"   =>  "Scene"
           
    ];
    return $array_menuContent[$menu];
}

function TranslatePlaceholdertxt($placeholder) {
    $array_menuContent = [
        
        "L_PASSWORD"             => "Password",
        "L_PASSWORD_WANT_CHANGE" => "Password want to change",
        "L_PASSWORD_SELF"        => "Enter the password being logged in",
        "L_CHOOSE_ROLE_ADMIN"    => "Choose role admin",
        "L_CHOOSE_TYPE"          => "Choose type",
        "L_MONTHLY"              => "Monthly",
        "L_WEEKLY"               => "Weekly",
    ];
    return $array_menuContent[$placeholder];
}



function TranslateChoices($menu) {
    $array_menuContent = [

        "L_CHOOSE_TIMER"    =>  "choose timer",
        "L_CHOOSE_CATEGORY" =>  "choose category",
        "L_CHOOSE_SEAT"     =>  "choose seat"
    ];
    return $array_menuContent[$menu];
}

function TranslateColumnName($menu) {
    $array_menuContent = [

        "L_FULLNAME"    =>  "Fullname",
        "L_ROLETYPE"    =>  "Roletype",
        ""
    ];
    return $array_menuContent[$menu];
}

function TranslateLogDesc($menu) {
    $array_menuContent = [
        "L_LOG_CREATE"          =>  "Add data in the menu",
        "L_LOG_EDIT"            =>  "Edit",
        "L_LOG_EDIT_PASSWORD"   =>  "Edit password with username",
        "L_LOG_DELETE"          =>  "Delete"
        // "L_PASSWORD"      =>  "Edit kata sandi di menu Pengguna Admin dengan Nama Pengguna {1}"
    ];
    return $array_menuContent[$menu];
}

function TranslateGameSetting($menu)
{
    $array_menuContent = [
        "bet_fee"    =>  "Bet fee",
        "bet_point"  =>  "Bet Point",
        "countdown"  =>  "Countdown",
        "jp_fee"     =>  "jackpot fee",
        "jp_flush"   =>  "Jackpot Flush",
        "jp_four_kind"  =>  "Jackpot 4 Kind",
        "jp_fullhouse"  =>  "Jackpot Full House",
        "jp_royal_flush" => "Jackpot Royal Flush",
        "jp_straight_flush" =>  "Jackpot Straight Flush",
        "lose_exp"      =>  $menu,
        "timer_fast"    =>  $menu,
        "timer_normal"  =>  $menu
    ];
    return $array_menuContent[$menu];

}

function TranslateTranstype($menu)
{
    $array_menuContent = [
        "L_BANK_TRANSFER"   =>  "Bank transfer",
        "L_INTERNET_BANKING"=>  "Internet banking",
        "L_E_MONEY"         =>  "E money",
        "L_MERCHANT"        =>  "Merchant",
        "L_CREDIT_CARD"     =>  "Credit card"
    ];
    return $array_menuContent[$menu];
}



?>