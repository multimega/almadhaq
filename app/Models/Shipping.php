<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['user_id', 'title', 'title_ar', 'subtitle', 'price'];

    public $timestamps = false;

}