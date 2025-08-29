<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Shipment;
use App\Models\OrderTrack;
use App\Models\VendorOrder;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Models\ShipmentPrice;
use App\Models\Generalsetting;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Validator;
use DB;
use App\Models\AffiliateSetting;
use App\Models\AffilateUsers;
use App\Models\Color;
use App\Models\Referral;
use App\Models\Free;
use App\Models\Piece;

class TabbyController extends Controller
{
    protected  $shipping_price = 0, $shipping_tax = 0;

    public function __construct()
    {
        $gs = Generalsetting::findOrFail(1);
        $this->publicKey = $gs->tabby_key;
        $this->secretKey = $gs->tabby_secret;
    }

    public function submit(Request $request)
    {
        if ($request->pass_check) {
            $users = User::where('name', '=', $request->personal_name)->get();
            if (count($users) == 0) {
                if ($request->personal_pass == $request->personal_confirm) {
                    $user = new User;
                    $user->name = $request->personal_name;

                    $user->password = bcrypt($request->personal_pass);
                    $token = md5(time() . $request->personal_name);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($request->personal_name);
                    $user->email_verified = 'Yes';
                    $user->save();
                    Auth::guard('web')->login($user);
                } else {
                    return redirect()->back()->with('unsuccess', "Confirm Password Doesn't Match.");
                }
            } else {
                return redirect()->back()->with('unsuccess', "This Email Already Exist.");
            }
        }


        if (!Session::has('cart')) {
            return redirect()->route('front.cart', 'en')->with('success', "You don't have any product to checkout.");
        }
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        $gs = Generalsetting::findOrFail(1);

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        /*free product Coupon*/
        $free = Session::has('coupon_free') ? Session::get('coupon_free') : 0;
        $free_pro = Session::has('coupon_pro') ? Session::get('coupon_pro') : 0;
        $free_color = Session::has('coupon_free_color') ? Session::get('coupon_free_color') : 0;
        $free_size = Session::has('coupon_free_size') ? Session::get('coupon_free_size') : 0;

        $weights = 0;

        foreach ($cart->items as $key => $prod) {
            $admin = Admin::find(1);
            $shipment = Shipment::where('id', $request->shipment)->first();
            $pro = Product::findOrFail($prod['item']['id']);
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Country::where('country_name', $request->customer_country)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            } else {
                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }

            if (!empty($prod['item']['license']) && !empty($prod['item']['license_qty'])) {
                foreach ($prod['item']['license_qty'] as $ttl => $dtl) {
                    if ($dtl != 0) {
                        $dtl--;
                        $produc = Product::findOrFail($prod['item']['id']);
                        $temp = $produc->license_qty;
                        $temp[$ttl] = $dtl;
                        $final = implode(',', $temp);
                        $produc->license_qty = $final;
                        $produc->update();
                        $temp =  $produc->license;
                        $license = $temp[$ttl];
                        $oldCart = Session::has('cart') ? Session::get('cart') : null;
                        $cart = new Cart($oldCart);
                        $cart->updateLicense($prod['item']['id'], $license);
                        Session::put('cart', $cart);
                        break;
                    }
                }
            }
        }

        
            if (empty($shippment_price)) {
                $shipping_price = 0;
                $shipping_tax  = 0;
            } else {

                if ($weights > 0) {
                    $shippingvalue = round(($weights - 1)) * ($shippment_price->extra * $curr->value);
                    $t = $shippingvalue + (1 * ($shippment_price->value * $curr->value));
                    $this->shipping_price += $t;
                    $this->shipping_price += ($shipment->shipping_tax / 100 * $this->shipping_price);
                    $this->shipping_tax = $shipment->shipping_tax;
                }
            }

            if ($cart->totalPrice >= ($gs->free_shipping * $curr->value)) {
                $this->shipping_price = 0;
                $this->shipping_tax = 0;
            }
        

