<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Language;
use App\Models\OrderTrack;
use App\Models\VendorOrder;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Models\ShipmentPrice;
use App\Models\Generalsetting;
use App\Models\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Shipment;
use App\Models\ShipmentZone;
use Validator;
use DB;
use App\Models\AffiliateSetting;
use App\Models\AffilateUsers;
use App\Models\Color;
use App\Models\Referral;
use App\Models\Address;
use App\Models\PaymentGateway;
use App\Models\Pickup;
use App\Models\Free;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Profree;
use App\Models\Subscribe;
use App\Models\Piece;
use App\Models\Propiece;
use phpseclib\Crypt\RSA as Crypt_RSA;


class TelrController extends Controller
{

    protected  $shipping_price = 0, $shipping_tax = 0;

    public function __construct()
    {
        $gs = Generalsetting::findOrFail(1);
        $this->telr_store_id = $gs->telr_store_id;
        $this->telr_auth_key = $gs->telr_auth_key;
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

        if ($request->shipping == "shipto") {
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
        }

        $validator = Validator::make($request->all(), [
            'address'   => 'required',
        ]);

        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $order = new Order;

        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();

        $pay_amount = ($request->total + $this->shipping_price) /  $curr->value;
        $pay_amount = round($pay_amount, 2);

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
        $order['customer_phone'] = $request->phone;
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
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


        $countryCode = Country::select('country_code')->where('country_name', $request->customer_country)->first();
        $countryCode = $countryCode->country_code;

        $language = Language::select('sign')->find(session('language'));

        $unique_cart_id = rand(11111, 55555);
        $params = array(
            'ivp_method' => 'create',
            'ivp_store' => env('TELR_STORE_ID', $this->telr_store_id),
            'ivp_authkey' => env('TELR_STORE_AUTH_KEY', $this->telr_auth_key),
            'ivp_amount' => ($order->pay_amount * $curr->value),
            'ivp_currency' => env('TELR_CURRENCY', $curr->name),
            'ivp_test' => env('TELR_TEST_MODE', false),
            'ivp_desc' => 'Buy products',

            'return_auth' => route('telr.success', ['id', $unique_cart_id]),
            'return_decl' => route('telr.declined', ['id', $unique_cart_id]),
            'return_can' => route('telr.cancel', ['id', $unique_cart_id]),

            'bill_fname' => $request->personal_name,
            'bill_sname' => 'Maison',
            'bill_addr1' => $request->address ?? '',
            'bill_city' => $request->city ?? '',
            'bill_region' => $request->state ?? '',
            'bill_country' => $countryCode,
            'bill_zip' => $request->postal_code ?? '',
            'bill_phone' => $request->phone ?? '',

            'ivp_lang' => $language->sign,
            'ivp_applepay' => 1,
            'ivp_cart' => $unique_cart_id,
            'ivp_framed' => 0
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.telr.com/gateway/order.json");
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

        $results = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($results, true);
        
        session(['order_ref' => $results['order']['ref']]);
        $ref = trim($results['order']['ref']);
        $url = trim($results['order']['url']);
        if (empty($ref) || empty($url)) {
            # Failed to create order
            return redirect()->route('front.checkout', app()->getLocale());
        }

        return redirect($url);
    }


    public function success()
    {
        $request = (object) session('request');
        $order = session('temporder');

        $order = Order::find($order->id);

        $order->update([
            'payment_status' => 'Completed',
            'status' => 'completed',
            'order_completed' => 1
        ]);

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

        session()->forget(['request', 'order_ref']);

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

        session()->forget(['request', 'order_ref']);

        $language = Language::select('sign')->find(session('language'));

        return redirect()->route('front.checkout',  $language->sign);
    }

    public function declined()
    {
        $order = session('temporder');
        $order = Order::find($order->id);

        $order->update([
            'payment_status' => 'Failure',
            'status' => 'declined',
            'order_completed' => 1
        ]);

        session()->forget(['request', 'order_ref']);

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
