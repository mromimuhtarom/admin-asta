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
	if($val == 0) {
		return 'Disabled';
	} else {
		return 'Enabled';
	}
}

//kondisi select type item bonus(chip store, gold store)
function strItemBonType($val) {
  if($val == 1) {
    return 'Chip';
  } else if($val == 2){
    return 'Gold';
  } else {
    return 'Good';
  }
}

//kondisi transactionType mingguan dan bulanan (view reseller_rank.blade) 
function strTransactionType ($val) {
  if($val == 1) {
    return 'Monthly';
  } else if($val == 2) {
    return 'Weekly';
  }
}


//kondisi On atau Of maintenance (general_setting.blade.php)
function strMaintenanceOnOff($val) {
  if($val == 1) {
    return 'On';
  } else if($val == 0) {
    return 'Off';
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
    if($val == 0) {
        return 'The Menu Can\'t be Accessed and can\'t be edited';
    } else if ($val == 1) {
        return 'The Menu Can be Accessed and can\'t be edited';
    } else if ($val == 2) {
        return 'The Menu Can be Accessed and edited';
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
    return 'Cash Digital';
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
  if($array !== '-'):
    if(!empty($array)):
      $arraycard = explode(',', $array);
      $cards = ['FD','3D','4D','5D','6D','7D','8D','9D','10D','JD','QD','KD','AD','2D', //13
               '3C','4C','5C','6C','7C','8C','9C','10C','JC','QC','KC','AC','2C',         //26
               '3H','4H','5H','6H','7H','8H','9H','10H','JH','QH','KH','AH','2H',        //39
               '3S','4S','5S','6S','7S','8S','9S','10S','JS','QS','KS','AS','2S'];
      
      for ($i = 0; $i < count($arraycard); $i++){
        
        // resCard[i]=cards[array[i]];
        // $resCard.push($cards[$arraycard[$i]]);
        $resCard[] = $cards[$arraycard[$i]];
        
      }
    else:
      $resCard = '';
    endif;
  else:
    $resCard[]= '';
  endif;

  return $resCard;

}


function dmscard($array) {
  if($array !== '-'):
    $arraycard = explode(',', $array);
    $cards = [
      [0, 0],[0, 1],[0, 2],[0, 3],[0, 4],[0, 5],[0, 6],[1, 1],[1, 2],[1, 3],
      [1, 4],[1, 5],[1, 6],[2, 2],[2, 3],[2, 4],[2, 5],[2, 6],[3, 3],[3, 4],
      [3, 5],[3, 6],[4, 4],[4, 5],[4, 6],[5, 5],[5, 6],[6, 6]
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



?>
