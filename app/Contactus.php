<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $fillable=['name','email','phone','title','body','read_at','user_id'];

    public function minago(){
      $createdat=\Carbon\Carbon::parse($this->created_at);
      $today= \Carbon\Carbon::now();
      return $createdat->diffInMinutes($today, false);
    }

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }
}
