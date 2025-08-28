<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['product_id', 'size', 'colors', 'size_qty', 'size_price', 'image'];
    public $timestamps = false;


    public function size()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function getColorAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }
}
