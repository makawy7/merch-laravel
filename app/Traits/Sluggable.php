<?php

namespace App\Traits;

trait Sluggable
{
    public function generateUniqueSlug($field,$slug){
      if(count(Self::where([[$field,'=',$slug],['id','!=',$this->id]])->get())>0){
        return $this->generateUniqueSlug($field,$slug.'-');
      }else {
        $this->update([$field=>$slug]);
      }
    }
}
