<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable=['plan_id','start_date','end_date','paid','active','paymentmethod','user_id','lastamount'];

    public function plan(){
      return $this->belongsTo(Plan::class,'plan_id');
    }

    public function getpaymentmethod(){
      return $this->belongsTo(Planspaymentmethod::class,'paymentmethod');
    }

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function store(){
      return $this->hasOne(Store::class,'subscription_id');
    }

    public function getstartdate(){
      return \Carbon\Carbon::parse($this->start_date)->toDateString();
    }

    public function getenddate(){
      return \Carbon\Carbon::parse($this->end_date)->toDateString();
    }

    public function datepicker_startdate(){
      return \Carbon\Carbon::parse($this->start_date)->format('m/d/Y');
    }

    public function getprice(){
      $months=\Carbon\Carbon::parse($this->end_date)->format('m')-\Carbon\Carbon::parse($this->start_date)->format('m');
      return $months*$this->plan->price;
    }


}
