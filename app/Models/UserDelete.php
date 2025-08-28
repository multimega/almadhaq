<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDelete extends Model
{
     protected $table = 'user_delets';
    
     protected $fillable = ['user_id','deleted_items'];
     
     	public function user()
	{
	    return $this->belongsTo('App\Models\User');
	}
}
