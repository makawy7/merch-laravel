<?php

namespace App\Traits;

trait GetSlug
{
  public function getslug(){
    return app()->getLocale()=='ar'?$this->slug_ar:$this->slug;
  }
}
