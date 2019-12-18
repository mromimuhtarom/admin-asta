<?php

function xmlfile()
{
    // $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    
    return $xml;
}

//===========================TRANSLATE SIDEMENU===========================//
function translate_menu($menu){

    // dd(xmlfile()->L_Email_Notification->attributes()->val);
  
    $array_menu = [
      'Dashboard'                       =>  xmlfile()->L_Dashboard->attributes()->val, 
      'Admin'                           =>  xmlfile()->L_Admin->attributes()->val,
      'User_Admin'                      =>  xmlfile()->L_User_Admin->attributes()->val,
      'Role_Admin'                      =>  xmlfile()->L_Role_Admin->attributes()->val,
      'Log_Admin'                       =>  xmlfile()->L_Log_Admin->attributes()->val,
      'Active_Admin'                    =>  xmlfile()->L_Active_Admin->attributes()->val,
      'Report_Admin'                    =>  xmlfile()->L_Report_Admin->attributes()->val,
      'Transaction'                     =>  xmlfile()->L_Transaction->attributes()->val,
      'Banking_Transactions'            =>  xmlfile()->L_Banking_Transactions->attributes()->val,
      'User_Bank_Transaction'           =>  xmlfile()->L_User_Bank_Transaction->attributes()->val,
      'Reward_Transaction'              =>  xmlfile()->L_Reward_Transaction->attributes()->val,
      'Add_Transaction'                 =>  xmlfile()->L_AddTransaction->attributes()->val,
      'Players'                         =>  xmlfile()->L_Players->attributes()->val,
      'Active_Players'                  =>  xmlfile()->L_Active_Players->attributes()->val,
      'Report_Players'                  =>  xmlfile()->L_Report_Players->attributes()->val,
      'High_Roller'                     =>  xmlfile()->L_High_Roller->attributes()->val,
      'Registered_Players'              =>  xmlfile()->L_Registered_Players->attributes()->val,
      'Guest'                           =>  xmlfile()->L_Guest->attributes()->val,
      'Bots'                            =>  xmlfile()->L_Bots->attributes()->val,
      'Play_Report'                     =>  xmlfile()->L_Play_Report->attributes()->val,
      'Chip_Players'                    =>  xmlfile()->L_Chip_Players->attributes()->val,
      'Gold_Players'                    =>  xmlfile()->L_Gold_Players->attributes()->val,
      'Point_Players'                   =>  xmlfile()->L_Point_Players->attributes()->val,
      'Register_Player_ID'              =>  xmlfile()->L_Register_Player_ID->attributes()->val,
      'Log_Players'                     =>  xmlfile()->L_Log_Players->attributes()->val,
      'Transaction_Players'             =>  xmlfile()->L_Transaction_Players->attributes()->val,
      'Players_Level'                   =>  xmlfile()->L_Players_level->attributes()->val,
      'Slide_Banner'                    =>  xmlfile()->L_Slide_Banner->attributes()->val,
      'Item'                            =>  xmlfile()->L_Item->attributes()->val,
      'Table_Gift'                      =>  xmlfile()->L_Table_Gift->attributes()->val,
      'Report_Gift'                     =>  xmlfile()->L_Report_Gift->attributes()->val,
      'Emoticon'                        =>  xmlfile()->L_Emoticon->attributes()->val,
      'Game'                            =>  xmlfile()->L_Game->attributes()->val,
      'Asta-Poker'                      =>  xmlfile()->L_AstaPoker->attributes()->val,
      'Table_Asta_Poker'                =>  xmlfile()->L_Table_Asta_Poker->attributes()->val,
      'Category_Asta_Poker'             =>  xmlfile()->L_Category_Asta_Poker->attributes()->val,
      'Season_Asta_Poker'               =>  xmlfile()->L_Season_Asta_Poker->attributes()->val,
      'Season_Reward_Asta_Poker'        =>  xmlfile()->L_Season_Reward_Asta_Poker->attributes()->val,
      'Tournament_Asta_Poker'           =>  xmlfile()->L_Tournament_Asta_Poker->attributes()->val,
      'Jackpot_Paytable_Asta_Poker'     =>  xmlfile()->L_Jackpot_Paytable_Asta_Poker->attributes()->val,
      'Big-Two'                         =>  xmlfile()->L_Big_Two->attributes()->val,
      'Table_Big_Two'                   =>  xmlfile()->L_Table_Big_Two->attributes()->val,
      'Category_Big_Two'                =>  xmlfile()->L_Category_Big_Two->attributes()->val,
      'Season_Big_Two'                  =>  xmlfile()->L_Season_Reward_Big_Two->attributes()->val,
      'Season_Reward_Big_Two'           =>  xmlfile()->L_Season_Reward_Big_Two->attributes()->val,
      'Tournament_Big_Two'              =>  xmlfile()->L_Tournament_Big_Two->attributes()->val,
      'Jackpot_Paytable_Big_Two'        =>  xmlfile()->L_Jackpot_Paytable_Big_Two->attributes()->val,
      'Domino-Susun'                    =>  xmlfile()->L_Domino_Susun->attributes()->val,
      'Table_Domino_Susun'              =>  xmlfile()->L_Table_Domino_Susun->attributes()->val,
      'Category_Domino_Susun'           =>  xmlfile()->L_Category_Domino_Susun->attributes()->val,
      'Season_Domino_Susun'             =>  xmlfile()->L_Season_Domino_Susun->attributes()->val,
      'Season_Reward_Domino_Susun'      =>  xmlfile()->L_Season_Reward_Domino_Susun->attributes()->val,
      'Tournament_Domino_Susun'         =>  xmlfile()->L_Tournament_Domino_Susun->attributes()->val,
      'Jackpot_Paytable_Domino_Susun'   =>  xmlfile()->L_Jackpot_Paytable_Domino_Susun->attributes()->val,
      'Domino-QQ'                       =>  xmlfile()->L_DominoQQ->attributes()->val,
      'Table_Domino_QQ'                 =>  xmlfile()->L_Table_Domino_QQ->attributes()->val,
      'Category_Domino_QQ'              =>  xmlfile()->L_Category_Domino_QQ->attributes()->val,
      'Season_Domino_QQ'                =>  xmlfile()->L_Season_Domino_QQ->attributes()->val,
      'Season_Reward_Domino_QQ'         =>  xmlfile()->L_Season_Reward_Domino_QQ->attributes()->val,
      'Tournament_Domino_QQ'            =>  xmlfile()->L_Tournament_Domino_QQ->attributes()->val,
      'Jackpot_Paytable_Domino_QQ'      =>  xmlfile()->L_Jackpot_Paytable_Domino_QQ->attributes()->val,
      'Game_Setting'                    =>  xmlfile()->L_Game_Setting->attributes()->val,
      'Store'                           =>  xmlfile()->L_Store->attributes()->val,
      'Best_Offer'                      =>  xmlfile()->L_Best_Offer->attributes()->val,
      'Chip_Store'                      =>  xmlfile()->L_Chip_Store->attributes()->val,
      'Gold_Store'                      =>  xmlfile()->L_Gold_Store->attributes()->val,
      'Goods_Store'                     =>  xmlfile()->L_Goods_Store->attributes()->val,
      'Payment_Store'                   =>  xmlfile()->L_Payment_Store->attributes()->val,
      'Report_Store'                    =>  xmlfile()->L_Report_Store->attributes()->val,
      'Notification'                    =>  xmlfile()->L_Notification->attributes()->val,
      'Push_Notification'               =>  xmlfile()->L_Push_Notification->attributes()->val,
      'Email_Notification'              =>  xmlfile()->L_Email_Notification->attributes()->val,
      'FeedBack'                        =>  xmlfile()->L_FeedBack->attributes()->val,
      'Report_Abuse_Player'             =>  xmlfile()->L_Report_Abuse_Player->attributes()->val,
      'Abuse_Transaction_Report'        =>  xmlfile()->L_Abuse_Transaction_Report->attributes()->val,
      'Feedback_Game'                   =>  xmlfile()->L_Feedback_Game->attributes()->val,
      'Settings'                        =>  xmlfile()->L_Settings->attributes()->val,
      'General_Setting'                 =>  xmlfile()->L_General_Setting->attributes()->val,
      'Reseller'                        =>  xmlfile()->L_Reseller->attributes()->val,
      'List_Reseller'                   =>  xmlfile()->L_List_Reseller->attributes()->val,
      'Reseller-Transaction'            =>  xmlfile()->L_Reseller_Transaction->attributes()->val,
      'Request_Transaction'             =>  xmlfile()->L_Request_Transaction->attributes()->val,
      'Report_Transaction'              =>  xmlfile()->L_Report_Transaction->attributes()->val,
      'Balance_Reseller'                =>  xmlfile()->L_Balance_Reseller->attributes()->val,
      'Item_Store_Reseller'             =>  xmlfile()->L_Item_Store_Reseller->attributes()->val,
      'Reseller_Rank'                   =>  xmlfile()->L_Reseller_Rank->attributes()->val,
      'Register_Reseller'               =>  xmlfile()->L_Register_Reseller->attributes()->val,
      'Version_Asset_Apk'               =>  xmlfile()->L_Version_Asset_Apk->attributes()->val,
      'logout'                          =>  xmlfile()->L_logout->attributes()->val
    ];

    return $array_menu[$menu];
}


