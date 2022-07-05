<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=[
      'name','add_1','add_2','phone','city','country','postcode','info','user_id'
    ];

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function getcity(){
      return $this->belongsTo(City::class,'city');
    }

    public function getcountry(){
    return $this->belongsTo(Country::class,'country');
    }
}
