<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Brandcoupon extends Pivot
{

    protected $table = 'coupon_brands';
    protected $fillable = array('code_id', 'brand_id');
    public $timestamps = false;

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }
}
