<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;
class Paymentmethod extends Model
{
    use GetName;
    protected $fillable=['name','name_ar','order'];

    public function ordergroups(){
      return $this->hasMany(Ordergroup::class,'paymentmethod');
    }
}
