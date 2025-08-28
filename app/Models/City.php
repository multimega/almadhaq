<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {
    protected $table = 'cities';
    protected $fillable = array('name','name_ar','status','state_id','allow_cash');
    public $timestamps = false;

}
