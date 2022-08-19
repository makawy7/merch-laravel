<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\GetName;
use App\Traits\GetSlug;
use App\Traits\FindBySlug;

class Type extends Model
{
    use Sluggable,GetName,GetSlug,FindBySlug;

  protected $fillable = [
      'name', 'name_ar','slug','slug_ar','subcat_id'
  ];

  public function getslug(){
    return app()->getLocale()=='ar'?$this->slug_ar:$this->slug;
  }

  public function subcat(){
    return $this->belongsTo(SubCat::class,'subcat_id');
  }

  public function brands(){
    return $this->hasMany(Brand::class,'type_id');
  }

  public function products(){
    return $this->hasMany(Product::class,'type_id');
  }

}
