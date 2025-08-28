<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class OrdersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
             'order_number'     => $row[0],
            'cart'    => $row[1], 
            'pay_amount'    => $row[2], 
            'currency_sign'    => $row[3], 
            'totalQty'    => $row[4], 
            'payment_status'    => $row[5], 
            'method'    => $row[6], 
            'shipping'    => $row[7], 
            'user_id'    => $row[8], 
            'customer_name'    => $row[9], 
            'customer_email'    => $row[10], 
            'customer_phone'    => $row[11], 
            'customer_country'    => $row[12], 
            'customer_city'    => $row[13], 
            'customer_address'    => $row[14], 
            'status'    => $row[15], 
            'shipment_id'    => $row[16], 
            'order_completed'    => 1, 
        ]);
    }
}
