<?php

date_default_timezone_set('Australia/Sydney');

//
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

	//var_dump($diff);

    $w = floor($diff->d / 7);
    $diff->d -= $w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',

        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


//kondisi disabled dan enabled (view emoticon, tablegift, slidebanner, stores .blade)
function strEnabledDisabled ($val) {
  $config      = DB::table('config_text')->where('id', '=', 4)->first();
  $value       = str_replace(':', ',', $config->value);
  $statusendis = explode(",", $value);

	if($val == $statusendis[0] ) {
		return $statusendis[1];
	} else {
		return $statusendis[3];
	}
}

//kondisi select type item bonus(chip store, gold store)
function strItemBonType($val) {
  $config   = DB::table('config_text')->where('id', '=', 5)->first();
  $value    = str_replace(':', ',', $config->value);
  $itemtype = explode(",", $value);

  if($val == $itemtype[0]) {
    return $itemtype[1];
  } else if($val == $itemtype[2]){
    return $itemtype[3];
  } else {
    return $itemtype[5];
  }
}

//kondisi transactionType mingguan dan bulanan (view reseller_rank.blade) 
function strTransactionType ($val) {
  $config           = DB::table('config_text')->where('id', '=', 10)->first();
  $value            = str_replace(':', ',', $config->value);
  $resellerranktype = explode(",", $value);
  if($val == $resellerranktype[0]) {
    return $resellerranktype[1];
  } else if($val == $resellerranktype[2]) {
    return $resellerranktype[3];
  }
}


//kondisi On atau Of maintenance (general_setting.blade.php)
function strMaintenanceOnOff($val) {
  $config            = DB::table('config_text')->where('id', '=', 9)->first();
  $value             = str_replace(':', ',', $config->value);
  $maintenancestatus = explode(",", $value);
  if($val == $maintenancestatus[0]) {
    return $maintenancestatus[1];
  } else if($val == $maintenancestatus[2]) {
    return $maintenancestatus[3];
  }
}

//kondisi status pending, approve, decline (view report_store.blade)
function strStatusApdec($val) {
  if($val == 0)
  {
    return 'Pending';
  } else if($val == 1)
  {
    return 'Approve';
  } else if($val == 2)
  {
    return 'Decline';
  }
}

//
function strYesNo ($val) {
	if($val == 0) {
		return 'No';
	} else {
		return 'Yes';
	}
}

//
function strIcon ($val) {
	if($val == 1) {
		return 'fa-home';
	} else if($val == 2) {
		return 'fa-gamepad';
	} else if($val == 3) {
    return '';
  }
}

function decryptaes256($email) {
  $key = "------------ASTA-KEY------------";
  $iv = "-----ASTAIV-----";
  $method = "aes-256-cbc";
  $enStr = $email;
  $emailDecrypt = openssl_decrypt(hexToStr($enStr), $method, $key, $options = OPENSSL_RAW_DATA, $iv);
  return $emailDecrypt;
}

//pengulangan pada form (view register_reseller.php)
function generateID($digits = 4){
  $i = 0;
  $pin = "";
  while($i < $digits){

      $pin .= mt_rand(0, 9);
      $i++;
  }
  return $pin;
}

//
function rewardStatus($val){
  if($val == 0){
    return 'Request';
  }else if($val == 1){
    return 'Decline';
  }else if($val == 2){
    return 'Approved';
  }else if($val == 3){
    return 'Send';
  }else{
    return 'Complete';
  }
}

//kondisi tyoe player (view register_player.blade.php)
function strPlayerType($val){
  if($val == 1){
    return 'Players';
  } else if($val == 2){
    return 'Guest';
  }
}

//format mata uang (view report_store.blade.php)
function strFormatMoney($val){
  $formatrupiah = "Rp" . number_format($val,2,',','.');
  return $formatrupiah;
}