//=================================MENU ADMIN===============================//
function translate_MenuContentAdmin($menu){
    
    $array_menuContent = [

        'Admin'                         =>  xmlfile()->L_Admin->attributes()->val,
        'User Admin'                    =>  xmlfile()->L_UserAdmin->attributes()->val,
        'Role Admin'                    =>  xmlfile()->L_RoleAdmin->attributes()->val,
        'Log Admin'                     =>  xmlfile()->L_LogAdmin->attributes()->val,
        'Active Admin'                  =>  xmlfile()->L_ActiveAdmin->attributes()->val,
        'Report Admin'                  =>  xmlfile()->L_ReportAdmin->attributes()->val,
        'Create User Admin'             =>  xmlfile()->L_CreateUserAdmin->attributes()->val,
        'Create Role Admin'             =>  xmlfile()->L_CreateRoleAdmin->attributes()->val,
        'Choose Action'                 =>  xmlfile()->L_ChooseAction->attributes()->val,
        
        //PILIH AKSI
        'Create Admin'                  =>  xmlfile()->L_CreateAdmin->attributes()->val,
        'Delete Admin'                  =>  xmlfile()->L_DeleteAdmin->attributes()->val,
        'Edit Admin'                    =>  xmlfile()->L_EditAdmin->attributes()->val,
        'Decline Admin'                 =>  xmlfile()->L_DeclineAdmin->attributes()->val,
        'Approve Admin'                 =>  xmlfile()->L_ApproveAdmin->attributes()->val,
        'Change Password Admin'         =>  xmlfile()->L_ChangePasswordAdmin->attributes()->val,


        'Choose Role'                   =>  xmlfile()->L_ChooseRole->attributes()->val,
        'Choose Log Type'               =>  xmlfile()->L_ChooseLogType->attributes()->val,
        'Players Online'                =>  xmlfile()->L_PlayersOnline->attributes()->val,
        'Save'                          =>  xmlfile()->L_Save->attributes()->val,
        'Search'                        =>  xmlfile()->L_Search->attributes()->val,
        'Cancel'                        =>  xmlfile()->L_Cancel->attributes()->val,
        'Change title to update and save instantly!' => xmlfile()->L_Change_title_to_update_and_save_instantly->attributes()->val,
        'Create New User'               =>  xmlfile()->L_CreateNewUser->attributes()->val,
        'Create New Role'               =>  xmlfile()->L_CreateNewRole->attributes()->val,
        'Select All'                    =>  xmlfile()->L_SelectAll->attributes()->val,
        'Admin ID'                      =>  xmlfile()->L_AdminID->attributes()->val,
        'Admin Report'                  =>  xmlfile()->L_AdminReport->attributes()->val,
        'Player ID'                     =>  xmlfile()->L_PlayerID->attributes()->val,
        'Username'                      =>  xmlfile()->L_Username->attributes()->val,
        'Status'                        =>  xmlfile()->L_Status->attributes()->val,
        'Role Name'                     =>  xmlfile()->L_RoleName->attributes()->val,
        'Full Name'                     =>  xmlfile()->L_FullName->attributes()->val,
        'Role Type'                     =>  xmlfile()->L_RoleType->attributes()->val,
        'Date'                          =>  xmlfile()->L_Date->attributes()->val,
        'Date Login'                    =>  xmlfile()->L_DateLogin->attributes()->val,
        'Time Stamp'                    =>  xmlfile()->L_TimeStamp->attributes()->val,
        'Ip'                            =>  xmlfile()->L_IP->attributes()->val,
        'Description'                   =>  xmlfile()->L_Description->attributes()->val,
        'Action'                        =>  xmlfile()->L_Action->attributes()->val,
        'Reset Password'                =>  xmlfile()->L_ResetPassword->attributes()->val,
        'Delete Data'                   =>  xmlfile()->L_DeleteData->attributes()->val,
        'View & Edit'                   =>  xmlfile()->L_ViewEdit->attributes()->val,
        'Are You Sure Want To Delete It?'            =>  xmlfile()->L_AreYouSureWantToDeleteIt->attributes()->val,
        'Yes'                           =>  xmlfile()->L_Yes->attributes()->val,
        'No'                            =>  xmlfile()->L_No->attributes()->val,
        'Delete all selected Data'      =>  xmlfile()->L_DeleteAllSelectedData->attributes()->val,
        'Are You Sure Want To Delete all selected?'  =>  xmlfile()->L_Are_you_sure_want_to_delete_all_selected->attributes()->val,
    ];

    return $array_menuContent[$menu];
}


