<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Variation extends Model
{
    use GetName;

    protected $fillable=['name','name_ar','product_id'];


    public function product(){
      return $this->belongsTo(Product::class,'product_id');
    }

    public function options(){
      return $this->hasMany(Option::class,'variation_id');
    }


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->options()->delete();
        });
    }

}
