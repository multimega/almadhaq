<?php

namespace App\Http\Controllers\Api;

use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Subscribe;
use App\Models\Product;
use App\Models\Currency;
use App\Models\PaymentGateway;
use App\Models\Generalsetting;
use Carbon\Carbon;
use App\Models\Shipment;
use App\Models\ShipmentPrice;
use App\Models\OrderTrack;
use App\Models\Piece;
use App\Models\Propiece;
use App\Models\Profree;
use App\Models\Coupon;
use App\Models\Free;
use App\Models\Referral;
use App\Models\Zone;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\Notification;
use App\Models\VendorOrder;
use Validator;
use DB;
use App\Models\Color;


class OrderController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function orders()
    {

        $orders = Order::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
        // $orders['order_details'] = Order::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        foreach ($orders as $k => $o) {
            $o['shipmentmethod'] = shipment::where('id', '=', $o->shipment_id)->first();
            $o['paymentmethod'] = PaymentGateway::where('id', '=', $o->pay_id)->first();
            $o['orderstatus'] = OrderTrack::where('order_id', '=', $o->id)->get();

            $cart =  unserialize(bzdecompress(utf8_decode($o->cart)));
            $o['cart'] =  array($cart->items);
        }
        return response()->json(array('status' => 'Ok', 'orders' => $orders));
    }
    public function ordersp()
    {

        $orders = Order::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        // $orders['order_details'] = Order::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        foreach ($orders as $k => $o) {
            $o['shipmentmethod'] = shipment::where('id', '=', $o->shipment_id)->first();
            $o['paymentmethod'] = PaymentGateway::where('id', '=', $o->pay_id)->first();
            $o['orderstatus'] = OrderTrack::where('order_id', '=', $o->id)->get();

            $cart =  unserialize(bzdecompress(utf8_decode($o->cart)));
            $o['cart'] =  array($cart->items);
        }
        return response()->json(array('status' => 'Ok', 'orders' => $orders));
    }
    public function subscribes()
    {
        $user = Auth::user();
        $orders = Subscribe::where('user_id', '=', $user->id)->orderBy('id', 'desc')->get();
        $now = Carbon::now()->addDays(5);
        return response()->json(array('status' => 'Ok', 'user' => $user, 'orders' => $orders, 'now' => $now));
    }

    public function subscribe($id)
    {
        $user = Auth::user();
        $subscribe = Subscribe::findOrfail($id);
        $order = Order::find($subscribe->order_id);
        $pro = Product::find($subscribe->product_id);

        return response()->json(array('status' => 'Ok', 'user' => $user, 'orders' => $orders, 'cart' => $cart, 'subscribe' => $subscribe, 'pro' => $pro));
    }

    public function ordertrack()
    {
        $user = Auth::user();
        return response()->json(array('status' => 'Ok', 'user' => $user));
    }

    public function trackload($id)
    {
        $order = Order::where('order_number', '=', $id)->first();
        $orderstatus = OrderTrack::where('order_id', '=', $order->id)->get();
        $datas = array('Pending', 'Processing', 'On Delivery', 'Completed');
        return response()->json(array('status' => 'Ok', 'datas' => $datas, 'orderstatus' => $orderstatus));
    }


    public function order($id)
    {
        $user = Auth::user();
        $order = Order::findOrfail($id);
        $order['pay_amount'] = round($order->pay_amount, 2);
        $order['shipmentmethod'] = shipment::where('id', '=', $order->shipment_id)->first();
        $order['paymentmethod'] = PaymentGateway::where('id', '=', $order->pay_id)->first();
        $order['orderstatus'] = OrderTrack::where('order_id', '=', $order->id)->get();
        $cart =  unserialize(bzdecompress(utf8_decode($order->cart)));
        $string = json_encode($cart->items);
        //     = implode(" ",$cart->items);
        $strings = substr($string, 1, -1);
        //   $order['cart'] = array_pop(array_shift(array($strings))) ;
        $order['cart'] = array($cart->items);




        return response()->json(array('status' => 'Ok', 'user' => $user, 'order' => $order));
    }

    public function shipment()
    {

        $shipment = Shipment::get();


        return response()->json(array('status' => 'Ok', 'shipment' => $shipment));
    }

    public function shipments(Request $request)
    {
        $address =  $request['address_id'];
        $shipments =  $request['shipment_id'];
        $products = $request['products_id'];

        $products_qu = $request['products_qu'];



        $curr = Currency::find(auth()->user()->currency);
        if (!$curr) {
            $curr = Currency::where('is_default', 1)->first();
        }
        $weights = 0;

        if (isset($request['products_id']) && is_array($products)) {
            foreach ($products as $i => $ob) {
                $pro = Product::find($ob);
                if (empty($pro)) {

                    return response()->json(array('status' => 'false', 'message' => "this products not found"));
                } else {

                    $gs = Generalsetting::find(1);
                    $x = $products_qu[$i];

                    if ($address) {

                        $addressdata = Address::find($address);
                        $zone = Zone::Where(function ($query) use ($addressdata) {
                            $query->where('name', $addressdata->city)->orwhere('name_ar', $addressdata->city);
                        })->where('zone_id', '!=', null)->first();



                        if (empty($zone)) {
                            return response()->json(array('status' => 'false', 'message' => "this Address not found in Shipping"));
                        }
                        /*   $ship_zone = ShipmentZone::find($zone->zone_id);
                       if(empty($ship_zone)){
                          return response()->json(array('status' => 'false', 'message' =>"this Address not found in zone"));
                      }*/

                        $shippment_avaliable = ShipmentPrice::where('to', $zone->zone_id)->pluck('shipment_id');
                        if (empty($shippment_avaliable)) {
                            return response()->json(array('status' => 'false', 'message' => "this Address not found in zone"));
                        }
                        $shipmentss = Shipment::whereIn('id', $shippment_avaliable)->get();



                        if ($pro->measure == "Gram") {
                            $weights += ($pro->scale / 1000) * $x;
                        } else {

                            $weights += $pro->scale * $x;
                        }
                    }
                }
            }

            $shippment_prices = ShipmentPrice::select('value', 'extra', 'shipment_id')->where('to', $zone->zone_id)->get();


            if (count($shippment_prices) < 0) {
                return response()->json(array('status' => 'false', 'shipment' => "no shipment to this address"));
            } else {

                foreach ($shippment_prices as $shippment_price) {

                    $shipment = Shipment::where('id', $shippment_price->shipment_id)->first();
                    if (!empty($we)) {

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
                            $this->shipping_price += (($shipment->shipping_tax / 100) * $this->shipping_price);
                            $this->shipping_tax = $shipment->shipping_tax;
                        }
                    } else {

                        $shippingvalue = round(($weights - 1)) * ($shippment_price->extra * $curr->value);
                        $t = $shippingvalue + (1 * ($shippment_price->value * $curr->value));
                        $this->shipping_price += $t;
                        $this->shipping_price += (($shipment->shipping_tax / 100) * $this->shipping_price);
                        $this->shipping_tax = $shipment->shipping_tax;
                    }


                    $shippment_price['id'] = $shipment->id;
                    $shippment_price['name'] = $shipment->name;
                    $shippment_price['name_ar'] = $shipment->name_ar;
                    $shippment_price['desc'] = $shipment->desc;
                    $shippment_price['desc_ar'] = $shipment->desc_ar;
                    $shippment_price['phone'] = $shipment->phone;
                    $shippment_price['photo'] = $shipment->photo;
                    $shippment_price['shipping_price'] = round($this->shipping_price, 2);
                    $shippment_price['currency'] = $curr->value;
                    $shippment_price['currency_sign'] = $curr->sign;
                    $shippment_price['currency_ar'] = $curr->name_ar;
                    $shippment_price['shipping_tax'] = $this->shipping_tax;
                }
            }
        }

        return response()->json(array('status' => 'Ok', 'shipment' => $addressdata, 'shipments' => $shipmentss, 'shipments_prices' => $shippment_prices));
    }
    public function payment($id)
    {

        $address = Address::where('id', $id)->where('country', 'Iraq')->first();

        /*    if(!empty($address)){
         
        
       }else{
          $shipment = PaymentGateway::where('status',1)->find([6]); 
       }
        */
        $shipment = PaymentGateway::where('status', 1)->get();

        return response()->json(array('status' => 'Ok', 'payment' => $shipment));
    }

    // public function orderdownload($slug,$id)
    // {
    //     $user = Auth::guard('web')->user();
    //     $order = Order::where('order_number','=',$slug)->first();
    //     $prod = Product::findOrFail($id);
    //     if(!isset($order) || $prod->type == 'Physical' || $order->user_id != $user->id)
    //     {
    //         return redirect()->back();
    //     }
    //     return response()->download(public_path('assets/files/'.$prod->file));
    // }

    // public function orderprint($id)
    // {
    //     $user = Auth::guard('web')->user();
    //     $order = Order::findOrfail($id);
    //     $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
    //     return view('user.order.print',compact('user','order','cart'));
    // }

    public function trans()
    {
        $id = $_GET['id'];
        $trans = $_GET['tin'];
        $order = Order::findOrFail($id);
        $order->txnid = $trans;
        $order->update();
        $data = $order->txnid;
        return response()->json($data);
    }


    protected $total_price = 0, $sales_tax = 0, $discount = 0, $payment_price = 0, $shipping_price = 0, $shipping_tax = 0, $totalQty = 0;

    public function makeorder(Request  $request)
    {
        Session::forget('cart');
        $gs = Generalsetting::find(1);

        $cur = Currency::find(auth()->user()->currency);
        if (!$cur) {
            $cur = Currency::where('is_default', 1)->first();
        }


        $price = 0;
        $wl = 0;
        $prics = 0;
        $weights = 0;
        $product_js = $request['products_id'];
        $products = $product_js;
        $products_size = $request['products_size'];
        $products_qu = $request['products_qu'];
        $products_color = $request['products_color'];
        $keyss =  $request['keys'];
        $prices =  $request['prices'];
        $valuess = $request['values'];


        /* $keys = $keys == "" ? '' :implode(',',$keys);
        $values = $values == "" ? '' : implode(',',$values );*/

        if (isset($request['products_id']) && is_array($products)) {

            foreach ($products as $i => $ob) {
                $pro = Product::find($ob);
                if (empty($pro)) {
                    return response()->json(array('status' => 'false', 'message' => "this products not found"));
                } else {


                    $pric = $pro->mobile_price / $cur->value;
                    if (!empty($keyss[$i])) {
                        $keys = [];
                        foreach ($keyss[$i]  as $k) {
                            $keys[] = $k;
                        }
                    } else {
                        $keys = "";
                    }
                    $keys = $keys == "" ? '' : implode(',', $keys);

                    if (!empty($valuess[$i])) {
                        $values = [];
                        foreach ($valuess[$i]  as $k) {
                            $values[] = $k;
                        }
                    } else {
                        $values = "";
                    }
                    $values = $values == "" ? '' : implode(',', $values);

                    $validator = Validator::make($request->all(), [
                        //'user_id' => 'required',
                        'shipment_id' => 'required',
                        'payment_method' => 'required',
                        'address_id' => 'required',

                    ]);
                    if (!empty($prices)) {
                        foreach ($prices[$i] as $data) {
                            $pro->mobile_price += ($data / $cur->value);
                        }
                    }
                    if (!$validator->passes()) {
                        $messages = $validator->errors();
                        return response()->json(array('status' => 'false', 'message' => $messages->all()));
                    }
                    $this->totalQty +=  $products_qu[$i];
                    $x = $products_qu[$i];

                    $prics += $pric * $x;
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new Cart($oldCart);
                    $size_price = 0;
                    if (!empty($products_color[$i]) && !empty($products_size[$i])) {

                        $pro_size = Color::where('product_id', $pro->id)->where('size', $products_size[$i])->where('colors', $products_color[$i])->first();
                    } elseif (!empty($products_size[$i])) {
                        $pro_size = Color::where('product_id', $pro->id)->where('size', $products_size[$i])->first();
                    } elseif (!empty($products_color[$i])) {

                        $pro_size = Color::where('product_id', $pro->id)->where('colors', $products_color[$i])->first();
                    }

                    if (!empty($pro->size_price)) {
                        foreach ($pro->size as $k => $s) {
                            if ($s == $products_size[$i]) {

                                $size_price =  round($pro->size_price[$k] * $cur->value, 2);
                            }
                        }
                    } elseif (!empty($pro_size)) {

                        $size_price =  $pro_size->size_price;
                    }
                    $color = !empty($products_color[$i]) ? str_replace('#', '', $products_color[$i]) : "";
                    $size = !empty($products_size[$i]) ? $products_size[$i] : "";

                    $cart->addmob($pro, $pro->id, $products_qu[$i], $size, $color, "", $size_price, 0, $keys, $values);
                    $cart->totalPrice = 0;
                    foreach ($cart->items as $data)
                        $cart->totalPrice += $data['price'];

                    Session::put('cart', $cart);

                    if ($request->address_id) {

                        $addressdata = Address::find($request->address_id);

                        $city  =  $addressdata->city;
                        $country =  $addressdata->country;
                        $address = $addressdata->address;
                        $address_phone = $addressdata->phone;
                    }

                    $gs = Generalsetting::find(1);
                    $shipment = Shipment::where('id', $request->shipment_id)->first();

                    $zone = Zone::where('name', $city)->first();
                    if (empty($zone)) {
                        return response()->json(array('status' => 'false', 'message' => "no address in zone"));
                    }





                    if ($pro->measure == "Gram") {
                        $weights += ($pro->scale / 1000) * $x;
                    } else {

                        $weights += $pro->scale * $x;
                    }
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment_id)->where('to', $zone->zone_id)->first();




                    //if($request->user_id){



                }
            }
            if (empty($shippment_price)) {
                $shipping_price = 0;
            } else {

                $shippingvalue = round(($weights - 1)) * $shippment_price->extra;
                $t = $shippingvalue + (1 * $shippment_price->value);
                $this->shipping_price += $t;
                $this->shipping_price += (($shipment->shipping_tax / 100) * $this->shipping_price);
                $this->shipping_tax = $shipment->shipping_tax;
            }

            $price += $prics;
            $price += (($gs->tax / 100) * $prics);
            $this->sales_tax = ($gs->tax / 100) * $prics;




            if ($request->payment_method) {

                $paymentprice = PaymentGateway::where('id', $request->payment_method)->first();
                $this->payment_price = 0;
            }
            $this->total_price = $price +  $this->shipping_price + $this->payment_price;



            $addressdata  = User::find(Auth::user()->id);
            $name =  $addressdata->name;
            $phone =  $addressdata->phone;
            if (!empty($addressdata->email)) {
                $email = $addressdata->email;
            } else {
                $email = 0;
            }
            $wl = Auth::user()->refunds;
            if ($addressdata->wallet_status == 1) {
                if (Auth::user()->refunds != 0) {
                    $this->total_price -=  (Auth::user()->refunds / $cur->value);
                }

                if ($this->total_price < 0 || $this->total_price == 0) {
                    Auth::user()->refunds -=   (($cur->value * $price) +  $this->shipping_price + $this->payment_price);
                    Auth::user()->update();
                    $this->total_price = 0;
                } else {

                    Auth::user()->refunds = 0;
                    Auth::user()->update();
                }
            }
            $code = $request->coupon;

            if (!empty($request->coupon)) {


                $fnd = Coupon::where('code', '=', $code)->where('status', 1)->first();

                $fr = Free::where('code', '=', $code)->where('status', 1)->first();
                $pi = Piece::where('code', '=', $code)->where('status', 1)->first();

                if (!empty($fnd)) {
                    $coupon = $fnd;
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;

                    $cart = new Cart($oldCart);
                    if ($coupon->type == 0) {





                        $tot = $this->total_price - $this->shipping_price;

                        $val =  $coupon->price / 100;
                        $sub = $val * $tot;
                        $this->total_price =  $this->total_price - $sub;

                        $coupon_discount = round($sub, 2);
                    } else {

                        $this->total_price = $this->total_price - round($coupon->price * $cur->value, 2);
                        $coupon_discount = round($coupon->price * $cur->value, 2);
                    }
                } elseif (!empty($fr)) {

                    $coupon = Free::where('code', '=', $code)->first();
                    $free = Profree::where('code_id', '=', $coupon->id)->first();

                    $coupon_discount = 0;
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;

                    $cart = new Cart($oldCart);

                    foreach ($cart->items as $item) {
                        if ($item['item']['id'] == $free->product_id) {
                            $this->total_price = $this->total_price - $item['item']['price'];
                            break;
                        }
                    }
                } elseif (!empty($pi)) {


                    $coupon = Piece::where('code', '=', $code)->first();
                    $piece = Propiece::where('code_id', '=', $coupon->id)->first();
                    $coupon_discount = 0;

                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;

                    $cart = new Cart($oldCart);

                    foreach ($cart->items as $key => $prod) {
                        if ($prod['item']['id'] ==  $piece->product_id && $prod['qty'] >= $coupon->buy) {
                            $itemid = $prod['item']['id'] . $prod['size'] . $prod['color'];

                            $cart->items[$itemid]['qty'] += $coupon->take;
                            $cart->totalQty += $coupon->take;

                            Session::put('cart', $cart);
                            break;
                        }
                    }
                }
            }





            $order = new Order();
            $item_name = $gs->title . " Order";
            $item_number = str_random(4) . time();
            $order->customer_name   = $name;
            $order->customer_phone      = !empty($address_phone)  ? $address_phone : $phone;

            $order->customer_address      = $address;

            $order->customer_city        =  $city;
            $order->currency_sign    =  $cur->sign;
            $order->currency_value    =  $cur->value;
            $order->customer_country     =  $country;
            $order->user_id   =  Auth::user()->id;
            $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
            $order['payment_status'] = "Pending";
            $order['totalQty'] = $this->totalQty;
            $order['order_completed'] = 1;
            // $order['order_number'] = str_random(4).time();
            $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();


            if ($last_row->order_number == 0) {
                $order['order_number'] = 1;
            } else {

                $order['order_number'] = $last_row->order_number + 1;
            }
            $order['coupon_code'] = !empty($code) ? $code : null;
            $order['coupon_discount'] = !empty($coupon_discount) ? $coupon_discount : 0;
            $order['wallet'] = $addressdata->wallet_status == 1 ? $wl : 0;
            $order->shipment_id  = $request->input('shipment_id');

            $order->pay_amount  = round($this->total_price, 2);

            $order->shipping = 'shipto';

            $order->method =  $paymentprice->title;

            $order->shipping_price = $this->shipping_price;
            $order->shipping_tax = $this->shipping_tax;
            $order->tax = $this->sales_tax;


            $order->save();

            if ($order) {
                $track = new OrderTrack;
                $track->title = 'Pending';
                $track->text = 'You have successfully placed your order.';
                $track->order_id = $order->id;
                $track->save();

                $notification = new Notification;
                $notification->order_id = $order->id;
                $notification->save();
                //  $addressdata->points += $cur->value * $this->total_price;
                $addressdata->points += ($gs->points * round($cart->totalPrice / $cur->value));
                $addressdata->save();

                if (!empty($request->coupon)) {
                    $coupon = Coupon::where('code', $request->coupon)->where('status', 1)->first();
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

                    $coupon1 = Free::where('code', $request->coupon)->where('status', 1)->first();
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





                    /* Take One Free */

                    $coupon3 = Piece::where('code', $request->coupon)->where('status', 1)->first();
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



                Session::forget('cart');

                Session::forget('already');
                Session::forget('coupon');
                Session::forget('coupon_id');
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
                    $msg = "Hello " . $name . "!<br> You have placed a new order.<br>Your order number is " . $order->order_number . ".Please wait for your delivery. <br>Thank you.";
                    $msgs = '<html><body>';
                    $msgs = '<table rules="all" style="border-color: #666;" cellpadding="10">';
                    $msgs = $msg;
                    $msgs .= "</table>";
                    $msgs .= "</body></html>";
                    $data = [
                        'to' => $email,
                        'subject' => "Your Order Placed!!",
                        'body' => $msgs,
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                } else {
                    $to = $email;
                    $subject = "Your Order Placed!!";
                    $msg = "Hello " . $name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
                    $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                    mail($to, $subject, $msg, $headers);
                }
                //Sending Email To Admin
                if ($gs->is_smtp == 1) {
                    $msg = "Hello Admin!<br> Your store has recieved a new order. <br> Order Number is " . $order->order_number . " <br> Customer name : " . $order->customer_name . "<br>Customer Email : " .
                        $order->customer_email . "<br>Customer phone : " . $order->customer_phone . "<br> Please login to your panel to check. <br>Thank you.";
                    $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                    $data = [
                        'to' => $gs->email,
                        'subject' => "New Order Recieved!!",
                        'body' => $msg,
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                } else {
                    $to = $gs->email;
                    $subject = "New Order Recieved!!";
                    $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is " . $order->order_number . "\nCustomer name : " . $order->customer_name . "\nCustomer Email : " .
                        $order->customer_email . "\nCustomer phone : " . $order->customer_phone . "\nPlease login to your panel to check. \nThank you.";
                    $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                    mail($to, $subject, $msg, $headers);
                }
                $for_erp = Order::with('user', 'shipment')->where('id', $order->id)->first();

                $data =  $this->erporder($for_erp);


                return response()->json(array(
                    'status' => 'true',
                    'message' => "Your Orders Submited Successfully",
                    'id' => $order->id
                ));
            } else {
                return response()->json(array('status' => 'false', 'message' => "Sorry ! your order Weight can't shiped )"));
            }
        }
        return response()->json(array('status' => 'false', 'message' => "there are no products"));
    }

    public function test(Request  $request)
    {

        $gs = Generalsetting::find(1);

        $cur = Currency::find(auth()->user()->currency);


        $price = 0;
        $weights = 0;
        $product_js = $request['products_id'];
        $products = $product_js;
        $products_size = $request['products_size'];
        $products_qu = $request['products_qu'];
        $products_color = $request['products_color'];
        $keyss =  $request['keys'];
        $prices =  $request['prices'];
        $values = $request['values'];



        if (isset($request['products_id']) && is_array($products)) {

            foreach ($products as $i => $ob) {
                $pro = Product::find($ob);
                if (empty($pro)) {
                    return response()->json(array('status' => 'false', 'message' => "this products not found"));
                } else {
                    if (!empty($keyss[$i])) {
                        $keys = [];
                        foreach ($keyss[$i]  as $k) {
                            $keys[] = $k;
                        }
                    } else {
                        $keys = "";
                    }
                    $keys = $keys == "" ? '' : implode(',', $keys);
                    return response()->json(array('status' => 'false', 'message' => $keys));
                    // 
                    //  $values[$i] = $values == "" ? '' : implode(',',$values );
                    $validator = Validator::make($request->all(), [
                        //'user_id' => 'required',
                        'shipment_id' => 'required',
                        'payment_method' => 'required',
                        'address_id' => 'required',

                    ]);
                    if (!empty($prices[$i])) {
                        foreach ($prices[$i] as $data) {
                            $pro->mobile_price += ($data / $cur->value);
                        }
                    }
                    if (!$validator->passes()) {
                        $messages = $validator->errors();
                        return response()->json(array('status' => 'false', 'message' => $messages->all()));
                    }
                    $this->totalQty +=  $products_qu[$i];
                    $x = $products_qu[$i];
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new Cart($oldCart);
                    $size_price = 0;

                    $pro_size = Color::where('product_id', $pro->id)->where('size', $products_size[$i])->where('colors', $products_color[$i])->first();
                    if (!empty($pro->size_price)) {
                        foreach ($pro->size as $k => $s) {
                            if ($s == $products_size[$i]) {

                                $size_price =  round($pro->size_price[$k] * $cur->value, 2);
                            }
                        }
                    } elseif (!empty($pro_size)) {

                        $size_price =  $pro_size->size_price;
                    }

                    $cart->addmob($pro, $pro->id, $products_qu[$i], $products_size[$i], str_replace('#', '', $products_color[$i]), "", $size_price, 0, $keys[$i], $values[$i]);
                    $cart->totalPrice = 0;
                    foreach ($cart->items as $data)
                        $cart->totalPrice += $data['price'];

                    Session::put('cart', $cart);

                    if ($request->address_id) {

                        $addressdata = Address::find($request->address_id);

                        $city  =  $addressdata->city;
                        $country =  $addressdata->country;
                        $address = $addressdata->address;
                    }

                    $gs = Generalsetting::find(1);
                    $shipment = Shipment::where('id', $request->shipment_id)->first();

                    $zone = Zone::where('name', $city)->first();
                    if (empty($zone)) {
                        return response()->json(array('status' => 'false', 'message' => "no address in zone"));
                    }

                    if (!empty($pro)) {


                        $weights += $pro->scale * $x;
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment_id)->where('to', $zone->zone_id)->first();
                        if (empty($shippment_price)) {
                            $shipping_price = 0;
                        } else {

                            $shippingvalue = round(($weights - 1)) * $shippment_price->extra;
                            $t = $shippingvalue + (1 * $shippment_price->value);
                            $this->shipping_price += $t;
                            $this->shipping_price += ($shipment->shipping_tax / 100 * $this->shipping_price);
                            $this->shipping_tax = $shipment->shipping_tax;
                        }

                        $price += ($pro->mobile_price / $cur->value) *  $x;
                        $price += ($gs->tax / 100 * $price);
                        $this->sales_tax = $gs->tax / 100 * $price;
                    }


                    if ($request->payment_method) {

                        $paymentprice = PaymentGateway::where('id', $request->payment_method)->first();
                        $this->payment_price = 0;
                    }
                    $this->total_price = $price +  $this->shipping_price + $this->payment_price;





                    //if($request->user_id){

                    $addressdata  = User::find(Auth::user()->id);
                    $name =  $addressdata->name;
                    $phone =  $addressdata->phone;
                    if (!empty($addressdata->email)) {
                        $email = $addressdata->email;
                    } else {
                        $email = 0;
                    }

                    if (Auth::user()->refunds != 0) {
                        $this->total_price -=  (Auth::user()->refunds / $cur->value);
                    }





                    return response()->json(array('status' => 'false', 'message' => $keys));
                }
            }
        }
        return response()->json(array('status' => 'false', 'message' => "there are no products"));
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
