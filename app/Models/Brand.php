<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
      use SoftDeletes;
      
    protected $fillable = ['name','name_ar','slug','slug_ar','photo','is_featured','image','erp_id','meta_keys','meta_keys_ar','meta_description','meta_description_ar','title','title_ar'];
    public $timestamps = false;

     public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
