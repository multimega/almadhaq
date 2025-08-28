<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Free extends Model {
    
    protected $table = 'free';
     protected $fillable = ['code','type','value','user_id','status','photo','times','used','rand','start_date','end_date'];
        public $timestamps = false;
    
    public static function findByCode($code){
        
        return self::where('code',$code)->first();
    }
    
    public function product(){
        
        return $this->belongsTo('App\Propiece', 'code_id','id');
            
        
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


