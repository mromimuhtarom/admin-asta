<?php

function randomcode($length, $type = 'mixed')
{
  if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false; $rand_value = '';
  while (strlen($rand_value) < $length)
  {
    if ($type == 'digits') {
      $char = find_rand(0,9);
    } else {
      $char = chr(find_rand(0,255));
    } if ($type == 'mixed') {
          if (preg_match('/^[a-z0-9]$/', $char)) $rand_value .= $char;
      } elseif ($type == 'chars') {
          if (preg_match('/^[a-z]$/', $char)) $rand_value .= $char;
      } elseif ($type == 'digits') {
          if (preg_match('/^[0-9]$/', $char)) $rand_value .= $char;
      }
   } return $rand_value;
  }

function clean($string)
{
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function find_rand($min = null, $max = null)
{ static $seeded;
  if (!isset($seeded)) {
    mt_srand((double)microtime()*1000000); $seeded = true;
  }

  if (isset($min) && isset($max)) {
     if ($min >= $max) {
       return $min;
     } else {
       return mt_rand($min, $max);
     }
  } else {
   return mt_rand();
  }
}
