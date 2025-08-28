<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Subcatcoupon extends Pivot
{

    protected $table = 'coupon_subcategories';
    protected $fillable = array('code_id', 'subcat_id');
    public $timestamps = false;

    public static function findByCode($code)
    {

        return self::where('code', $code)->first();
    }
}
