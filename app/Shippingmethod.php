<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Shippingmethod extends Model
{
    use GetName;
    protected $fillable=[
      'name','name_ar','cost','deliverytime'
    ];

    public function getcost(){
      if(function_exists('getcurrency') && !empty(getcurrency())){
        if($this->cost==0){
          return trans('site.constants.free');
        }
        return $this->cost*getcurrency()->value.' '.getcurrency()->getabbreviation();
      }
    }


}
