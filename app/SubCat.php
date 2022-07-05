<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\GetName;
use App\Traits\GetSlug;
use App\Traits\FindBySlug;

class SubCat extends Model
{
    use Sluggable,GetName,GetSlug,FindBySlug;

    protected $fillable = [
        'name', 'name_ar','slug','slug_ar','maincat_id'
    ];

    public function getslug(){
      return app()->getLocale()=='ar'?$this->slug_ar:$this->slug;
    }

    public function maincat(){
      return $this->belongsTo(MainCat::class,'maincat_id');
    }

    public function types(){
      return $this->hasMany(Type::class,'subcat_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
                  Product::class,
                  Type::class,
                  'subcat_id',
                  'type_id',
              );
    }

}
