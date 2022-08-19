<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Currency extends Model
{
  use GetName;

  protected $fillable=['name','name_ar','value','abbreviation','abbreviation_ar','order'];

  public function getabbreviation(){
      return app()->getLocale()=='ar'?$this->abbreviation_ar:$this->abbreviation;
  }

}
