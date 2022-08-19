<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Plan extends Model
{
    use GetName;
    protected $fillable = [
        'name','name_ar','des','des_ar',
        'price','fee','min_fee','max_fee',
        'product_priority','product_limit','trans_limit','deleted_counter','photo_limit','variations','badge',
        'staff_accounts','can_see_views','analytics','order'
    ];

    public function getdes(){
      return app()->getLocale()=='ar'?$this->des_ar:$this->des;
    }

    public function getprice(){
      if(function_exists('getcurrency') && !empty(getcurrency()) && !empty($this->price)){
        $price=number_format($this->price*getcurrency()->value,2);
        return $price.' '.getcurrency()->getabbreviation();
      }
    }
    public function getminfee(){
      if(function_exists('getcurrency') && !empty(getcurrency()) && !empty($this->min_fee)){
        $min_fee=number_format($this->min_fee*getcurrency()->value,2);
        return $min_fee.' '.getcurrency()->getabbreviation();
      }
    }
    public function getmaxfee(){
      if(function_exists('getcurrency') && !empty(getcurrency()) && !empty($this->max_fee)){
        $max_fee=number_format($this->max_fee*getcurrency()->value,2);
        return $max_fee.' '.getcurrency()->getabbreviation();
      }
    }

    public function subscriptions(){
      return $this->hasMany(Subscription::class,'plan_id');
    }
}
