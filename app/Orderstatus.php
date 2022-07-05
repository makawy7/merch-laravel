<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetName;

class Orderstatus extends Model
{
    use GetName;
    protected $fillable=['name','name_ar','cancancel'];

}
