<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCurrency extends Model
{
    protected $table = 'product_currencies';
    protected $fillable = ['product_id','country','price'];
  //  public $timestamps = false;
}
