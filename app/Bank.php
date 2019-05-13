<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';

    public $timestamps = false;
  
    protected $fillable = ['autoWithdrawLimit','minWithdrawLimit','minDepositLimit','rakeRate','currencySign','decimalPoints','exchangeRate','useJackpot','signupAward','dailyAwardChips','jackpotFee'];
  
    public function dealer(){
  
      return $this->belongsTo(Dealer::class);
  
    }
  
    public function stores(){
  
      return $this->hasMany(Store::class);
  
    }
  
    public function players(){
  
      return $this->hasMany(Player::class);
    }
  
    public function strFee() {
  
      return ($this->fee * 100).'%';
    }
  
    public function feeMultiply() {
  
      return 1 / $this->feeMultiplier;
    }
  
    public function money($amount) {
      return number_format($amount, $this->decimalPoints);
    }
  
    public function inBitcoin($amount) {
      return number_format(($amount/ $this->chipToBitcoinRatio), 4);
    }
}