//=========================MENU TRANSACTION========================//
function translate_menuTransaction($menu){

    $array_menuContent = [

        'Transaction'           =>  xmlfile()->L_Transaction->attributes()->val,
        'Reward Transaction'    =>  xmlfile()->L_RewardTransaction->attributes()->val,
        'Banking Transaction'   =>  xmlfile()->L_BankingTransaction->attributes()->val,
        'User Bank Transaction' =>  xmlfile()->L_UserBankTransaction->attributes()->val,
        
        
        //PILIH AKSI
        'Choose Time'           =>  xmlfile()->L_ChooseTime->attributes()->val,
        'Today'                 =>  xmlfile()->L_Today->attributes()->val,
        'Week'                  =>  xmlfile()->L_Week->attributes()->val,
        'Month'                 =>  xmlfile()->L_Month->attributes()->val,
        'All time'              =>  xmlfile()->L_AllTime->attributes()->val,

        'Time Stamp'            =>  xmlfile()->L_Timestamp->attributes()->val,
        'Bank Transaction'      =>  xmlfile()->L_BankTransaction->attributes()->val,
        'Bank Manual Transfer'  =>  xmlfile()->L_BankManualTransfer->attributes()->val,
        'ID Player'             =>  xmlfile()->L_ID_Player->attributes()->val,
        'Item'                  =>  xmlfile()->L_Item->attributes()->val,
        'Quantity'              =>  xmlfile()->L_Quantity->attributes()->val,
        'Price'                 =>  xmlfile()->L_Price->attributes()->val,
        'Detail Information'    =>  xmlfile()->L_DetailInformation->attributes()->val,
        'buy'                   =>  xmlfile()->L_buy->attributes()->val,
        'using'                 =>  xmlfile()->L_using->attributes()->val,
        'at price'              =>  xmlfile()->L_atPrice->attributes()->val,
        'Awarded'               =>  xmlfile()->L_Awarded->attributes()->val,
        'Type'                  =>  xmlfile()->L_Type->attributes()->val,
        'Status'                =>  xmlfile()->L_Status->attributes()->val,
        'Decline'               =>  xmlfile()->L_Decline->attributes()->val,
        'Decline Transaction'   =>  xmlfile()->L_DeclineTransaction->attributes()->val,
        'Approve Transaction'   =>  xmlfile()->L_ApproveTransaction->attributes()->val,
        'Are you sure want to Decline this Transaction?'    =>  xmlfile()->L_AreYouSureWantToDeclineThisTransaction->attributes()->val,
        'Are you sure want to Approve this Transaction?'    =>  xmlfile()->L_AreYouSureWantToApproveThisTransaction->attributes()->val,
        'Approve'               =>  xmlfile()->L_Approve->attributes()->val,
        'Pending'               =>  xmlfile()->L_Pending->attributes()->val,
        'Status Payment'        =>  xmlfile()->L_StatusPayment->attributes()->val,
        'Confirm request'       =>  xmlfile()->L_ConfirmRequest->attributes()->val,
        'Username'              =>  xmlfile()->L_Username->attributes()->val,
        'Date'                  =>  xmlfile()->L_Date->attributes()->val,
        'Win'                   =>  xmlfile()->L_Win->attributes()->val,
        'Lose'                  =>  xmlfile()->L_Lose->attributes()->val,
        'Turn Over'             =>  xmlfile()->L_TurnOver->attributes()->val,
        'Fee'                   =>  xmlfile()->L_Fee->attributes()->val,
        'Yes'                   =>  xmlfile()->L_Yes->attributes()->val,
        'No'                    =>  xmlfile()->L_No->attributes()->val,
        'pending'               =>  xmlfile()->L_Pending->attributes()->val,
    ];
    return $array_menuContent[$menu];
}

