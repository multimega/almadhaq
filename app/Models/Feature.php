<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model {
    
    protected $table = 'features';
     protected $fillable = array('name','status','id','active');
        public $timestamps = false; 
        
        
}