<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['user_id', 'title', 'subtitle', 'title_ar', 'subtitle_ar', 'price'];

    public $timestamps = false;

}