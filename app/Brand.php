<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\GetName;
use App\Traits\GetSlug;

class Brand extends Model
{
    use Sluggable,GetName,GetSlug;

    protected $fillable=[
      'name','name_ar','type_id','slug','slug_ar'
    ];

    public function getslug(){
      return app()->getLocale()=='ar'?$this->slug_ar:$this->slug;
    }

    public function type(){
      return $this->belongsTo(Type::class,'type_id');
    }

    public function products(){
      return $this->hasMany(Product::class,'brand_id');
    }
}
