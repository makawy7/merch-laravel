<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable=['score','product_id','user_id'];

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
      return $this->belongsTo(Product::class,'product_id');
    }
}
