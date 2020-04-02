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
    return 'Merchant';
  } else if ($val == 5) {
    return 'Credit Card';
  } else if ($val == 6) {
    return 'Manual Transfer';
  } else if($val == 7) {
    return 'Google Play';
  }
}




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
    $cards = ['','2D','3D','4D','5D','6D','7D','8D','9D','10D','JD','QD','KD','AD', //13
    '2C','3C','4C','5C','6C','7C','8C','9C','10C','JC','QC','KC','AC',         //26
    '2H','3H','4H','5H','6H','7H','8H','9H','10H','JH','QH','KH','AH',         //39
    '2S','3S','4S','5S','6S','7S','8S','9S','10S','JS','QS','KS','AS'];

    for ($i = 0; $i < count($array); $i++){
      $resCard[] = $cards[$array[$i]];
      
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
  elseif($action == 9):
    return 'L_DIVIDED_CARD';
  elseif($action == 10):
    return 'L_ALL_IN';
  endif;

}


function typeCardGamepLayLogBgtTpk($typecard)
{
  if($typecard === NULL):
    return '';
  elseif($typecard == 0):
    return 'L_HIGH_CARD';
  elseif($typecard == 1):
    return 'L_PAIR';
  elseif($typecard == 2):
    return 'L_2_PAIR';
  elseif($typecard == 3):
    return 'L_3_KIND';
  elseif($typecard == 4):
    return 'L_4_KIND';
  elseif($typecard == 5):
    return 'L_FULL_HOUSE';
  elseif($typecard == 6):
    return 'L_STRAIGHT';
  elseif($typecard == 7):
    return 'L_FLUSH';
  elseif($typecard == 8):
    return 'L_STRAIGHT_FLUSH';
  elseif($typecard == 9):
    return 'L_ROYAL_FLUSH';
  endif;
}

function typecarddms($type)
{
  if($type === 1):
    return 'L_SINGLE';
  elseif($type === 2):
    return 'L_DOUBLE';
  elseif($type === 3):
    return 'L_TRIPLE';
  elseif($type === 4):
    return 'L_QUARTET';
  elseif($type === 5):
    return 'L_QUINTET';
  endif;
}

function typecarddmq($type)
{
  if($type === 0):
    return 'L_NORMAL';
  elseif($type === 1):
    return 'L_DOUBLE_CARD';
  elseif($type === 2):
    return 'L_BIG_CARD';
  elseif($type === 3):
    return 'L_SMALL_CARD';
  elseif($type === 4):
    return 'L_TWIN_CARD';
  elseif($type === 5):
    return 'L_SIX_DEVIL';
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
  elseif($status == 3):
    return 'L_WIN_JACKPOT';
  endif;
}


function dmscard($array) {
  if(!empty($array) || $array === ''):
    $cards = [
     "0_0", "1_0", "2_0", "3_0", "4_0", "5_0", "6_0",  //0
     "1_1", "1_2", "1_3", "1_4", "1_5", "1_6",         //7
     "2_2", "2_3", "2_4", "2_5", "2_6",                //13
     "3_3", "3_4", "3_5", "3_6",                       //18
     "4_4", "4_5", "4_6",                              //22
     "5_5", "5_6",                                     //25
     "6_6"                                             //27
    ];
    for ($i = 0; $i < count($array); $i++){
      $resCard[] = $cards[$array[$i]];
    }
  else:
    $resCard[]= '';
  endif;

  return $resCard;

}

function dmscardcombo($array) {
  if(!empty($array)):
    $cards = [
     [0, 0], [1, 0], [2, 0], [3, 0], [4, 0], [5, 0], [6, 0],  //0
     [1, 1], [1, 2], [1, 3], [1, 4], [1, 5], [1, 6],         //7
     [2, 2], [2, 3], [2, 4], [2, 5], [2, 6],                //13
     [3, 3], [3, 4], [3, 5], [3, 6],                       //18
     [4, 4], [4, 5], [4, 6],                              //22
     [5, 5], [5, 6],                                     //25
     [6, 6]                                             //27
    ];
    if(is_array($array)):
      for ($i = 0; $i < count($array); $i++){
        $resCard[] = $cards[$array[$i]];
      }
    else:
      $resCard[]= '';
    endif;
  else:
    $resCard[]= '';
  endif;

  return $resCard;

}

