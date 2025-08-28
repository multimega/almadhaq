<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propiece extends Model {
    
    protected $table = 'propieces';
     protected $fillable = array('code_id','product_id');
        public $timestamps = false;
    
    
     public function product()
    {
        return $this->hasmany('App\Models\Product');
    }
    
    
    public static function findByCode($code){
        
        return self::where('code',$code)->first();
    }
    
   
 
}


