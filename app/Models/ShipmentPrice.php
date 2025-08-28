<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentPrice extends Model
{
    protected $table = 'shipment_price';
    protected $fillable = array('from', 'to', 'value','extra','shipment_id');
    public $timestamps = false;

  

    public function  tozone(){
        return $this->belongsTo('App\Models\ShipmentZone', 'to');        
    }

   
  public function   shipment(){
        return $this->belongsTo('App\Models\Shipment', 'shipment_id');        
    }
 
}