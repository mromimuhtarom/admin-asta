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
        'Status Payment'        =>  xmlfile()->L_StatusPyament->attributes()->val,
        'Confirm request'       =>  xmlfile()->L_ConfirmPayment->attributes()->val,
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
        'Chip Players'              =>  xmlfile()->L_ChipPlayers->attributes()->val,
        'Gold Players'              =>  xmlfile()->L_GoldPlayers->attributes()->val,   
        'Guest'                     =>  xmlfile()->L_Guest->attributes()->val,
        'Choose Register Type'      =>  xmlfile()->L_ChooseRegisterType->attributes()->val,
        'Choose Game'               =>  xmlfile()->L_ChooseGame->attributes()->val,
        'Choose Log Type'           =>  xmlfile()->L_ChooseLogType->attributes()->val,
        'Choose status'             =>  xmlfile()->L_Choosestatus->attributes()->val,
        'Total Record Entries is'   =>  xmlfile()->L_TotalRecordEntriesIs->attributes()->val,
        'Create user guest ID'      =>  xmlfile()->L_CreateUserGuestID->attributes()->val,
        'Bank Account'              =>  xmlfile()->L_BankAccount->attributes()->val,
        'Country'                   =>  xmlfile()->L_Country->attributes()->val,
        'Player ID'                 =>  xmlfile()->L_PlayerID->attributes()->val,
        'Guest ID'                  =>  xmlfile()->L_GuestID->attributes()->val,
        'Device ID'                 =>  xmlfile()->L_DeviceID->attributes()->val,
        'Round ID'                  =>  xmlfile()->L_RoundID->attributes()->val,
        'Detail round ID'           =>  xmlfile()->L_DetailroundID->attributes()->val,
        'Playername'                =>  xmlfile()->L_Playername->attributes()->val,
        'Game'                      =>  xmlfile()->L_Game->attributes()->val,
        'Username'                  =>  xmlfile()->L_Username->attributes()->val,
        'Playing Game'              =>  xmlfile()->L_PlayingGame->attributes()->val,
        'Rank'                      =>  xmlfile()->L_Rank->attributes()->val,
        'Table'                     =>  xmlfile()->L_Table->attributes()->val,
        'Hand card'                 =>  xmlfile()->L_HandCard->attributes()->val,
        'Seat'                      =>  xmlfile()->L_Seat->attributes()->val,
        'Sit'                       =>  xmlfile()->L_Sit->attributes()->val,
        'Bet'                       =>  xmlfile()->L_Bet->attributes()->val,
        'Win Lose'                  =>  xmlfile()->L_Win->attributes()->val,
        'Chip'                      =>  xmlfile()->L_Chip->attributes()->val,
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


?>