<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class Orders2Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $o = Order::select('order_number','cart','pay_amount','currency_sign','totalQty','payment_status','method','shipping','user_id','customer_name','customer_email','customer_phone','customer_country','customer_city','customer_address','status','shipment_id','shipping_price','shipping_tax')
      ->get();
       
        return $o;
    }
}
