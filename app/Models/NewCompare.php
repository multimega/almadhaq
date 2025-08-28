<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewCompare extends Model
{
    protected $table = 'new_compare';
    protected $fillable = ['product_id', 'user_id','id'];
    

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }



}
