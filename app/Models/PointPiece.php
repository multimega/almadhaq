<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointPiece extends Model
{
    protected $fillable = ['code', 'type', 'price', 'times', 'days','limited','user_id','photo','points','product_id','buy','take'];
    public $timestamps = false;
    
    
    
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
