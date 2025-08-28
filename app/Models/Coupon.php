<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'price', 'times', 'start_date', 'end_date', 'limited', 'user_id', 'photo', 'what'];
    public $timestamps = false;

    public function upload($name, $file, $oldname)
    {
        $file->move('assets/images/coupon/', $name);
        if ($oldname != null) {
            if (file_exists(public_path() . '/assets/images/coupon/' . $oldname)) {
                unlink(public_path() . '/assets/images/coupon/' . $oldname);
            }
        }
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'procoupons', 'code_id', 'product_id');
    }

    public function categories()
    {
    return $this->belongsToMany(Category::class, 'coupon_categories', 'code_id', 'cat_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(Subcategory::class, 'coupon_subcategories', 'code_id', 'subcat_id');
    }

    public function childCategories()
    {
        return $this->belongsToMany(Childcategory::class, 'coupon_childcategories', 'code_id', 'childcat_id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'coupon_brands', 'code_id', 'brand_id');
    }
}
