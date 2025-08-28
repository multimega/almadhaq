<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\Admin;
use App\Models\Profree;
use App\Models\Piece;
use App\Models\Propiece;
use App\Models\Shipment;
use App\Models\ShipmentPrice;
use App\Models\Generalsetting;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorOrder;
use App\Models\UserNotification;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;


class PaymentController extends Controller
{
    /* 
        to follow clean code and solid principles rules don't forget to make a single class for Fawry and every payment method
    */

    private const FAWRYHOSTTRUSTED  = 'https://atfawry.fawrystaging.com/';
    private const FAWRYPYMENTSTATUS = ['PAID' => 'Paid', 'UNPAID' => 'Pending'];
    private const STATUSCODESUCCESS = 200;

    protected  $shipping_price = 0, $shipping_tax = 0;

    public function store(Request $request)
    {


        if ($request->pass_check) {
            $users = User::where('email', '=', $request->personal_email)->get();
            if (count($users) == 0) {
                if ($request->personal_pass == $request->personal_confirm) {
                    $user = new User;
                    $user->name = $request->personal_name;
                    $user->email = $request->personal_email;
                    $user->password = bcrypt($request->personal_pass);
                    $token = md5(time() . $request->personal_name . $request->personal_email);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($request->name . $request->email);
                    $user->emai_verified = 'Yes';
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
            return redirect()->route('front.cart')->with('success', "You don't have any product to checkout.");
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
            $weights += $pro['scale'] * $prod['qty'];
            if ($pro->user_id == 0) {
                if (!$request->diff_address) {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('from', $admin->city)->where('to', $request->city)->first();
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('from', $admin->city)->where('to', $request->shipping_city)->first();
                }
            } else {
                if (!$request->diff_address) {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('from', $pro->user->city)->where('to', $request->city)->first();
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('from', $pro->user->city)->where('to', $request->shipping_city)->first();
                }
            }
            if (count($shippment_price) < 1) {
                $shipping_price = 0;
                $shipping_tax  = 0;
            } else {
                if ($pro['measure'] == "Gram") {
                    $we = (($weights / 1000) - 1);
                    if ($we < 0) {

                        $shippingvalue = (1 - 1) * ($shippment_price->extra * $curr->value);
                        $t = $shippingvalue + (1 * ($shippment_price->value * $curr->value));
                        $this->shipping_price += $t;
                        $this->shipping_price += ($shipment->shipping_tax / 100 * $this->shipping_price);
                        $this->shipping_tax = $shipment->shipping_tax;
                    } else {

                        $shippingvalue = round($we) * ($shippment_price->extra * $curr->value);
                        $t = $shippingvalue + (1 * ($shippment_price->value * $curr->value));
                        $this->shipping_price += $t;
                        $this->shipping_price += ($shipment->shipping_tax / 100 * $this->shipping_price);
                        $this->shipping_tax = $shipment->shipping_tax;
                    }
                } else {

                    $shippingvalue = round(($weights - 1)) * ($shippment_price->extra * $curr->value);
                    $t = $shippingvalue + (1 * ($shippment_price->value * $curr->value));
                    $this->shipping_price += $t;
                    $this->shipping_price += ($shipment->shipping_tax / 100 * $this->shipping_price);
                    $this->shipping_tax = $shipment->shipping_tax;
                }
            }

            if (Session::has('coupon_get')) {
                $take = Session::get('coupon_take');
                if ($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get')) {

                    $prod['qty'] += $take;
                    $cart->udate();
                    $prod->udate();
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
        $order = new Order;
        $success_url = action('Front\PaymentController@paymemt');
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total + $this->shipping_price)  / $curr->value, 2);
        $order['method'] = $request->method;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['order_completed'] = 1;
        $order['shipment_id'] = $request->shipment;
        $order['shipping_price'] = $this->shipping_price;
        $order['shipping_tax'] = $this->shipping_tax;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = $request->phone;
        $order['order_number'] = str_random(4) . time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        $order['customer_zip'] = $request->zip;
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
        if ($request->wallet_cost && $request->wallet_cost > 0) {
            $user = User::find($request->user_id);
            $user->refunds -= $request->wallet_cost / $curr->value;
            $user->points += round($request->total / $curr->value);
            $user->update();
        }
        $order['dp'] = $request->dp;
        $order['payment_status'] = "Pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;
        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;

        if (Session::has('affilate')) {
            $val = $request->total / 100;
            $sub = $val * $gs->affilate_charge;
            $user = User::findOrFail(Session::get('affilate'));
            $user->affilate_income += $sub;
            $user->update();
            $order['affilate_user'] = $user->name;
            $order['affilate_charge'] = $sub;
        }
        $order->save();
        $track = new OrderTrack;
        $track->title = 'Pending';
        $track->text = 'You have successfully placed your order.';
        $track->order_id = $order->id;
        $track->save();

        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();
        if ($request->coupon_id != "") {
            $coupon = Coupon::findOrFail($request->coupon_id);
            $coupon->used++;
            if ($coupon->times != null) {
                $i = (int)$coupon->times;
                $i--;
                $coupon->times = (string)$i;
            }
            $coupon->update();

            /* Free Product */
            $coupon1 = Free::findOrFail($request->coupon_id);
            $coupon1->used++;
            if ($coupon1->times != null) {
                $i = (int)$coupon1->times;
                $i--;
                $coupon1->times = (string)$i;
            }
            $coupon1->update();

            /*  Referral  */

            $coupon2 = Referral::findOrFail($request->coupon_id);
            $coupon2->used++;
            if ($coupon2->times != null) {
                $i = (int)$coupon2->times;
                $i--;
                $coupon2->times = (string)$i;
            }
            $coupon2->update();

            /* Take One Free */

            $coupon3 = Piece::findOrFail($request->coupon_id);
            $coupon3->used++;
            if ($coupon3->times != null) {
                $i = (int)$coupon3->times;
                $i--;
                $coupon3->times = (string)$i;
            }
            $coupon3->update();
        }

        foreach ($cart->items as $prod) {
            $x = (string)$prod['size_qty'];
            if (!empty($x)) {
                $product = Product::findOrFail($prod['item']['id']);
                $x = (int)$x;
                $x = $x - $prod['qty'];
                $temp = $product->size_qty;
                $temp[$prod['size_key']] = $x;
                $temp1 = implode(',', $temp);
                $product->size_qty =  $temp1;
                $product->update();
            }
        }


        foreach ($cart->items as $prod) {
            $x = (string)$prod['stock'];
            if ($x != null) {

                $product = Product::findOrFail($prod['item']['id']);
                $product->stock =  $prod['stock'];
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('coupon_percentage');
        Session::forget('coupon_product');
        Session::forget('coupon_free');
        Session::forget('coupon_free_color');
        Session::forget('coupon_free_size');

        Session::forget('coupon_piece');
        Session::forget('coupon_piece_color');
        Session::forget('coupon_piece_size');
        Session::forget('coupon_pro');

        if ($gs->is_smtp == 1) {
            $data = [
                'to' => $request->email,
                'type' => "new_order",
                'cname' => $request->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
                'onumber' => $order->order_number,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoOrderMail($data, $order->id);
        } else {
            $to = $request->email;
            $subject = "Your Order Placed!!";
            $msg = "Hello " . $request->name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
        }
        //Sending Email To Admin
        if ($gs->is_smtp == 1) {
            $data = [
                'to' => $gs->email,
                'subject' => "New Order Recieved!!",
                'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ".Please login to your panel to check. <br>Thank you.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        } else {
            $to = $gs->email;
            $subject = "New Order Recieved!!";
            $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is " . $order->order_number . ".Please login to your panel to check. \nThank you.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
        }
    }

    public function paycancle()
    {
        $this->code_image();
        return redirect()->back()->with('unsuccess', 'Payment Cancelled.');
    }

    public function payreturn()
    {

        $this->code_image();
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }
        
        return view('front.success', compact('tempcart', 'order'));
            


    }
    


    
    public function bankmasr()
    {



        $this->code_image();
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }

        return view('front.creditcard', compact('tempcart', 'order'));
    }
    public function Nbe_Payment()
    {


        $gs = GeneralSetting::find(1);
        $this->code_image();
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }



        $client = new Client();
        $username = $gs->name_nbe;
        $password = $gs->password_nbe;
        $merchantid = $gs->merchant_id_nbe;


        $credentials = base64_encode("$username:$password");

        $response = $client->post(
            'https://nbe.gateway.mastercard.com/api/rest/version/57/merchant/' . $merchantid . '/session',

            [
                'headers' => [
                    'Authorization' => 'Basic ' . $credentials,
                ],
            ]
        );

        $items = json_decode($response->getBody(), true);

        return view('front.nbe', compact('tempcart', 'order', 'items'));
    }


    public function fawry_paymentz()
    {


        $this->code_image();
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }
        $description  = 'payment some products';
        $merchantCode = 'siYxylRjSPwdWepImXk/pw==';
        $merchantRefNum = $order->id;
        $customerProfileId  = $order->user_id;
        $returnUrl = route('fawry.payment.status');
        $itemId = $order->id;
        $quantity = $order->totalQty;
        $paymentPrice = number_format($order->pay_amount, 2, '.', '');
        $secure_key = '8f86508c5c084b678a2e46960ebc854c';
        $hash = hash('sha256', $merchantCode . $merchantRefNum . $customerProfileId . $returnUrl . $itemId . $quantity . $paymentPrice . $secure_key);
        return view('front.fawry_status', compact('tempcart', 'order', 'hash', 'description', 'merchantCode', 'merchantRefNum', 'customerProfileId', 'returnUrl', 'itemId', 'quantity', 'paymentPrice', 'secure_key'));
    }

    public function checkPaymentFawry(Request $request)
    {
        if ($request->header('referer') === self::FAWRYHOSTTRUSTED && $request->statusCode == self::STATUSCODESUCCESS) {
            Order::findOrFail($request->merchantRefNumber)->update(['payment_status' => self::FAWRYPYMENTSTATUS[$request->orderStatus]]);
            session()->flash('success', 'operation accomplished successfully');
            if (auth()->guard('web')->user()) {
                return redirect()->route('user-orders');
            }
            return redirect()->route('front.index', ['lang' => getLang()]);
        }

        session()->flash('error', 'Sorry, there was an error, try again');
        if (auth()->guard('web')->user()) {
            return redirect()->route('user-orders');
        }
        return redirect()->route('front.index', ['lang' => getLang()]);
    }


    public function accept()
    {


        $this->code_image();
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {

            $tempcart = '';

            return redirect()->back();
        }


        $key2 = session()->get('key2');

        return view('front.accept_paymeent', compact('tempcart', 'order', 'key2'));
    }

    public function vapulus()
    {


        $this->code_image();
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {

            $tempcart = '';

            return redirect()->back();
        }


        return view('front.vapuluspayment', compact('tempcart', 'order'));
    }





    public function getbankmasrapi()
    {

        $gs = GeneralSetting::find(1);
        $client = new Client();
        $credentials = base64_encode('{{$gs->name_api}}:{{$gs->password_api}}');
        $response = $client->post(
            'https://banquemisr.gateway.mastercard.com/api/rest/version/56/merchant/{{$gs->merchant_id}}/session',

            [
                'headers' => [
                    'Authorization' => 'Basic ' . $credentials,
                ],
            ]
        );

        $items = json_decode($response->getBody(), true);
        foreach ($items['session'] as $key => $item) {
            if ($key == 'id') {
                $specificId = $item;
                return  $specificId;
            }
        }
    }



    public function cancel()
    {


        return redirect('cancelpayment');
    }


    public function success(Request $request)
    {

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {


            return redirect('submit');
        }
    }



    public function notify(Request $request)
    {

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        //return $myPost;


        // Read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }

        /*
     * Post IPN data back to PayPal to validate the IPN data is genuine
     * Without this step anyone can fake IPN data
     */
        $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
        $ch = curl_init($paypalURL);
        if ($ch == FALSE) {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
        $res = curl_exec($ch);

        /*
     * Inspect IPN validation result and act accordingly
     * Split response headers and payload, a better way for strcmp
     */
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));
        if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

            $order = Order::where('user_id', $_POST['custom'])
                ->where('order_number', $_POST['item_number'])->first();
            $data['txnid'] = $_POST['txn_id'];
            $data['payment_status'] = $_POST['payment_status'];
            if ($order->dp == 1) {
                $data['status'] = 'completed';
            }
            $order->update($data);
            $notification = new Notification;
            $notification->order_id = $order->id;
            $notification->save();
            Session::forget('cart');
        } else {
            $payment = Order::where('user_id', $_POST['custom'])
                ->where('order_number', $_POST['item_number'])->first();
            VendorOrder::where('order', '=', $payment->id)->delete();
            $payment->delete();

            Session::forget('cart');
        }
    }


    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project', '', base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, 200, 50, $background_color);

        $pixel = imagecolorallocate($image, 0, 0, 255);
        for ($i = 0; $i < 500; $i++) {
            imagesetpixel($image, rand() % 200, rand() % 50, $pixel);
        }

        $font = $actual_path . 'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length - 1)];
        $word = '';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length = 6; // No. of character in image
        for ($i = 0; $i < $cap_length; $i++) {
            $letter = $allowed_letters[rand(0, $length - 1)];
            imagettftext($image, 25, 1, 35 + ($i * 25), 35, $text_color, $font, $letter);
            $word .= $letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for ($i = 0; $i < 500; $i++) {
            imagesetpixel($image, rand() % 200, rand() % 50, $pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path . "assets/images/capcha_code.png");
    }
}