function totalvaluecard($array)
{
  if(!empty($array)):
    if(is_array($array)):
      for($a=0; $a < count($array); $a++):
        $total[] = array_sum(dmscardcombo($array)[$a]);
      endfor;
      $total = array_sum($total);
    else:
      for($a=0; $a < count(explode(',', $array)); $a++):
        $total[] = array_sum(dmscardcombo(explode(',', $array))[$a]);
      endfor;
      $total = array_sum($total);
    endif;
  else:
    $total = 0;
  endif;
  return $total;
}

function HandTotal($hand)
{
  if(!empty($hand)):
    if(count($hand) == 4):
      for($a=0; $a<count($hand); $a++ ):
          $card[] = array_sum(dmscardcombo($hand)[$a]);
      endfor;
      
      $total = array_sum($card); 
    else:
      for($a=0; $a<count($hand); $a++ ):
        for($y=0; $y<2; $y++):
          $total = dmscardcombo($hand);
        endfor;
      endfor;
    endif;
    $return = $total;
  else:
  endif;
  
}

function comboconvert($handcard)
{
  $maxVal = -1;
  $maxValIndex = [];

  for($x=0; $x < count($handcard) - 1; $x++):
    for($y= $x + 1; $y < count($handcard); $y++):
        if((array_sum(dmscardcombo($handcard)[$x]) + array_sum(dmscardcombo($handcard)[$y])) % 10 > $maxVal):
            $maxVal      = (array_sum(dmscardcombo($handcard)[$x])  + array_sum(dmscardcombo($handcard)[$y])) % 10;
            $maxValIndex = [$x, $y];
        endif;
    endfor;
  endfor;



  $handValue = [$maxVal, 0];
  for($x = 0; $x < count(dmscardcombo($handcard)); $x++):
    if($x !== $maxValIndex[0] && $x !== $maxValIndex[1]):
        $handValue[1] += array_sum(dmscardcombo($handcard)[$x]);
        $handValue[1] = $handValue[1] % 10;
    endif;
  endfor;
  $statusdevil  = false;
  $statustwincard = false;
  
  for($a=0; $a < count($handcard); $a++):
    // var_dump(dmscardcombo(explode(',', $handcard))[$a]);
    $total[] = array_sum(dmscardcombo($handcard)[$a]);
    for($b=0; $b<2; $b++):
      // if(dmscardcombo(explode(',', $handcard))[$a][0] == dmscardcombo(explode(',', $handcard))[$a][1]):
      if(in_array('false', dmscardcombo($handcard)[$a], true)):
        $statustwincard = true;
        $cardtwin[] = dmscardcombo($handcard)[$a];
      endif;

    endfor; 
    // if(dmscardcombo(explode(',', $handcard))[$a][0] == dmscardcombo(explode(',', $handcard))[$a][1]):
    //   $statustwincard = true;
    // endif;
    // var_dump($total);
  endfor;
  $arraysixdevil = array(6,6,6,6);
  $statussixdevil = array_diff($total,$arraysixdevil);

  $twin = false;
  if($statustwincard === true):
    if(count($cardtwin) === 4):
      $twin = true;
    endif;
  endif;

  if (empty($statussixdevil) && count($handcard) == 4):
    $cardLevel = Translate_menuPlayers('L_SIX_DEVIL');
  elseif($twin == true && count($handcard) == 4):
    $cardLevel = Translate_menuPlayers('L_TWIN_CARD');
  elseif(!empty(HandTotal($handcard)) && HandTotal($handcard) < 10 && count($handcard) === 4):
    $cardLevel = Translate_menuPlayers('L_SMALL_CARD');
  elseif(count($handcard) == 4 && HandTotal($handcard) > 37 ):
    $cardLevel = Translate_menuPlayers('L_BIG_CARD');
  elseif(empty(array_diff($handValue,[9,9]))):
    $cardLevel = Translate_menuPlayers('L_DOUBLE_CARD');
  else:
    $cardLevel = str_replace(',', ':', (implode(',', $handValue)));
  endif;


  return $cardLevel;
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
