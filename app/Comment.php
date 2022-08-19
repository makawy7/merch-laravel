<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  protected $fillable=['title','body','user_id','product_id','image'];


  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }

  public function product(){
    return $this->belongsTo(Product::class,'product_id');
  }
}
