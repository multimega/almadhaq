<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name_ar', 'country_name', 'country_code', 'phonecode','phone_numbers','status','is_default'];
     public $timestamps = false;
   

    

}