        $validator = Validator::make($request->all(), [
            'address'   => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $order = new Order;

        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $gs->title . " Order";
        $item_number = time();

        $pay_amount = ($request->total + $this->shipping_price) /  $curr->value;
        $pay_amount = round($pay_amount);

        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = $pay_amount;
        $order['method'] = "Credit/Debit Card";
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;

        $order['company_name'] = $request->company_name;
        $order['domain_name'] = $request->is_domain == "yes" ? $request->domain_name : null;
        $order['add_domain'] =  $request->is_domain == "no" ? $request->add_domain : "no";


        $order['order_completed'] = 0;
        $order['shipment_id'] = $request->shipment;
        $order['shipping_price'] = $this->shipping_price;
        $order['shipping_tax'] = $this->shipping_tax;
        $order['tax'] = $request->tax;
        $order['tax_value'] = $request->tax_value;
        $order['customer_phone'] = $request->phone;
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        $order['shipping_email'] = $request->shipping_email;
        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['wallet'] = $request->wallet_cost;


        $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();

        if ($last_row) {

            if ($last_row->order_number == 0) {
                $order['order_number'] = 1;
            } else {

                $order['order_number'] = $last_row->order_number + 1;
            }
        } else {

            $order['order_number'] = 1;
        }

        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
            if ($request->wallet_cost && $request->wallet_cost > 0) {

                $user->refunds -= $request->wallet_cost / $curr->value;
            }
            $user->points += ($gs->points * round($cart->totalPrice / $curr->value));
            $user->update();
        }
        $order['dp'] = $request->dp;
        $order['payment_status'] = "Pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;
        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;


        if (Session::has('affid') &&  Session::has('affusrid')) {

            $affid = Session::get('affid');

            $affdata  =  AffiliateSetting::where('id', $affid)->first();

            if (!empty($affdata)) {

                foreach ($cart->items as $key => $prod) {

                    $pdata = Product::where('id', $prod['item']['id'])->first();

                    $userrdta = AffilateUsers::where('product_id', $prod['item']['id'])->pluck('user_id');

                    if ((!empty($pdata->affiliate_setting_id) || $pdata->affiliate_setting_id != 'NUll') && $pdata->affiliate_setting_id ==  $affid) {

                        if ($affdata->type == 0) {

                            $val = $prod['item']['price'] / 100;
                            $sub = $val * $affdata->amount;

                            $user = User::where('id', Session::get('affusrid'))->first();

                            $order['affilate_user_id'] = $user->id;
                            $order['affilate_user'] = $user->name;
                            $order['affilate_charge'] = $sub;
                        } else {

                            $user = User::where('id', Session::get('affusrid'))->first();

                            $order['affilate_user_id'] = $user->id;
                            $order['affilate_user'] = $user->name;
                            $order['affilate_charge'] = $affdata->amount;
                        }
                    } else {
                        continue;
                    }
                }
            }
        }

        $order->save();

        session(['temporder' => $order, 'tempcart' => $cart, 'request' => $request->all()]);

        $language = Language::select('sign')->find(session('language'));

        $orderItems = [];
        foreach ($cart->items as $prod) {

            $product = Product::select('id', 'category_id', 'details')->with('category:id,name')->find($prod['item']['id']);

            $items[] = [
                "title" => $prod['item']['name'],
                "description" => $product ? strip_tags($product->details) : '',
                "quantity" => $prod['item']['size_qty'],
                "unit_price" => $prod['item']['price'],
                "discount_amount" => "0.00",
                "reference_id" => $prod['item']['id'],
                "image_url" => asset('assets/images/products/' . $prod['item']['photo']),
                "product_url" => $prod['item']['photo'],
                "gender" => "female",
                "category" => $product ? $product->category->name : '',
                "color" => $prod['item']['color'],
                "product_material" => "string",
                "size_type" => "",
                "size" => $prod['item']['size'],
                "brand" => "Maison Arabelle"
            ];
        }

        $merchantCode = 'MAAE';
        if ($curr->name === 'SAR') {
            $merchantCode = 'MASA';
        }
        
        $tabbyPayAmount = ($order->pay_amount * $curr->value);
        $tabbyPayAmount = round($tabbyPayAmount);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->publicKey,
        ])->post('https://api.tabby.ai/api/v2/checkout', [
            "payment" => [
                "product" => [
                    "type" => null,
                    "installments_count" => null,
                    "installment_period" => null
                ],
                "amount" => $tabbyPayAmount,
                "currency" => $curr->name,
                "description" => "clothes",
                "buyer" => [
                    "phone" => $request->phone,

                    "name" => $request->personal_name,
                    "dob" => "2006-01-02"
                ],
                "shipping_address" => [
                    "city" => $request->city,
                    "address" => $request->address,
                    "zip" => $request->zip
                ],
                "order" => [
                    "tax_amount" => $request->tax,
                    "shipping_amount" => $request->shipping_price,
                    "discount_amount" => $request->coupon_discount,
                    "updated_at" => "2019-08-24T14:15:22Z",
                    "reference_id" => strval($item_number),
                    "items" => $orderItems,
                ],
                "buyer_history" => [
                    "registered_since" => "2019-08-24T14:15:22Z",
                    "loyalty_level" => 0,
                    "wishlist_count" => 0,
                    "is_social_networks_connected" => true,
                    "is_phone_number_verified" => true,
                    "is_email_verified" => true
                ],
                "order_history" => [
                    [
                        "purchased_at" => now(),
                        "amount" => $tabbyPayAmount,
                        "payment_method" => "card",
                        "status" => "new",
                        "buyer" => [
                            "phone" => $request->phone,
        
                            "name" => $request->personal_name,
                            "dob" => "2019-08-24"
                        ],
                        "shipping_address" => [
                            "city" => $request->city,
                            "address" => $request->address,
                            "zip" => $request->zip
                        ],
                        "items" => $orderItems
                    ]
                ],
                "meta" => [
                    "order_id" => null,
                    "customer" => null
                ],
                "attachment" => [
                    "body" => '{}',
                    "content_type" => "application/vnd.tabby.v1+json"
                ]
            ],
            "lang" => $language->sign,
            "merchant_code" => $merchantCode,
            "merchant_urls" => [
                "success" => route('tabby.success'),
                "cancel" => route('tabby.cancel'),
                "failure" => route('tabby.failure'),
            ]
        ]);

        $result=json_decode($response->getBody()->getContents());
        dd($result);
        if ($result->status != 'error') {
            $responseBody = json_decode($response->body(), true);
            $hostedPaymentPageURL = $responseBody['configuration']['available_products']['installments'][0]['web_url'];

            session(['payment_id' => $responseBody['payment']['id']]);

            $order->txnid = $responseBody['payment']['id'];
            $order->update();
            
            return redirect()->away($hostedPaymentPageURL);
        } else if ($response->failed()) {
            Log::error($response->body());
        }

        return redirect()->route('front.checkout', app()->getLocale());
    }

    public function success()
    {
        $request = (object) session('request');
        $order = session('temporder');

        $order = Order::find($order->id);

        $payment_id = session('payment_id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
        ])->get('https://api.tabby.ai/api/v2/payments/' . $payment_id);

        if ($response->successful()) {
            // $responseBody = json_decode($response->body(), true);

            // $finalResponse = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $this->secretKey,
            // ])->put('https://api.tabby.ai/api/v1/payments/' . $payment_id, [
            // ]);            

            // if ($finalResponse->successful()) {

            // } else if ($response->failed()) {
            //     Log::error($response->body());
            // }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])->post("https://api.tabby.ai/api/v1/payments/{$order->txnid}/captures", [
                "amount" => $order->pay_amount,
            ]);

            if ($response->successful()) {
                $order->update([
                    'payment_status' => 'Completed',
                    'status' => 'completed',
                    'order_completed' => 1
                ]);
            } else if ($response->failed()) {
                Log::error($response->body());
            }
        } else if ($response->failed()) {
            Log::error($response->body());
        }


        $track = new OrderTrack;
        $track->title = 'Pending';
        $track->text = 'You have successfully placed your order.';
        $track->order_id = $order->id;
        $track->save();

        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();

        if ($request->coupon_id != "") {
            $coupon = Coupon::find($request->coupon_id);
            if (!empty($coupon)) {
                $coupon->used++;
                if ($coupon->times != null) {
                    $i = (int)$coupon->times;
                    $i--;
                    $coupon->times = (string)$i;
                    if ((int)$i == 0) {
                        $coupon->status = 0;
                    }
                }
                $coupon->update();
            }


            /* Free Product */
            $coupon1 = Free::find($request->coupon_id);
            if (!empty($coupon1)) {
                $coupon1->used++;
                if ($coupon1->times != null) {
                    $i = (int)$coupon1->times;
                    $i--;
                    $coupon1->times = (string)$i;
                    if ((int)$i == 0) {
                        $coupon1->status = 0;
                    }
                }
                $coupon1->update();
            }


            /*  Referral  */
            $coupon2 = Referral::find($request->coupon_id);
            if (!empty($coupon2)) {
                $coupon2->used++;
                if ($coupon2->times != null) {
                    $i = (int)$coupon2->times;
                    $i--;
                    $coupon2->times = (string)$i;
                    if ((int)$i == 0) {
                        $coupon2->status = 0;
                    }
                }
                $coupon2->update();
            }


            /* Take One Free */
            $coupon3 = Piece::find($request->coupon_id);
            if (!empty($coupon3)) {
                $coupon3->used++;
                if ($coupon3->times != null) {
                    $i = (int)$coupon3->times;
                    $i--;
                    $coupon3->times = (string)$i;
                    if ((int)$i == 0) {
                        $coupon3->status = 0;
                    }
                }
                $coupon3->update();
            }
        }

        $cart = session('tempcart');

        foreach ($cart->items as $prod) {

            $x = (string)$prod['size_qty'];
            if (!empty($x)) {
                $product = Product::findOrFail($prod['item']['id']);
                if (!empty($product->size_qty)) {
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    $temp1 = implode(',', $temp);
                    $product->size_qty =  $temp1;
                    $product->update();
                }
                $color = Color::where('product_id', $prod['item']['id'])->where('size', $prod['size'])->where('colors', '#' . $prod['color'])->first();
                if (!empty($color)) {
                    $color->size_qty -= $prod['qty'];
                    $color->save();
                }
            }
        }

        foreach ($cart->items as $prod) {
            $x = (string)$prod['stock'];
            if ($x != null) {

                $product = Product::findOrFail($prod['item']['id']);
                $product->stock -=  $prod['qty'];
                $product->update();
                if ($product->stock <= 5) {
                    $notification = new Notification;
                    $notification->product_id = $product->id;
                    $notification->save();
                }
            }
        }

        $notf = null;

        foreach ($cart->items as $prod) {
            if ($prod['item']['user_id'] != 0) {
                $vorder =  new VendorOrder;
                $vorder->order_id = $order->id;
                $vorder->user_id = $prod['item']['user_id'];
                $notf[] = $prod['item']['user_id'];
                $vorder->qty = $prod['qty'];
                $vorder->price = $prod['price'];
                $vorder->order_number = $order->order_number;
                $vorder->save();
            }
        }

        if (!empty($notf)) {
            $users = array_unique($notf);
            foreach ($users as $user) {
                $notification = new UserNotification;
                $notification->user_id = $user;
                $notification->order_number = $order->order_number;
                $notification->save();
            }
        }

        $gs = Generalsetting::findOrFail(1);
        //Sending Email To Buyer
        if ($gs->is_smtp == 1) {
            /*if (!empty($request->personal_email)) {
                $msg = "Hello " . $request->personal_name . "!<br> You have placed a new order.<br>Your order number is " . $order->order_number . ".Please wait for your delivery. <br>Thank you.";
                $msgs = '<html><body>';
                $msgs = '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgs = $msg;
                $msgs .= "</table>";
                $msgs .= "</body></html>";
                $data = [
                    'to' => $request->personal_email,
                    'subject' => "Your Order Placed!!",
                    'body' => $msgs,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMailToUser($data, $order->id);
            } else {
                $to = $request->personal_email;
                $subject = "Your Order Placed!!";
                $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
                $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                mail($to, $subject, $msg, $headers);
            }
        }*/

        //Sending Email To Admin
        if ($gs->is_smtp == 1) {
            $msg = "Hello Admin!<br> Your store has recieved a new order. <br> Order Number is " . $order->order_number . " <br> Customer name : " . $order->customer_name . "<br>Customer phone : " . $order->customer_phone . "<br> Please login to your panel to check. <br>Thank you.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            $data = [
                'to' => $gs->email,
                'subject' => "New Order Recieved!!",
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMailToUser($data, $order->id);
        } else {
            $to = $gs->email;
            $subject = "New Order Recieved!!";
            $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is " . $order->order_number . "\nCustomer name : " . $order->customer_name . "\nCustomer phone : " . $order->customer_phone . "\nPlease login to your panel to check. \nThank you.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
        }

        $this->erporder($order);

        session()->forget(['request', 'payment_id']);

        session()->forget([
            'cart', 'already', 'coupon', 'coupon_id',
            'coupon_total', 'coupon_total1', 'coupon_percentage',
            'coupon_percentage', 'coupon_product', 'coupon_free',
            'coupon_free_color', 'coupon_free_size', 'coupon_piece',
            'coupon_piece_color', 'coupon_piece_size', 'coupon_pro'
        ]);

        return redirect()->route('payment.return');
    }

    public function cancel()
    {
        $order = session('temporder');
        $order = Order::find($order->id);

        $order->update([
            'payment_status' => 'Cancelled',
            'status' => 'declined',
        ]);

        session()->forget(['request', 'payment_id']);

        $language = Language::select('sign')->find(session('language'));
        
        return redirect()->route('front.checkout',  $language->sign);

    }

    public function failure()
    {
        $order = session('temporder');
        $order = Order::find($order->id);

        $order->update([
            'payment_status' => 'Failure',
            'status' => 'declined',
            'order_completed' => 1
        ]);

        session()->forget(['request', 'payment_id']);

        $language = Language::select('sign')->find(session('language'));

        return redirect()->route('front.checkout', $language->sign);

    }

    /*#################### ERP Order integration ####################################*/

    public function erporder($data)
    {
        $gs = Generalsetting::findOrFail(1);

        $payload = json_encode($data);
        $code = env('Code');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $gs->order_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('order' => $payload, 'code' => $code),
            CURLOPT_HTTPHEADER => array(
                'Cookie: laravel_session=HoaEEq4hiMoQfFLM6jivNGIdpIMsrxOVq1K3qVyr'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);

        return $json;
    }
}
