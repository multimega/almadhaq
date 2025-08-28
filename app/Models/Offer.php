<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['name', 'name_ar','slug','slug_ar','header','content','meta_keys','meta_keys_ar','meta_description','meta_description_ar','title','title_ar'];
    

     public function products()
    {
    	return $this->hasMany('App\Models\OfferProduct');
    }

}