//Menu type (view role_edit.blade.php)
function strMenuType ($val) {
    $config            = DB::table('config_text')->where('id', '=', 6)->first();
    $value             = str_replace(':', ',', $config->value);
    $rolestatus        = explode(",", $value);
    if($val == $rolestatus[0]) {
      return $rolestatus[1];
    } else if($val == $rolestatus[2]) {
      return $rolestatus[3];
    } else if($val == $rolestatus[4]) {
      return $rolestatus[5];
    }
  
    // if($val == 0) {
    //     return 'The Menu Can\'t be Accessed and can\'t be edited';
    // } else if ($val == 1) {
    //     return 'The Menu Can be Accessed and can\'t be edited';
    // } else if ($val == 2) {
    //     return 'The Menu Can be Accessed and edited';
    // }
}

//
function transactionStatus($val){
  if($val == 'settlement' || $val == 'capture'){
    return 2;
  }else if($val == 'pending'){
    return 1;
  }else{
    return 0;
  }
}

//kondisi Type transfer (view item_store_reseller, gold_store, goods_store, payment_store.blade.php)
function strTypeTransaction($val){
  if($val == 1) {
    return 'Bank Transfer';
  } else if ($val == 2) {
    return 'Internet Banking';
  } else if ($val == 3) {
    return 'E-money';
  } else if ($val == 4) {
    return 'Toko';
  } else if ($val == 5) {
    return 'Akulaku';
  } else if ($val == 6) {
    return 'Credit Card';
  } else if($val == 7) {
    return 'Manual Transfer';
  } else if($val == 8) {
    return 'Google Play';
  }
}



//
function bankTransactionStatus($val){
  if($val == 1){
    return "pending";
  }else{
    return "";
  }
}

//
function strtohex($x)
{
    $s='';
    foreach (str_split($x) as $c) $s.=sprintf("%02X", ord($c));
    return($s);
}


function strNormalFast ($val) {
	if($val == 7) {
		return 'Fast';
	} else if($val == 15) {
		return 'Normal';
	} else {
    return $val;
  }
}

//email decrypt (view register_player_profile.php)
function hexToStr($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }



//convert type data image boolean to string (Gift controller, emoticon ccntroller, menu store)
function image_data($gdimage)
{
    ob_start();
    imagepng($gdimage);
    return(ob_get_clean());
}

function tpkplayeronline($table_id)
{
  $a = DB::table('tpk_player')->where('table_id', '=', $table_id)->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_player.user_id')->get();
  return $a;
}

function bgtplayeronline($table_id)
{
  $a = DB::table('bgt_player')->where('table_id', '=', $table_id)->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.bgt_player.user_id')->get();
  return $a;
}

function dmqplayeronline($table_id)
{
  $a = DB::table('dmq_player')->where('table_id', '=', $table_id)->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dmq_player.user_id')->get();

  return $a;
}

function dmsplayeronline($table_id)
{
  $a = DB::table('dms_player')->where('table_id', '=', $table_id)->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dms_player.user_id')->get();

  return $a;
}

function iconsorting($fieldname)
{
  if(isset($_GET['namecolumn'])):
    if($_GET['namecolumn'] === $fieldname):
      if($_GET['sorting'] === 'asc'):
        $icon = '-asc';
      else:
        $icon = '-desc';
      endif;
    else:
      $icon = '';
    endif;
  else:
    $icon = '';
  endif;

  return $icon;
}

function tpkcard($array) {
  
  if(!empty($array)):
    $arraycard = explode(',', $array);
    $cards = ['','2D','3D','4D','5D','6D','7D','8D','9D','10D','JD','QD','KD','AD', //13
    '2C','3C','4C','5C','6C','7C','8C','9C','10C','JC','QC','KC','AC',         //26
    '2H','3H','4H','5H','6H','7H','8H','9H','10H','JH','QH','KH','AH',         //39
    '2S','3S','4S','5S','6S','7S','8S','9S','10S','JS','QS','KS','AS'];

    for ($i = 0; $i < count($arraycard); $i++){
      // resCard[i]=cards[array[i]];
      // $resCard.push($cards[$arraycard[$i]]);
      $resCard[] = $cards[$arraycard[$i]];
      
    }
  else:
    $resCard = '';
  endif;
    
  return $resCard;

}

function cardreadpopup($array) {
  
  $a = json_encode($array);
  $b = str_replace("[", "", $a);
  $c = str_replace("]", "", $b);
  $d = str_replace('"', " ", $c);

  return $d;

}


