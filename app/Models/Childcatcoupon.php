<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Childcatcoupon extends Pivot
{

    protected $table = 'coupon_childcategories';
    protected $fillable = array('code_id', 'childcat_id');
    public $timestamps = false;

    public static function findByCode($code)
    {

        return self::where('code', $code)->first();
    }
}
