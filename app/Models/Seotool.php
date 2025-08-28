<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seotool extends Model
{
    protected $fillable = ['google_analytics','meta_keys','facebook_pixel','meta_keys_ar','meta_description','meta_description_ar','title','title_ar','product_analytics',
'category_analytics','offer_analytics','brand_analytics','subcategory_analytics','childcategory_analytics'];
    public $timestamps = false;
}
