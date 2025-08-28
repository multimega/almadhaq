<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Related extends Model
{
    

    protected $table ='related';
    protected $fillable = array('related_id','product_id');
    
        public $timestamps = false;

    public function related()
    {
        return $this->hasmany('App\Models\Product');
    }
}
