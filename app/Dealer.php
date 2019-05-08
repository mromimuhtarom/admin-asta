<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeZone;
use DateTime;

class Dealer extends Model
{
  protected $table = 'dealers';


  public function get_timezones() {
		$o = [];

		$t_zones = timezone_identifiers_list();

		foreach($t_zones as $a)
		{
			$t = '';

			try
			{
				//this throws exception for 'US/Pacific-New'
				$zone = new DateTimeZone($a);

				$seconds = $zone->getOffset( new DateTime("now" , $zone) );
				$hours = sprintf( "%+02d" , intval($seconds/3600));
				$minutes = sprintf( "%02d" , ($seconds%3600)/60 );

				$t = $a ."  [ $hours:$minutes ]" ;

				$o[$a] = $t;
			}

			//exceptions must be catched, else a blank page
			catch(Exception $e)
			{
				// die("Exception : " . $e->getMessage() . '<br />');
				// what to do in catch ? , nothing just relax
			}
		}

		ksort($o);

		return $o;
	}

  public function tables(){
    return $this->hasMany(Table::class);
  }

  public function tournament()
  {
    return $this->hasMany(Tournament::class);
  }

  public function bank()
  {
    return $this->hasMany(Bank::class);
  }
}
