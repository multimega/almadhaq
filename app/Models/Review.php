<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['photo','title','subtitle','details','title_ar','subtitle_ar','details_ar'];
    public $timestamps = false;
}
