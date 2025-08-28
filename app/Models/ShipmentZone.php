<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentZone extends Model
{
    protected $table = 'shipment_zone';
    protected $fillable = array('name', 'name_ar', 'desc','desc_ar');
    

 
}