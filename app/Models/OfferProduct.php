<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    protected $fillable = ['product_id', 'offer_id'];
     public $timestamps = false;
   

     public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function offers()
    {
        return $this->belongsTo('App\Models\Offer');
    }


}
