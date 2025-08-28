<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps=false;
    protected $table="likes";

    
    public function product($id)
    {
        return Product::find($id);
    }
    
           public function like()
           {
           return $this->belongsTo('App\Product',  'product_id');
            }

}
