<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['user_id','product_id','review','rating'];
    public $timestamps = true;
    
    
    public function users()
    {
    	return $this->hasMany('App\Models\User','id');
    }  
}
