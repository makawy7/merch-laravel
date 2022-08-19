<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
        protected $fillable=['review','review_points','email','email_points',
                              'phone','phone_points','product','product_points',];

}
