<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['area', 'building_number', 'shipping_schedule_id', 'scheduled_delivery_date', 'scheduled_delivery_start_time', 'scheduled_delivery_end_time', 'user_id', 'cart', 'tap_order_id', 'invoice_url', 'method', 'shipping', 'pickup_location', 'totalQty', 'shipping_price', 'shipping_tax', 'wallet', 'order_completed', 'pay_amount', 'txnid', 'shipment_id', 'charge_id', 'order_number', 'payment_status', 'customer_country', 'currency_sign', 'customer_name', 'customer_phone', 'customer_address', 'customer_city', 'customer_zip', 'shipping_name', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip', 'order_note', 'status'];

  // protected $guarded = ['id'];

  public function vendororders()
  {
    return $this->hasMany('App\Models\VendorOrder');
  }

  public function tracks()
  {
    return $this->hasMany('App\Models\OrderTrack', 'order_id');
  }

  public function carts()
  {
    return  unserialize(bzdecompress(utf8_decode($this->cart)));
  }
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function   shipment()
  {
    return $this->belongsTo('App\Models\Shipment', 'shipment_id');
  }
}