function bgtcard($array) {
  if($array !== ''):
    if(!empty($array)):
      $cards = ['FD','3D','4D','5D','6D','7D','8D','9D','10D','JD','QD','KD','AD','2D', //13
               '3C','4C','5C','6C','7C','8C','9C','10C','JC','QC','KC','AC','2C',         //26
               '3H','4H','5H','6H','7H','8H','9H','10H','JH','QH','KH','AH','2H',        //39
               '3S','4S','5S','6S','7S','8S','9S','10S','JS','QS','KS','AS','2S'];
      
      for ($i = 0; $i < count($array); $i++){
        
        // resCard[i]=cards[array[i]];
        // $resCard.push($cards[$arraycard[$i]]);
        $resCard[] = $cards[$array[$i]];
        
      }
    else:
      $resCard = '';
    endif;
  else:
    $resCard[]= '';
  endif;

  return $resCard;

}

function actiongameplaylog($action)
{
  if($action == 1):
    return 'L_BET_CALL';
  elseif($action == 2):
    return 'L_CHECK';
  elseif($action == 3):
    return 'L_RAISE';
  elseif($action == 4):
    return 'L_FOLD';
  elseif($action == 5):
    return 'L_PLAY';
  elseif($action == 6):
    return 'L_PASS';
  elseif($action == 7):
    return 'L_BIG_BLIND';
  elseif($action == 8):
    return 'L_SMALL_BLIND';
  endif;

}

function statusgameplaylog($status)
{
  if($status == 0):
    return 'L_LOSE';
  elseif($status == 1):
    return 'L_WIN';
  elseif($status == 2):
    return 'L_DRAW';
  endif;
}


function dmscard($array) {
  if($array !== '[]'):
    $arraycard = json_decode($array);
    $cards = [
     "0_0", "1_0", "2_0", "3_0", "4_0", "5_0", "6_0",  //0
     "1_1", "1_2", "1_3", "1_4", "1_5", "1_6",         //7
     "2_2", "2_3", "2_4", "2_5", "2_6",                //13
     "3_3", "3_4", "3_5", "3_6",                       //18
     "4_4", "4_5", "4_6",                              //22
     "5_5", "5_6",                                     //25
     "6_6"                                             //27
    ];
    for ($i = 0; $i < count($arraycard); $i++){
      // resCard[i]=cards[array[i]];
      // $resCard.push($cards[$arraycard[$i]]);
      $resCard[] = $cards[$arraycard[$i]];
    }
  else:
    $resCard[]= '';
  endif;

  return $resCard;

}
function dmscardnobrackets($array) {
  if($array !== '[]'):
    $arraycard = explode(',', $array);
    $cards = [
     "0_0", "1_0", "2_0", "3_0", "4_0", "5_0", "6_0",  //0
     "1_1", "1_2", "1_3", "1_4", "1_5", "1_6",         //7
     "2_2", "2_3", "2_4", "2_5", "2_6",                //13
     "3_3", "3_4", "3_5", "3_6",                       //18
     "4_4", "4_5", "4_6",                              //22
     "5_5", "5_6",                                     //25
     "6_6"                                             //27
    ];
    for ($i = 0; $i < count($arraycard); $i++){
      // resCard[i]=cards[array[i]];
      // $resCard.push($cards[$arraycard[$i]]);
      $resCard[] = $cards[$arraycard[$i]];
    }
  else:
    $resCard[]= '';
  endif;
  
  return $resCard;

}

function tagsEnabler($txt)
{ 
  $semanticTagleft    =   str_replace('<', '[', $txt);
  $semanticTagright   =   str_replace('>', ']', $semanticTagleft);
  $semanticTagclosel  =   str_replace('</', '[/', $semanticTagright);
  $semanticTagcloser  =   str_replace('>', ']', $semanticTagclosel); 
  
  return $semanticTagcloser;
}

function status_player($val) {
  if($val == 25){
    return "Setuju";
  }else if($val == 26){
    return "Dilarang";
  } else if($val == 27) {
    return "Bermasalah";
  }
}

function statusRegisteredPlayers($val) {
  if($val == 1){
    return "Setuju";
  }else if($val == 2){
    return "Dilarang";
  }else if($val == 3){
    return "Bermasalah";
  }
}



?>
