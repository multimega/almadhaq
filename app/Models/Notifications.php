<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    
     protected $table = 'notification';
     protected $fillable = ['user_id','text','text_ar','linked','linked_id','type'];
  

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

 
}
