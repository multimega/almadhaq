<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profree extends Model {
    
    protected $table = 'profree';
     protected $fillable = array('code_id','product_id');
        public $timestamps = false;
    
    public static function findByCode($code){
        
        return self::where('code',$code)->first();
    }
    
   
 
}


