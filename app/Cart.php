<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['product_id','extoption_id','quantity','user_id'];

    public function product(){
      return $this->belongsTo(Product::class,'product_id');
    }
    public function extoption(){
      return $this->belongsTo(Extoption::class,'extoption_id');
    }
    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }
    public function getoptions(){
      $options_names='';
      if($this->extoption){
        foreach ($this->extoption->options as $option) {
          $options_names.=$option->getname().'-';
        }
        $options_names=rtrim($options_names,'-');
      }
      return $options_names;
    }

    public function qprice(){
      if($this->extoption){
          $qprice=$this->extoption->price*$this->quantity;
      }else{
          $qprice=$this->product->price*$this->quantity;
      }
      return $qprice;
    }

    public function getmaxquantity(){
      if($this->extoption){
          $max=$this->extoption->quantity;
      }else{
          $max=$this->product->quantity;
      }
      return $max;
    }

}
