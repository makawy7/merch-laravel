<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Setting extends Model
{
    use GetName;

    protected $fillable=[
        'name','name_ar','icon','logo','terms','terms_ar','return_policy','return_policy_ar',
        'privacy_policy','privacy_policy_ar','address','address_ar','phone','email','default_lang',
        'default_currency','tags','status','maintenance_msg','maintenance_msg_ar','points_value'
    ];

    public function sitename(){
      return app()->getLocale()=='ar'?$this->name_ar:$this->name;
    }
    public function getterms(){
      return app()->getLocale()=='ar'?$this->terms_ar:$this->terms;
    }
    public function getreturnpolicy(){
      return app()->getLocale()=='ar'?$this->return_policy_ar:$this->return_policy;
    }
    public function getprivacypolicy(){
      return app()->getLocale()=='ar'?$this->privacy_policy_ar:$this->privacy_policy;
    }
    public function getmaintenancemsg(){
      return app()->getLocale()=='ar'?$this->maintenance_msg_ar:$this->maintenance_msg;
    }

}