function Translate_menuPlayers($menu){

    $array_menuContent = [

        'Players'                   =>  xmlfile()->L_Players->attributes()->val,
        'Active Players'            =>  xmlfile()->L_ActivePlayers->attributes()->val,
        'Report Player'             =>  xmlfile()->L_ReportPlayers->attributes()->val,
        'Play report'               =>  xmlfile()->L_PlayReport->attributes()->val,
        'Players Online'            =>  xmlfile()->L_PlayersOnline->attributes()->val,
        'Registered Player'         =>  xmlfile()->L_RegisteredPlayer->attributes()->val,
        'RegisteredPlayerID'        =>  xmlfile()->L_RegisteredPlayerID->attributes()->val,
        'LogPlayers'                =>  xmlfile()->L_LogPlayers->attributes()->val,
        'NumberOfIDsToBeAdded'      =>  xmlfile()->L_NumberOfIDsToBeAdded->attributes()->val,
        'Chip Players'              =>  xmlfile()->L_ChipPlayers->attributes()->val,
        'Gold Players'              =>  xmlfile()->L_GoldPlayers->attributes()->val,
        'Point Players'             =>  xmlfile()->L_PointPlayers->attributes()->val,
        'Guest'                     =>  xmlfile()->L_Guest->attributes()->val,
        'Choose Register Type'      =>  xmlfile()->L_ChooseRegisterType->attributes()->val,
        'Choose Game'               =>  xmlfile()->L_ChooseGame->attributes()->val,
        'Choose Log Type'           =>  xmlfile()->L_ChooseLogType->attributes()->val,
        'Choose status'             =>  xmlfile()->L_ChooseStatus->attributes()->val,
        'Choose User Type'          =>  xmlfile()->L_ChooseUserType->attributes()->val,
        'Choose Action'             =>  xmlfile()->L_ChooseAction->attributes()->val,
        'Total Record Entries is'   =>  xmlfile()->L_TotalRecordEntriesIs->attributes()->val,
        'Create user guest ID'      =>  xmlfile()->L_CreateUserGuestID->attributes()->val,
        'Bank Account'              =>  xmlfile()->L_BankAccount->attributes()->val,
        'Country'                   =>  xmlfile()->L_Country->attributes()->val,
        'Create Player'             =>  xmlfile()->L_CreatePlayer->attributes()->val,
        'Delete Player'             =>  xmlfile()->L_DeletePlayer->attributes()->val,
        'Edit Player'               =>  xmlfile()->L_EditPlayer->attributes()->val,
        'Change Password Player'    =>  xmlfile()->L_ChangePasswordPlayer->attributes()->val,
        'Total Record Entries is'   =>  xmlfile()->L_TotalRecordEntriesIs->attributes()->val,
        'Player ID'                 =>  xmlfile()->L_PlayerID->attributes()->val,
        'Guest ID'                  =>  xmlfile()->L_GuestID->attributes()->val,
        'Device ID'                 =>  xmlfile()->L_DeviceID->attributes()->val,
        'Round ID'                  =>  xmlfile()->L_RoundID->attributes()->val,
        'Detail round ID'           =>  xmlfile()->L_DetailRoundID->attributes()->val,
        'ID Player already'         =>  xmlfile()->L_IDPlayerAlready->attributes()->val,
        'Player ID used'            =>  xmlfile()->L_PlayerIDUsed->attributes()->val,
        'Guest ID used'             =>  xmlfile()->L_GuestIDUsedIs->attributes()->val,
        'Bot ID used'               =>  xmlfile()->L_BotIDUsedIs->attributes()->val,
        'Player ID didnt use'       =>  xmlfile()->L_PlayerIDDidntUse->attributes()->val,
        'Guest ID didnt use'        =>  xmlfile()->L_GuestIDDidntUse->attributes()->val,
        'Bot ID didnt use'          =>  xmlfile()->L_BotIDDidntUse->attributes()->val,
        'Total Player ID'           =>  xmlfile()->L_TotalPlayerID->attributes()->val,
        'Total Guest ID'            =>  xmlfile()->L_TotalGuestID->attributes()->val,
        'Total Bot ID'              =>  xmlfile()->L_TotalBotID->attributes()->val,
        'Playername'                =>  xmlfile()->L_Playername->attributes()->val,
        'Game'                      =>  xmlfile()->L_Game->attributes()->val,
        'UserType'                  =>  xmlfile()->L_UserType->attributes()->val,
        'Username'                  =>  xmlfile()->L_Username->attributes()->val,
        'Desc'                      =>  xmlfile()->L_Desc->attributes()->val,
        'Playing Game'              =>  xmlfile()->L_PlayingGame->attributes()->val,
        'Rank'                      =>  xmlfile()->L_Rank->attributes()->val,
        'Table'                     =>  xmlfile()->L_Table->attributes()->val,
        'Hand card'                 =>  xmlfile()->L_HandCard->attributes()->val,
        'Seat'                      =>  xmlfile()->L_Seat->attributes()->val,
        'Sit'                       =>  xmlfile()->L_Sit->attributes()->val,
        'Bet'                       =>  xmlfile()->L_Bet->attributes()->val,
        'Win Lose'                  =>  xmlfile()->L_Win->attributes()->val,
        'Chip'                      =>  xmlfile()->L_Chip->attributes()->val,
        'Goods'                     =>  xmlfile()->L_Point->attributes()->val,
        'Point'                     =>  xmlfile()->L_Point->attributes()->val,
        'Action'                    =>  xmlfile()->L_Action->attributes()->val,
        'Gold Coins'                =>  xmlfile()->L_GoldCoins->attributes()->val,
        'Card'                      =>  xmlfile()->L_Card->attributes()->val,
        'Domino'                    =>  xmlfile()->L_Domino->attributes()->val,
        'Card Table'                =>  xmlfile()->L_CardTable->attributes()->val,
        'Device Timer'              =>  xmlfile()->L_DeviceTimer->attributes()->val,
        'Used'                      =>  xmlfile()->L_Used->attributes()->val,
        'Non used'                  =>  xmlfile()->L_NonUsed->attributes()->val,
        'From'                      =>  xmlfile()->L_From->attributes()->val,
        'Debit'                     =>  xmlfile()->L_Debit->attributes()->val,
        'Credit'                    =>  xmlfile()->L_Credit->attributes()->val,
        'Total'                     =>  xmlfile()->L_Total->attributes()->val,
        'Playing Games'             =>  xmlfile()->L_PlayingGames->attributes()->val,
        'Table Name'                =>  xmlfile()->L_TableName->attributes()->val,
        'Timestamp'                 =>  xmlfile()->L_Timestamp->attributes()->val,
        'Status'                    =>  xmlfile()->L_Status->attributes()->val,
        'Date Created'              =>  xmlfile()->L_DateCreated->attributes()->val,
        'Register Form'             =>  xmlfile()->L_RegisterForm->attributes()->val,
        'IP'                        =>  xmlfile()->L_IP->attributes()->val,
        'Player'                    =>  xmlfile()->L_Player->attributes()->val,
        'Guest'                     =>  xmlfile()->L_Guest->attributes()->val,
        'Approve'                   =>  xmlfile()->L_Approve->attributes()->val,
        'Banned'                    =>  xmlfile()->L_Banned->attributes()->val,
        'Problem'                   =>  xmlfile()->L_Problem->attributes()->val,
        'Save'                      =>  xmlfile()->L_Save->attributes()->val,
        'Cancel'                    =>  xmlfile()->L_Cancel->attributes()->val,

    ];
    return $array_menuContent[$menu];
}


