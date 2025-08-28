<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productFavorite extends Model
{
    protected $table = 'product_favorite';
    protected $fillable = ['product_id','user_id','status'];
    public $timestamps = false;
}
