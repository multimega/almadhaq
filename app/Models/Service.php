<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['user_id','title','details','title_ar','details_ar','photo','icon'];
    public $timestamps = false;
}
