<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffilateUsers extends Model
{
    
    protected $table = 'affiliate_user';
    protected $fillable = ['product_id','user_id'];
    
    public $timestamps = false;
    
    
    
    
}

