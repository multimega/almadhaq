<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "addresses";
    protected $fillable = ['user_id','country','city','address','phone'];
    public $timestamps = false;

 

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

  
}
