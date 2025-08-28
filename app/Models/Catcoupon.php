<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Catcoupon extends Pivot
{

    protected $table = 'coupon_categories';
    protected $fillable = array('code_id', 'cat_id');
    public $timestamps = false;

    public static function findByCode($code)
    {

        return self::where('code', $code)->first();
    }
}
