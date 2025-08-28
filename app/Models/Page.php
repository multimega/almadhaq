<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','title_ar', 'slug', 'slug_ar', 'details', 'details_ar','meta_tag','meta_description','meta_description_ar','mobile_details','mobile_details_ar'];
    public $timestamps = false;
}
