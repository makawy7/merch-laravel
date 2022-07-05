<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordergroup extends Model
{
    protected $fillable=['user_id','order_number','stauts','shippingmethod',
    'paymentmethod','currency','address','carrier','trackingnumber','delivered','status','delivery_time','paid'];

    public function getpaymentmethod(){
      return $this->belongsTo(Paymentmethod::class,'paymentmethod');
    }

    public function getshippingmethod(){
      return $this->belongsTo(Shippingmethod::class,'shippingmethod');
    }

    public function getaddress(){
      return $this->belongsTo(Address::class,'address');
    }

    public function getcurrency(){
      return $this->belongsTo(Currency::class,'currency');
    }

    public function orders(){
      return $this->hasMany(Order::class,'ordergroup');
    }

    public function getstatus(){
      return $this->belongsTo(Orderstatus::class,'status');
    }

    public function getshippingcost(){
      return $this->getshippingmethod->cost*$this->getcurrency->value.' '.$this->getcurrency->getabbreviation();;
    }

    public function gettotal(){
      $total=0;
      foreach($this->orders as $order){
        $total+=$order->qprice;
      }
      $total+=$this->getshippingmethod->cost;
      return $total*$this->getcurrency->value.' '.$this->getcurrency->getabbreviation();
    }

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

}
