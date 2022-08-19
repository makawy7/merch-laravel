<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\GetSlug;
use App\Traits\FindBySlug;

class Product extends Model
{
    use Sluggable,GetSlug,FindBySlug;

    protected $fillable=
    [
      'title','title_ar','slug','slug_ar','des','des_ar','head_des','head_des_ar','old_price','price',
     'quantity','seller_id','type_id','brand_id','image','images',
     'tags','sales','featured','views','active','hasoffer',
     'lowest_price','hightest_price','store_id','main_image','product_priority','reward_points'];

     protected static function boot()
     {
         parent::boot();
         static::deleting(function ($model) {
             $model->variations()->delete();
             $model->extoptions()->delete();
         });
     }

     public function isnew(){
       $createdat=\Carbon\Carbon::parse($this->created_at);
       $today= \Carbon\Carbon::now();
       return $createdat->diffInDays($today, false)>5?false:true;
     }
     public function gettitle(){
       return app()->getLocale()=='ar'?$this->title_ar:$this->title;
     }
     public function getslug(){
       return app()->getLocale()=='ar'?$this->slug_ar:$this->slug;
     }

     public function type(){
       return $this->belongsTo(Type::class,'type_id');
     }

     public function brand(){
       return $this->belongsTo(Brand::class,'brand_id');
     }

     public function variations(){
       return $this->hasMany(Variation::class,'product_id');
     }

     public function extoptions(){
       return $this->hasMany(Extoption::class,'product_id');
     }

     public function carts(){
       return $this->hasMany(Cart::class,'product_id');
     }

     public function getextoptions($ids){

       $idsArray=explode(',',rtrim($ids,","));
       if(count($idsArray)==1){
         foreach($this->extoptions()->get() as $extoption){
           if($extoption->options->contains($idsArray[0])){
             return $extoption;
           }
         }
       }elseif(count($idsArray)==2){
          foreach($this->extoptions()->get() as $extoption){
            if($extoption->options->contains($idsArray[0]) && $extoption->options->contains($idsArray[1])){
              return $extoption;
            }
          }
        }elseif(count($idsArray)==3){
           foreach($this->extoptions()->get() as $extoption){
             if($extoption->options->contains($idsArray[0]) && $extoption->options->contains($idsArray[1]) && $extoption->options->contains($idsArray[2])){
               return $extoption;}
           }
         }
     }

    public function getpricerange(){
      if($this->extoptions){
        $extoption=$this->extoptions->sortBy('price')->first();
        $lowestprice=$extoption['price'];
        $extoption=$this->extoptions->sortByDesc('price')->first();
        $highestprice=$extoption['price'];
        if($lowestprice!=$highestprice){
          $low=number_format($lowestprice*getcurrency()->value,2);
          $high=number_format($highestprice*getcurrency()->value,2);
          return $low.' - '.$high.' '.getcurrency()->getabbreviation();
        }else {
          return $lowestprice;
        }
      }
    }

    public function getdollarpricerange(){
      if($this->extoptions){
        $extoption=$this->extoptions->sortBy('price')->first();
        $lowestprice=$extoption['price'];
        $extoption=$this->extoptions->sortByDesc('price')->first();
        $highestprice=$extoption['price'];
        if($lowestprice!=$highestprice){
          $low=number_format($lowestprice,2);
          $high=number_format($highestprice,2);
          return $low.' - '.$high;
        }else {
          return $lowestprice;
        }
      }
    }

    public function getminprice(){
      if($this->extoptions){
        $extoption=$this->extoptions->sortBy('price')->first();
        $lowestprice=$extoption['price'];
        $lowestprice=number_format($lowestprice,2);
        return $lowestprice;
      }
    }

    public function getmaxprice(){
      if($this->extoptions){
        $extoption=$this->extoptions->sortByDesc('price')->first();
        $highestprice=$extoption['price'];
        $highestprice=number_format($highestprice,2);
        return $highestprice;
      }
    }

    public function getimages(){
      return json_decode($this->images);
    }
    public function getshortdes(){
      return app()->getLocale()=='ar'?json_decode($this->head_des_ar):json_decode($this->head_des);
    }

    public function getdes(){
      return app()->getLocale()=='ar'?json_decode($this->des_ar):json_decode($this->des);
    }

    public function getprice(){
      if(function_exists('getcurrency') && !empty(getcurrency()) && !empty($this->price)){
        $price=number_format($this->price*getcurrency()->value,2);
        return $price.' '.getcurrency()->getabbreviation();
      }
    }

    public function getdollarprice(){
        $price=number_format($this->price,2);
        return $price.' '.trans('admindash.constants.usd');
    }

    public function comments(){
      return $this->hasMany(Comment::class,'product_id');
    }

    public function getratings(){
      $avg=0;
      $ratings=Rating::where('product_id',$this->id)->get();
      if(count($ratings)>0){
        foreach($ratings as $rating){
          $avg+=$rating->score;
        }
        $avg=$avg/count($ratings);
      }
      return round($avg);
    }

    public function likedusers(){
      return $this->belongsToMany(User::class,'user_likes','product_id','user_id');
    }

    public function watchedusers(){
      return $this->belongsToMany(User::class,'user_watches','product_id','user_id');
    }

    public function store(){
      return $this->belongsTo(Store::class,'store_id');
    }

    public function isadminstore(){
      if($this->store_id==0){
        return true;
      }else {
        return false;
      }
    }
    public function totalquantity(){
      $qunatity=0;
      foreach($this->extoptions as $extoption){
        $qunatity+=$extoption->quantity;
      }
      return $qunatity;
    }

}
