<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['photo','link','type','title','title_ar','subtitle','subtitle_ar','button','btn_ar'];
    public $timestamps = false;
}