function TranslateMenuItem($menu){

    $array_menuContent = [

        'Item'              =>  xmlfile()->L_Item->attributes()->val,
        'Table Gift'        =>  xmlfile()->L_TableGift->attributes()->val,
        'Create New Gift'   =>  xmlfile()->L_CreateNewGift->attributes()->val,
        'Report Gift'       =>  xmlfile()->L_ReportGift->attributes()->val,
        'Select All'        =>  xmlfile()->L_SelectAll->attributes()->val,
        'Image'             =>  xmlfile()->L_Image->attributes()->val,
        'Title'             =>  xmlfile()->L_Title->attributes()->val,
        'Price'             =>  xmlfile()->L_Price->attributes()->val,
        'Category'          =>  xmlfile()->L_Category->attributes()->val,
        'Status'            =>  xmlfile()->L_Status->attributes()->val,
        'Main Image'        =>  xmlfile()->L_MainImage->attributes()->val,
        'Save Gift'         =>  xmlfile()->L_SaveGift->attributes()->val,
        'Save'              =>  xmlfile()->L_Save->attributes()->val,
        'Cancel'            =>  xmlfile()->L_Cancel->attributes()->val,
        'Edit Gift'         =>  xmlfile()->L_EditGift->attributes()->val,
        'Create gift store' =>  xmlfile()->L_CreateGiftStore->attributes()->val,
        'DeleteData'        =>  xmlfile()->L_DeleteData->attributes()->val,
        'Are you sure want to delete it'    => xmlfile()->L_AreYouSureWantToDeleteIt->attributes()->val,
        'Yes'               =>  xmlfile()->L_Yes->attributes()->val,
        'No'                =>  xmlfile()->L_No->attributes()->val,
        'Delete all selected data'          => xmlfile()->L_DeleteAllSelectedData->attributes()->val,
        'Are U Sure'        =>  xmlfile()->L_AreUSure->attributes()->val,
        'Choose Game'       =>  xmlfile()->L_ChooseGame->attributes()->val,
        'Username'          =>  xmlfile()->L_Username->attributes()->val,
        'Action Game'       =>  xmlfile()->L_ActionGame->attributes()->val,
        'Date'              =>  xmlfile()->L_Date->attributes()->val,
        'Description'       =>  xmlfile()->L_Description->attributes()->val,
        'Emoticon'          =>  xmlfile()->L_Emoticon->attributes()->val,
        'Create New Emoticon'               => xmlfile()->L_CreateNewEmoticon->attributes()->val,
        'Create Emoticon'   =>  xmlfile()->L_CreateEmoticon->attributes()->val
    ];

    return $array_menuContent[$menu];

}


