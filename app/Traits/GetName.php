<?php

namespace App\Traits;

trait GetName
{
  public function getname(){
    return app()->getLocale()=='ar'?$this->name_ar:$this->name;
  }
}
