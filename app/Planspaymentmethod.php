<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Planspaymentmethod extends Model
{
    use GetName;
    protected $fillable = ['name','name_ar'];
}
