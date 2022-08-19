<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extoption extends Model
{

  protected $fillable=['old_price','price','quantity','image','sales','active','hasoffer','product_id'];

  public function product(){
    return $this->belongsTo(Product::class,'product_id');
  }

  public function options(){
    return $this->belongsToMany(Option::class,'options_extoptions','extoption_id','option_id');
  }

  public function carts(){
    return $this->hasMany(Cart::class,'extoption_id');
  }

  public function getprice(){
    if(function_exists('getcurrency') && !empty(getcurrency()) && !empty($this->price)){
      return $this->price*getcurrency()->value.' '.getcurrency()->getabbreviation();
    }
  }

  public function getdollarprice(){
      $price=number_format($this->price,2);
      return $price.' '.trans('admindash.constants.usd');
  }

}
