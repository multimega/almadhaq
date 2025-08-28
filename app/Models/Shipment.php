<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'shipment';
    protected $fillable = array('name', 'desc','name_ar','desc_ar','active','phone','photo','shipping_tax');

    static public function Shipment_price($method_id) {
        //Calculate Shipment Price For My Cart
        $card = $_SESSION['cart'];
        $total = 0;
        if ($card) {
          foreach ($card as $p) {
              $pro = Product::find($p['productid']);
              $total+=$pro->weight * $p['quantity'];
          }
        }
        $weights = Weights::where('method_id', $method_id)->get();
        foreach ($weights as $we) {
            if ($total >= $we->from && $total <= $we->to) {
                return $we->value;
            }
        }
        return "no";
    }

    public function weights() {
        return $this->hasMany('App\Weights', 'method_id');
    }

    public function zones() {
        return $this->hasMany('App\Shipmentzone', 'shipment_id');
    }

    public function  Shipment_price_zone(){
        return $this->hasMany('App\Models\ShipmentPrice', 'shipment_id');
    }
    
    
    
    public function setPhotoAttribute($image)
    {
        if ($image) {
            $dest = 'assets/images/shipments/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }  
}
