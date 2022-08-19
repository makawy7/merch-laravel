<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\GetName;
use App\Traits\GetSlug;

class MainCat extends Model
{
    use Sluggable,GetName,GetSlug;

    protected $fillable = [
        'name', 'name_ar','slug', 'slug_ar'
    ];

    public function getslug(){
      return app()->getLocale()=='ar'?$this->slug_ar:$this->slug;
    }

    public function subcats(){
      return $this->hasMany(SubCat::class,'maincat_id');
    }

    public function types(){
      return $this->hasManyThrough(Type::class,SubCat::class,'maincat_id','subcat_id');
    }

    // public function products(){
    //     $products='';
    //   foreach($this->types as $type){
    //     if(count($type->products)){
    //       $products.=$type->products;
    //     }
    //   }
    //   return json_decode($products);
    // }

}
