<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Option extends Model
{
    use GetName;

  protected $fillable=['name','name_ar','variation_id'];

  public function variation(){
    return $this->belongsTo(Variation::class,'variation_id');
  }

  public function extoptions(){
    return $this->belongsToMany(Extoption::class,'options_extoptions','option_id','extoption_id');
  }

  protected static function boot()
  {
      parent::boot();
      static::deleting(function ($model) {
          $model->extoptions()->detach();
      });
  }
}
