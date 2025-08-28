<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    protected $table = 'user_carts';
    
     protected $fillable = ['cart','user_id','deleted_items'];
     
     	public function user()
	{
	    return $this->belongsTo('App\Models\User');
	}
}
