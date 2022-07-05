<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
  protected $fillable=[
    'title',
    'title_ar',
    'image',
    'url',
  ];

  public function gettitle(){
    return app()->getLocale()=='ar'?$this->title_ar:$this->title;
  }
}
