<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable=[
    'user_id','product_id','extoption_id','quantity','price','qprice','store_id',
    'currency','paid','delivered','cancelled','paymentmethod','address','status',
    'willbedelivered','willnotmsg_id','ordergroup','delivery_time',
  ];

  public function product(){
    return $this->belongsTo(Product::class,'product_id');
  }

  public function extoption(){
    return $this->belongsTo(Extoption::class,'extoption_id');
  }

  public function seller(){
    return $this->belongsTo(User::class,'seller_id');
  }

  public function paymentmethod(){
    return $this->belongsTo(Paymentmethod::class,'paymentmethod');
  }

  public function getcurrency(){
    return $this->belongsTo(Currency::class,'currency');
  }

  public function address(){
    return $this->belongsTo(Address::class,'address');
  }

  public function getordergroup(){
    return $this->belongsTo(Ordergroup::class,'ordergroup');
  }

  public function getstatus(){
    return $this->belongsTo(Orderstatus::class,'stauts');
  }

  public function getqprice(){
      return $this->qprice*$this->getcurrency->value.' '.$this->getcurrency->getabbreviation();
  }

  public function getprice(){
    return $this->price*$this->getcurrency->value.' '.$this->getcurrency->getabbreviation();
  }

  public function store(){
    return $this->belongsTo(Store::class,'store_id');
  }

}
