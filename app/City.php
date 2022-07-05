<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class City extends Model
{
    use GetName;

    protected $fillable=[
      'name','name_ar','country_id','order'
    ];

    public function addresses(){
      return $this->hasMany(Address::class,'city');
    }
    public function country(){
      return $this->belongsTo(Country::class,'country_id');
    }
}
