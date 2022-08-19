<?php

namespace App\Traits;

trait FindBySlug
{
    public static function findbyslug($slug){

      $product=Self::where('slug_ar',$slug)->first();
      if(empty($product)){
      $product=Self::where('slug',$slug)->first();
      }
      return $product;
    }
}
