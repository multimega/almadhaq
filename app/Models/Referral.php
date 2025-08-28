<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model {
    
     protected $table ='referrals';
     protected $fillable = array('code','type','price','percent_off','status','photo','limited','user_id','new_id','rand');
        public $timestamps = false;
    
    public static function findByCode($code){
        
        return self::where('code',$code)->first();
    }
    
    public function discount($total){
        
        if($this->type == 'fixed'){
            return $this->value;
        }elseif($this->type == 'percent'){
            
            return ($this->percent_off / 100 ) * $total;
            
        }else{
            return 0 ;
        }
        
    }
    
    /* public function shipping(){
          if($this->type == 'shipping'){
              
            return 0;
        }
     }*/
    
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
