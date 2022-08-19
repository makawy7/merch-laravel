<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Store extends Model
{
    use GetName;
    protected $fillable=['name','name_ar','subscription_id','owner_id','trans_left','trans_limit','address'];

    public function user(){
      return $this->belongsTo(User::class,'owner_id');
    }

    public function subscription(){
      return $this->belongsTo(Subscription::class,'subscription_id');
    }

    public function staff(){
      return $this->hasMany(User::class,'store_id');
    }

    public function products(){
      return $this->hasMany(Product::class,'store_id');
    }

    public function active(){
      $active=$this->subscription->active;
      $paid=$this->subscription->paid;
      $expdate=\Carbon\Carbon::parse($this->subscription->end_date);
      $today= \Carbon\Carbon::now();
      if($active==1 && $paid==1 && $today->diffInDays($expdate, false) >= 0){
        return true;
      }else {
        return false;
      }
    }

}
