<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'name_ar', 'slug', 'photo', 'is_featured', 'image', 'erp_id', 'slug_ar', 'tags', 'tags_ar', 'meta_tag', 'meta_description_ar', 'meta_description', 'title', 'title_ar', 'details', 'details_ar'];
    public $timestamps = false;

    public function subs()
    {
        return $this->hasMany('App\Models\Subcategory')->where('status', '=', 1);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function attributes()
    {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_categories', 'cat_id', 'code_id');
    }
}
