<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductNotify extends Model
{
    
     protected $table = 'products_notify';
     
     protected $fillable = ['product_id','zone_id'];
     
     public function product() {
          
        return $this->belongsTo('App\Models\Product');
    } 
    
     public function city() {
         
        return $this->belongsTo('App\Models\Zone');
    } 
     
}
