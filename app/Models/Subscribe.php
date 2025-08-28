<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['user_id','product_id','start_date','trial_end_date','end_date','payment_method','package_price','package_details','paid_via','status'];
    
}
