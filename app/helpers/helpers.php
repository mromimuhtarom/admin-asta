<?php

date_default_timezone_set('Australia/Sydney');

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

function strEnabledDisabled ($val) {
	if($val == 0) {
		return 'Disabled';
	} else {
		return 'Enabled';
	}
}

function strTransactionType ($val) {
  if($val == 1) {
    return 'Monthly';
  } else if($val == 2) {
    return 'Weekly';
  }
}

function strYesNo ($val) {
	if($val == 0) {
		return 'No';
	} else {
		return 'Yes';
	}
}


function strIcon ($val) {
	if($val == 1) {
		return 'fa-home';
	} else if($val == 2) {
		return 'fa-gamepad';
	} else if($val == 3) {
    return '';
  }
}

function generateID($digits = 4){
  $i = 0;
  $pin = "";
  while($i < $digits){

      $pin .= mt_rand(0, 9);
      $i++;
  }
  return $pin;
}

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

function strMenuType ($val) {
    if($val == 0) {
        return 'The Menu Can\'t be Accessed and can\'t be edited';
    } else if ($val == 1) {
        return 'The Menu Can be Accessed and can\'t be edited';
    } else if ($val == 2) {
        return 'The Menu Can be Accessed and edited';
    }
}

function transactionStatus($val){
  if($val == 'settlement' || $val == 'capture'){
    return 2;
  }else if($val == 'pending'){
    return 1;
  }else{
    return 0;
  }
}

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

function bankTransactionStatus($val){
  if($val == 1){
    return "pending";
  }else{
    return "";
  }
}
?>
