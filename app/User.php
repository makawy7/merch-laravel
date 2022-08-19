<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email','phone',
        'country_code','country_iso2','code','phone_verified_at',
        'role','gender','password','birthday','country','city','default_lang',
        'points','banned','currency','store_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPassword($token));
    }

    public function admin(){
      return $this->role=='admin'?true:false;
    }

    public function carts(){
      return $this->hasMany(Cart::class,'user_id');
    }

    public function ordergroups(){
        return $this->hasMany(Ordergroup::class,'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

    public function totalcartprice(){
      $total=0;
      foreach($this->carts as $cart){
        $total+=$cart->extoption?$cart->extoption->price*$cart->quantity:$cart->product->price*$cart->quantity;
      }
      return $total;
    }

    public function likes(){
      return $this->belongsToMany(Product::class,'user_likes','user_id','product_id');
    }

    public function watches(){
      return $this->belongsToMany(Product::class,'user_watches','user_id','product_id');
    }

    public function addresses(){
      return $this->hasMany(Address::class,'user_id');
    }

    public function getrating($product){
      return Rating::where([['user_id',$this->id],['product_id',$product]])->first()->score;
    }

    public function getcountry(){
      return $this->belongsTo(Country::class,'country');
    }

    public function getcity(){
      return $this->belongsTo(City::class,'city');
    }

    public function subscription(){
      return $this->hasOne(Subscription::class,'user_id');
    }

    public function requests(){
      return $this->hasMany(Changerequest::class,'user_id');
    }

    public function store(){
      return $this->belongsTo(Store::class,'store_id');
    }

    public function getphone(){
      return $this->country_code.$this->phone;
    }

    public function displayphone(){
      return '('.$this->country_code.') '.$this->phone;
    }
    public function comments(){
      return $this->hasMany(Comment::class,'user_id');
    }

    public function verifiedpurchase($productid){
      $product=$this->orders()->where('product_id',$productid)->first();
      if(!empty($product)){
        return true;
      }else {
        return false;
      }
    }

}