function TranslateMenuGame($menu){

    $array_menuContent = [
        'Table'             => xmlfile()->L_Table->attributes()->val,
        'Table Player'      => xmlfile()->L_TablePlayer->attributes()->val,
        'Change Title'      => xmlfile()->L_ChangeTitle->attributes()->val,
        'Create New Table'  => xmlfile()->L_CreateNewTable->attributes()->val, 
        'Table Name'        => xmlfile()->L_TableName->attributes()->val,
        'Group'             => xmlfile()->L_Group->attributes()->val,
        'Max Player'        => xmlfile()->L_MaxPlayer->attributes()->val,
        'Small Blind'       => xmlfile()->L_SmallBlind->attributes()->val,
        'Big Blind'         => xmlfile()->L_BigBlind->attributes()->val,
        'Jackpot'           => xmlfile()->L_Jackpot->attributes()->val,
        'Min Buy'           => xmlfile()->L_MinBuy->attributes()->val,
        'Max Buy'           => xmlfile()->L_MaxBuy->attributes()->val,
        'Timer'             => xmlfile()->L_Timer->attributes()->val,
        'Action'            => xmlfile()->L_Action->attributes()->val,
        'Create Table'      => xmlfile()->L_CreateTable->attributes()->val,
        'Select Category'   => xmlfile()->L_SelectCategory->attributes()->val,
        'Save'              => xmlfile()->L_Save->attributes()->val,
        'Cancel'            => xmlfile()->L_Cancel->attributes()->val,
        'Delete Data'       => xmlfile()->L_DeleteData->attributes()->val,
        'Are you sure'      => xmlfile()->L_AreUsure->attributes()->val,
        'Yes'               => xmlfile()->L_Yes->attributes()->val,
        'No'                => xmlfile()->L_No->attributes()->val,
        'Category'          => xmlfile()->L_Category->attributes()->val,
        'Asta Poker Table'  => xmlfile()->L_AstaPokerTable->attributes()->val,
        'Title'             => xmlfile()->L_Title->attributes()->val,
        'Create Category'   => xmlfile()->L_CreateCategory->attributes()->val,
        'Asta Big Two Table'=> xmlfile()->L_AstaBig2Table->attributes()->val,
        'Create New Table'  => xmlfile()->L_CreateNewTable->attributes()->val,
        'Turn'              => xmlfile()->L_TURN->attributes()->val,
        'Total Bet'         => xmlfile()->L_TotalBet->attributes()->val,
        'Stake'             => xmlfile()->L_Stake->attributes()->val,
        'Timer'             => xmlfile()->L_Timer->attributes()->val,
        'Game state'        => xmlfile()->L_GameState->attributes()->val,
        'Current turn seat ID'  => xmlfile()->L_CurrentTurnSeatId->attributes()->val,
        'Room Name'         => xmlfile()->L_RoomName->attributes()->val,
        'Name'              => xmlfile()->L_Name->attributes()->val,

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuToko($menu){

    $array_menuContent = [

        'Best Offer'        =>  xmlfile()->L_BESTOFFER->attributes()->val,
        'Store'             =>  xmlfile()->L_STORE->attributes()->val,
        'Image'             =>  xmlfile()->L_IMAGE->attributes()->val,
        'Title'             =>  xmlfile()->L_TITLE->attributes()->val,
        'Rate'              =>  xmlfile()->L_RATE->attributes()->val,
        'Category'          =>  xmlfile()->L_CATEGORY->attributes()->val,
        'Price cash'        =>  xmlfile()->L_PRICECASH->attributes()->val,
        'As long'           =>  xmlfile()->L_ASLONG->attributes()->val,
        'Pay Transaction'   =>  xmlfile()->L_PAYTRANSACTION->attributes()->val,
        'Action'            =>  xmlfile()->L_ACTION->attributes()->val,
        'Create best offer' =>  xmlfile()->L_CREATEBEST->attributes()->val,
        'Day'               =>  xmlfile()->L_DAY->attributes()->val,
        'Payment method'    =>  xmlfile()->L_PAYMENTMETHOD->attributes()->val,
        'Transaction type'  =>  xmlfile()->L_TRANSACTIONTYPE->attributes()->val,
        'Bank Transfer'     =>  xmlfile()->L_BANKTRANSFER->attributes()->val,
        'Internet Banking'  =>  xmlfile()->L_INTERNETBANKING->attributes()->val,
        'Cash Digital'      =>  xmlfile()->L_CASHDIGITAL->attributes()->val,
        'Manual transfer'   =>  xmlfile()->L_MANUALTF->attributes()->val,
        'Shop'              =>  xmlfile()->L_SHOP->attributes()->val,
        'Credit card'       =>  xmlfile()->L_CC->attributes()->val,
        'Store'             =>  xmlfile()->L_STORE->attributes()->val,
        'Chip store'        =>  xmlfile()->L_CHIPSTORE->attributes()->val,
        'Goods Store'       =>  xmlfile()->L_GOODS->attributes()->val,
        'Report store'      =>  xmlfile()->L_REPORTSTORE->attributes()->val,
        'Payment Store'     =>  xmlfile()->L_PAYMENTSTORE->attributes()->val,
        'Create new chip store'=> xmlfile()->L_CREATENEWCHIP->attributes()->val,
        'Create new goods store'=> xmlfile()->L_CREATENEWGOODS->attributes()->val,
        'Create new payment store'=> xmlfile()->L_CREATENEWPAYMENT->attributes()->val,
        'Order'             =>  xmlfile()->L_ORDER->attributes()->val,
        'Chip Awarded'      =>  xmlfile()->L_CHIPAWARDED->attributes()->val,
        'Gold Awarded'      =>  xmlfile()->L_GOLDAWARDED->attributes()->val,
        'Gold Cost'         =>  xmlfile()->L_GOLDCOST->attributes()->val,
        'Active'            =>  xmlfile()->L_ACTIVE->attributes()->val,
        'Main Image'        =>  xmlfile()->L_MAINIMAGE->attributes()->val,
        'Save Image'        =>  xmlfile()->L_SAVEIMAGE->attributes()->val,
        'Edit'              =>  xmlfile()->L_EDIT->attributes()->val,
        'Create new gold store' =>  xmlfile()->L_CREATENEW->attributes()->val,
        'Item type'         =>  xmlfile()->L_ITEMTYPE->attributes()->val,
        'Pay Transaction'   =>  xmlfile()->L_PAY->attributes()->val,
        'Price Point'       =>  xmlfile()->L_PRICEPOINT->attributes()->val,
        'Choose type date'  =>  xmlfile()->L_CHOOSETYPEDATE->attributes()->val,
        'Date approve and Decline' => xmlfile()->L_DATEAPPROVE->attributes()->val,
        'Date Request'      =>  xmlfile()->L_DATEREQUEST->attributes()->val,
        'Item awarded'      =>  xmlfile()->L_ITEMAWARDED->attributes()->val,

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuFeedback($menu){

    $array_menuContent = [

        'Feedback'                  =>  xmlfile()->L_FEEDBACK->attributes()->val,
        'Abuse Transaction Report'  =>  xmlfile()->L_ABUSETRANS->attributes()->val,
        'Report Abuse Player'       =>  xmlfile()->L_ABUSEPLAYER->attributes()->val,
        'Image Proof'               =>  xmlfile()->L_IMAGEPROOF->attributes()->val,
        'Rating'                    =>  xmlfile()->L_RATING->attributes()->val,
        'Message'                   =>  xmlfile()->L_MESSAGE->attributes()->val,
        'User ID sender'            =>  xmlfile()->L_IDSENDER->attributes()->val,
        'Username sender'           =>  xmlfile()->L_USERSENDER->attributes()->val,
        'Reported User ID'          =>  xmlfile()->L_REPORTUSERID->attributes()->val,
        'Reported User'             =>  xmlfile()->L_REPORTUSER->attributes()->val,
        'Reason'                    =>  xmlfile()->L_REASON->attributes()->val,


    
    ];
    return $array_menuContent[$menu];
}

function TranslateGeneralSettings($menu){

    $array_menuContent = [

        'System settings'           =>  xmlfile()->L_SYSTEMSETT->attributes()->val,
        'Maintenance'               =>  xmlfile()->L_MAINTENANCE->attributes()->val,
        'Point expired'             =>  xmlfile()->L_POINTEXP->attributes()->val,
        'Award Signup'              =>  xmlfile()->L_AWARDSIGN->attributes()->val,
        'Award Signup Guest'        =>  xmlfile()->L_AWARDSIGNGUEST->attributes()->val,
        'Award Daily Chips'         =>  xmlfile()->L_AWARDDAILYCHIPS->attributes()->val,
        'Award Daily Chips Guest'   =>  xmlfile()->L_AWARDDAILYCHIPSGUEST->attributes()->val,
        'Award Daily Days'          =>  xmlfile()->L_AWARDDAILYDAYS->attributes()->val,
        'Award Daily Multiply'      =>  xmlfile()->L_AWARDDAILYMULTIPLY->attributes()->val,
        'Bank Settings'             =>  xmlfile()->L_BANKSETTINGS->attributes()->val,
        'Info Settings'             =>  xmlfile()->L_INFOSETTINGS->attributes()->val,
        'About'                     =>  xmlfile()->L_ABOUT->attributes()->val,
        'Edit About'                =>  xmlfile()->L_EDIT->attributes()->val,
        'CS & Legal Settings'       =>  xmlfile()->L_LEGALSETTING->attributes()->val,
        'Edit privacy & policy'     =>  xmlfile()->L_PRIVACY->attributes()->val,
        'Edit Term of Service'      =>  xmlfile()->L_EDITTERM->attributes()->val,


    ];
    return $array_menuContent[$menu];
}

function TranslateReseller($menu){

    $array_menuContent = [

        'Reseller ID'           =>  xmlfile()->L_RESELLERID->attributes()->val,
        'Phone'                 =>  xmlfile()->L_PHONE->attributes()->val,
        'Saldo gold'            =>  xmlfile()->L_SALDOGOLD->attributes()->val,
        'Report Transaction'    =>  xmlfile()->L_REPORTTRANS->attributes()->val,
        'Bonus Item'            =>  xmlfile()->L_BONUSITEM->attributes()->val,
        'Balance'               =>  xmlfile()->L_BALANCE->attributes()->val,
        'Gold Group'            =>  xmlfile()->L_GOLDGROUP->attributes()->val,
        'Create Reseller Rank'  =>  xmlfile()->L_CREATERESELLRANK->attributes()->val,
        'Password'              =>  xmlfile()->L_PASSWORD->attributes()->val,
        'Identity Card'         =>  xmlfile()->L_IDENTITYCARD->attributes()->val,
        'Access denied'         =>  xmlfile()->L_DENIED->attributes()->val,
        'You cant access'       =>  xmlfile()->L_UCANT->attributes()->val,
        'Create new asset'      =>  xmlfile()->L_NEWASSET->attributes()->val,
        'Link'                  =>  xmlfile()->L_LINK->attributes()->val,
        'Version'               =>  xmlfile()->L_VERSION->attributes()->val,
        'Edit Asset'            =>  xmlfile()->L_EDITASSET->attributes()->val,
        'Choose a file'         =>  xmlfile()->L_CHOOSEFILE->attributes()->val,
        


    ];
    return $array_menuContent[$menu];
}


?>