<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Country extends Model
{
    use GetName;

    protected $fillable=[
      'name','name_ar','code','order'
    ];


    public function addresses(){
    return $this->hasMany(Address::class,'country');
    }

    public function cities(){
      return $this->hasMany(City::class,'country_id')->orderBy('order','asc');
    }
}
