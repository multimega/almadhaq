<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Piece extends Model {
    
    protected $table = 'pieces';
     protected $fillable = array('code','times','used','user_id','status','photo','start_date','end_date','rand','buy','take');
    public $timestamps = false;
    
    public static function findByCode($code){
        
        return self::where('code',$code)->first();
    }
    
    public function product(){
        
         return $this->belongsToMany('App\Models\Product');
            
        
    }
    
    
   public function upload($name,$file,$oldname)
    {
                $file->move('assets/images/coupon/',$name);
                if($oldname != null)
                {
                    if (file_exists(public_path().'/assets/images/coupon/'.$oldname)) {
                        unlink(public_path().'/assets/images/coupon/'.$oldname);
                    }
                }  
    }
}


