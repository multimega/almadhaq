<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colike extends Model
{
    public $timestamps=false;
    protected $table="co_likes";

    
   
           public function rate() {
           return $this->belongsTo('App\Models\Rate',  'rate_id');
       }

}
