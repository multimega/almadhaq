<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Coupon;
use App\Models\Free;
use App\Models\Color;

use App\Models\Profree;
use App\Models\Piece;
use App\Models\Propiece;
use App\Models\Referral;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{

    public function cart()
    {
        $this->code_image();
        if (!Session::has('cart')) {
            return view('front.cart');
        }
        if (Session::has('already')) {
            Session::forget('already');
        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        if (Session::has('coupon_total')) {
            Session::forget('coupon_total');
        }
        if (Session::has('coupon_total1')) {
            Session::forget('coupon_total1');
        }
        if (Session::has('coupon_percentage')) {
            Session::forget('coupon_percentage');
        }
        /* free product coupon*/
        if (Session::has('coupon_free')) {
            Session::forget('coupon_free');
        }
        if (Session::has('coupon_pro')) {
            Session::forget('coupon_pro');
        }
        if (Session::has('coupon_free_color')) {
            Session::forget('coupon_free_color');
        }

        if (Session::has('coupon_free_size')) {
            Session::forget('coupon_free_size');
        }
        if (Session::has('coupon_product')) {
            Session::forget('coupon_product');
        }


        $gs = Generalsetting::findOrFail(1);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $mainTotal = $totalPrice;
        $tx = $gs->tax;
        if ($tx != 0) {
            $tax = ($totalPrice / 100) * $tx;
            $mainTotal = $totalPrice + $tax;
        }

        return response()->json(array('status' => 'Ok', 'products' => $products, 'totalPrice' => $totalPrice, 'mainTotal' => $mainTotal, 'tx' => $tx));
    }



    public function addtocart(Request  $request)
    {
        $products = $request->products_id;
        $qty =  $request->qty;
        $size =  $request->size;
        $color =  $request->color;
        $size_qty =  $request->size_qty;
        $size_price = $request->size_price;
        $size_key =  $request->size_key;
        $keys =   $request->keys;
        $values =  $request->values;
        $prices =  $request->prices;

        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        if (isset($request['products_id']) && is_array($products)) {
            foreach ($products as $i => $id) {
                $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'name_ar', 'photo', 'size', 'feature', 'trial_period', 'subscription_period', 'subscription_type', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes']);

                if (empty($prod)) {
                    return response()->json(array('status' => 'false', 'message' => "this products not found"));
                } else {
                    $size_price = ((float)$size_price[$i] / $curr->value);

                    $colors = Color::where('product_id', $id)->where('size', '=', $size[$i])->where('size_qty', '>', 0)->first();
                    $first = Color::where('product_id', $id)->where('size_qty', '>', 0)->first();



                    if ($prod->user_id != 0) {
                        $gs = Generalsetting::findOrFail(1);
                        $prc = $prod->price + $gs->fixed_commission + ($prod->price / 100) * $gs->percentage_commission;
                        $prod->price = round($prc, 2);
                    }
                    if (!empty($prices)) {
                        foreach ($prices as $data) {
                            $prod->price += ($data / $curr->value);
                        }
                    }


                    if (!empty($prod->license_qty)) {
                        $lcheck = 1;
                        foreach ($prod->license_qty as $ttl => $dtl) {
                            if ($dtl < 1) {
                                $lcheck = 0;
                            } else {
                                $lcheck = 1;
                                break;
                            }
                        }
                        if ($lcheck == 0) {
                            return 0;
                        }
                    }
                    if (empty($size[$i])) {
                        if (!empty($prod->size)) {
                            $size = trim($prod->size[0]);
                            $colors = Color::where('product_id', $id)->where('size', '=', $size)->where('size_qty', '>', 0)->first();
                            $size_qty = $colors->size_qty;
                        }
                    }

                    if (empty($color[$i])) {
                        if (!empty($prod->color)) {
                            $color = $prod->color[0];
                        } elseif (!empty($colors)) {
                            $color = $colors->colors;
                            $size_qty = $colors->size_qty;
                        }
                    }
                    $color = str_replace('#', '', $color);
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new Cart($oldCart);
                    $cart->addnum($prod, $prod->id, $qty[$i], $size[$i], $color[$i], $size_qty[$i], $size_price[$i], $size_key, $keys, $values);
                    if ($cart->items[$id . $size[$i] . $color[$i] . str_replace(str_split(' ,'), '', $values[$i])]['dp'] == 1) {
                        return 'digital';
                    }
                    if ($cart->items[$id . $size[$i] . $color[$i] . str_replace(str_split(' ,'), '', $values)]['stock'] < 0) {
                        return response()->json(["status" => 'No have Stock from it']);
                    }
                    if (!empty($cart->items[$id . $size[$i] . $color[$i] . str_replace(str_split(' ,'), '', $values)]['size_qty'])) {
                        if ($cart->items[$id . $size[$i] . $color[$i] . str_replace(str_split(' ,'), '', $values)]['qty'] > $cart->items[$id . $size[$i] . $color[$i] . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
                            return response()->json(["status" => 'No have Stock from it']);
                        }
                    }

                    $cart->totalPrice = 0;
                    foreach ($cart->items as $data)
                        $cart->totalPrice += $data['price'];
                    Session::put('cart', $cart);
                    $data[0] = count($cart->items);
                }
            }

            return response()->json(["items" => $cart->items]);
        }
    }

    public function addbyone()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $id = $_GET['id'];
        $itemid = $_GET['itemid'];
        $size_qty = $_GET['size_qty'];
        $size_price = $_GET['size_price'];
        $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'name_ar', 'photo', 'size', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes']);

        if ($prod->user_id != 0) {
            $gs = Generalsetting::findOrFail(1);
            $prc = $prod->price + $gs->fixed_commission + ($prod->price / 100) * $gs->percentage_commission;
            $prod->price = round($prc, 2);
        }

        if (!empty($prod->attributes)) {
            $attrArr = json_decode($prod->attributes, true);
            $count = count($attrArr);
            $j = 0;
            if (!empty($attrArr)) {
                foreach ($attrArr as $attrKey => $attrVal) {

                    if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                        foreach ($attrVal['values'] as $optionKey => $optionVal) {
                            $prod->price += $attrVal['prices'][$optionKey];
                            break;
                        }
                    }
                }
            }
        }



        if (!empty($prod->license_qty)) {
            $lcheck = 1;
            foreach ($prod->license_qty as $ttl => $dtl) {
                if ($dtl < 1) {
                    $lcheck = 0;
                } else {
                    $lcheck = 1;
                    break;
                }
            }
            if ($lcheck == 0) {
                return 0;
            }
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->adding($prod, $itemid, $size_qty, $size_price);
        if ($cart->items[$itemid]['stock'] < 0) {
            return 0;
        }
        if (!empty($size_qty)) {
            if ($cart->items[$itemid]['qty'] > $cart->items[$itemid]['size_qty']) {
                return 0;
            }
        }
        $cart->totalPrice = 0;
        foreach ($cart->items as $data)
            $cart->totalPrice += $data['price'];
        Session::put('cart', $cart);
        $data[0] = $cart->totalPrice;

        $data[3] = $data[0];
        $tx = $gs->tax;
        if ($tx != 0) {
            $tax = ($data[0] / 100) * $tx;
            $data[3] = $data[0] + $tax;
        }

        $data[1] = $cart->items[$itemid]['qty'];
        $data[2] = $cart->items[$itemid]['price'];
        $data[0] = round($data[0] * $curr->value, 2);
        $data[2] = round($data[2] * $curr->value, 2);
        $data[3] = round($data[3] * $curr->value, 2);
        if ($gs->currency_format == 0) {
            $data[0] = $curr->sign . $data[0];
            $data[2] = $curr->sign . $data[2];
            $data[3] = $curr->sign . $data[3];
        } else {
            $data[0] = $data[0] . $curr->sign;
            $data[2] = $data[2] . $curr->sign;
            $data[3] = $data[3] . $curr->sign;
        }
        return response()->json($data);
    }

    public function reducebyone()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $id = $_GET['id'];
        $itemid = $_GET['itemid'];
        $size_qty = $_GET['size_qty'];
        $size_price = $_GET['size_price'];
        $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'name_ar', 'photo', 'size', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes']);
        if ($prod->user_id != 0) {
            $gs = Generalsetting::findOrFail(1);
            $prc = $prod->price + $gs->fixed_commission + ($prod->price / 100) * $gs->percentage_commission;
            $prod->price = round($prc, 2);
        }


        if (!empty($prod->attributes)) {
            $attrArr = json_decode($prod->attributes, true);
            $count = count($attrArr);
            $j = 0;
            if (!empty($attrArr)) {
                foreach ($attrArr as $attrKey => $attrVal) {

                    if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                        foreach ($attrVal['values'] as $optionKey => $optionVal) {
                            $prod->price += $attrVal['prices'][$optionKey];
                            break;
                        }
                    }
                }
            }
        }


        if (!empty($prod->license_qty)) {
            $lcheck = 1;
            foreach ($prod->license_qty as $ttl => $dtl) {
                if ($dtl < 1) {
                    $lcheck = 0;
                } else {
                    $lcheck = 1;
                    break;
                }
            }
            if ($lcheck == 0) {
                return 0;
            }
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reducing($prod, $itemid, $size_qty, $size_price);
        $cart->totalPrice = 0;
        foreach ($cart->items as $data)
            $cart->totalPrice += $data['price'];

        Session::put('cart', $cart);
        $data[0] = $cart->totalPrice;

        $data[3] = $data[0];
        $tx = $gs->tax;
        if ($tx != 0) {
            $tax = ($data[0] / 100) * $tx;
            $data[3] = $data[0] + $tax;
        }

        $data[1] = $cart->items[$itemid]['qty'];
        $data[2] = $cart->items[$itemid]['price'];
        $data[0] = round($data[0] * $curr->value, 2);
        $data[2] = round($data[2] * $curr->value, 2);
        $data[3] = round($data[3] * $curr->value, 2);
        if ($gs->currency_format == 0) {
            $data[0] = $curr->sign . $data[0];
            $data[2] = $curr->sign . $data[2];
            $data[3] = $curr->sign . $data[3];
        } else {
            $data[0] = $data[0] . $curr->sign;
            $data[2] = $data[2] . $curr->sign;
            $data[3] = $data[3] . $curr->sign;
        }
        return response()->json($data);
    }

    public function upcolor()
    {
        $id = $_GET['id'];
        $color = $_GET['color'];
        $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'name_ar', 'photo', 'size', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes']);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateColor($prod, $id, $color);
        Session::put('cart', $cart);
    }


    public function removecart($id)
    {
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
            $data[0] = $cart->totalPrice;
            $data[3] = $data[0];
            $tx = $gs->tax;
            if ($tx != 0) {
                $tax = ($data[0] / 100) * $tx;
                $data[3] = $data[0] + $tax;
            }

            if ($gs->currency_format == 0) {
                $data[0] = $curr->sign . round($data[0] * $curr->value, 2);
                $data[3] = $curr->sign . round($data[3] * $curr->value, 2);
            } else {
                $data[0] = round($data[0] * $curr->value, 2) . $curr->sign;
                $data[3] = round($data[3] * $curr->value, 2) . $curr->sign;
            }

            $data[1] = count($cart->items);
            return response()->json(["items" => $cart->items]);
        } else {
            Session::forget('cart');
            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');

            $data = 0;
            return response()->json(["status" => "Cart empty"]);
        }
    }
    public function showcart()
    {

        $cart = Session::has('cart') ? Session::get('cart') : null;


        if (count($cart->items) > 0) {

            return response()->json(["items" => $cart->items]);
        } else {
            Session::forget('cart');
            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');

            $data = 0;
            return response()->json(["status" => "Cart empty"]);
        }
    }


    public function couponcheck()
    {
        $gs = Generalsetting::findOrFail(1);
        $code = $_GET['code'];
        $total = $_GET['total'];
        $id = Auth::guard('web')->user()->id;
        /*     $fnd = Coupon::where('code','=',$code)->where('user_id',Auth::guard('web')->user()->id)->get()->count();*/


        $fnd = Coupon::where('status', 1)
            ->where(function ($query) use ($code) {
                $query->where('code', '=', $code);
            })->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get()->count();
        $fr = Free::where('code', '=', $code)->get()->count();
        $pi = Piece::where('code', '=', $code)->get()->count();
        $ref = Referral::where('code', '=', $code)->get()->count();
        if ($fnd < 1 && $fr < 1 && $pi < 1 && $ref < 1) {
            return response()->json(0);
        } elseif ($fnd > 0) {
            /*$coupon = Coupon::where('code','=',$code)->where('user_id',Auth::guard('web')->user()->id)->first();*/
            $coupon = Coupon::where('status', 1)
                ->where(function ($query) use ($code) {
                    $query->where('code', '=', $code);
                })->where(function ($query) use ($id) {
                    $query->where('user_id', '=', $id)
                        ->orWhere('user_id', '=', null);
                })->first();

            if (Session::has('currency')) {
                $curr = Currency::find(Session::get('currency'));
            } else {
                $curr = Currency::where('is_default', '=', 1)->first();
            }
            if ($coupon->times != null) {
                if ($coupon->times == "0") {
                    return response()->json(0);
                }
            }
            if (($coupon->limited * $curr->value) > $total) {

                return response()->json(0);
            }

            //  dd($total);
            $today = date('Y-m-d');
            /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
            $from = date('Y-m-d', strtotime($coupon->start_date));
            $to = date('Y-m-d', strtotime($coupon->end_date));
            if ($from <= $today && $to >= $today) {
                if ($coupon->status == 1) {
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;
                    if ($val == $code) {
                        return response()->json(2);
                    }
                    $cart = new Cart($oldCart);
                    if ($coupon->type == 0) {
                        Session::put('already', $code);
                        $coupon->price = (int)$coupon->price;

                        $oldCart = Session::get('cart');
                        $cart = new Cart($oldCart);

                        $total = $total - $_GET['shipping_cost'];

                        $val = $total / 100;
                        $sub = $val * $coupon->price;
                        $total = $total - $sub;
                        $total = $total + $_GET['shipping_cost'];
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($sub, 2);
                        if ($gs->currency_format == 0) {
                            $data[0] = $curr->sign . ' ' . $data[0];
                        } else {
                            $data[0] = $data[0] . ' ' . $curr->sign;
                        }
                        Session::put('coupon', $data[2]);
                        Session::put('coupon_code', $code);
                        Session::put('coupon_id', $coupon->id);
                        Session::put('coupon_total1', $data[0]);
                        Session::forget('coupon_total');
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($sub, 2);
                        $data[3] = $coupon->id;
                        $data[4] = $coupon->price . "%";
                        $data[5] = 1;

                        Session::put('coupon_percentage', $data[4]);


                        return response()->json($data);
                    } else {
                        Session::put('already', $code);
                        $total = $total - round($coupon->price * $curr->value, 2);
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($coupon->price * $curr->value, 2);
                        $data[3] = $coupon->id;
                        if ($gs->currency_format == 0) {
                            $data[4] = 0;
                            $data[0] = $curr->sign . ' ' . $data[0];
                        } else {
                            $data[4] = 0;
                            $data[0] = $data[0] . ' ' . $curr->sign;
                        }
                        Session::put('coupon', $data[2]);
                        Session::put('coupon_code', $code);
                        Session::put('coupon_id', $coupon->id);
                        Session::put('coupon_total1', $data[0]);
                        Session::forget('coupon_total');
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($coupon->price * $curr->value, 2);
                        $data[3] = $coupon->id;
                        $data[5] = 1;

                        Session::put('coupon_percentage', $data[4]);

                        return response()->json($data);
                    }
                } else {
                    return response()->json(0);
                }
            } else {
                return response()->json(0);
            }
        } elseif ($ref > 0) {

            /* return response()->json(2); */
            $coupon = Referral::where('code', '=', $code)->first();

            if (Session::has('currency')) {
                $curr = Currency::find(Session::get('currency'));
            } else {
                $curr = Currency::where('is_default', '=', 1)->first();
            }


            if ($coupon->times != null) {
                if ($coupon->times == "0") {
                    return response()->json(0);
                }
            }


            if (($coupon->user_id != Auth::guard('web')->user()->id  && $coupon->new_id != "") ||  ($coupon->user_id == Auth::guard('web')->user()->id && $coupon->new_id == "")) {

                return response()->json(0);
            }



            if (($coupon->limited * $curr->value) > $total) {

                return response()->json(0);
            }

            //  dd($total);
            $today = date('Y-m-d');
            /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
            $from = date('Y-m-d', strtotime($coupon->start_date));
            $to = date('Y-m-d', strtotime($coupon->end_date));
            if ($from <= $today && $to >= $today) {
                if ($coupon->status == 1) {
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;
                    if ($val == $code) {
                        return response()->json(2);
                    }
                    $cart = new Cart($oldCart);
                    if ($coupon->type == 0) {
                        Session::put('already', $code);
                        $coupon->price = (int)$coupon->price;

                        $oldCart = Session::get('cart');
                        $cart = new Cart($oldCart);

                        $total = $total - $_GET['shipping_cost'];

                        $val = $total / 100;
                        $sub = $val * $coupon->price;
                        $total = $total - $sub;
                        $total = $total + $_GET['shipping_cost'];
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($sub, 2);
                        if ($gs->currency_format == 0) {
                            $data[0] = $curr->sign . $data[0];
                        } else {
                            $data[0] = $data[0] . $curr->sign;
                        }
                        Session::put('coupon', $data[2]);
                        Session::put('coupon_code', $code);
                        Session::put('coupon_id', $coupon->id);
                        Session::put('coupon_total1', $data[0]);
                        Session::forget('coupon_total');
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($sub, 2);
                        $data[3] = $coupon->id;
                        $data[4] = $coupon->price . "%";
                        $data[5] = 1;

                        Session::put('coupon_percentage', $data[4]);


                        return response()->json($data);
                    } else {
                        Session::put('already', $code);
                        $total = $total - round($coupon->price * $curr->value, 2);
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($coupon->price * $curr->value, 2);
                        $data[3] = $coupon->id;
                        if ($gs->currency_format == 0) {
                            $data[4] = 0;
                            $data[0] = $curr->sign . $data[0];
                        } else {
                            $data[4] = 0;
                            $data[0] = $data[0] . $curr->sign;
                        }
                        Session::put('coupon', $data[2]);
                        Session::put('coupon_code', $code);
                        Session::put('coupon_id', $coupon->id);
                        Session::put('coupon_total1', $data[0]);
                        Session::forget('coupon_total');
                        $data[0] = round($total, 2);
                        $data[1] = $code;
                        $data[2] = round($coupon->price * $curr->value, 2);
                        $data[3] = $coupon->id;
                        $data[5] = 1;

                        Session::put('coupon_percentage', $data[4]);

                        return response()->json($data);
                    }
                } else {
                    return response()->json(0);
                }
            } else {
                return response()->json(0);
            }
        } elseif ($fr > 0) {

            /* return response()->json(2); */
            $coupon = Free::where('code', '=', $code)->first();
            $free = Profree::where('code_id', '=', $coupon->id)->first();

            if (Session::has('currency')) {
                $curr = Currency::find(Session::get('currency'));
            } else {
                $curr = Currency::where('is_default', '=', 1)->first();
            }


            if ($coupon->times != null) {
                if ($coupon->times == "0") {
                    return response()->json(0);
                }
            }


            if (($coupon->user_id != Auth::guard('web')->user()->id)) {

                return response()->json(0);
            }



            //  dd($total);
            $today = date('Y-m-d');
            /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
            $from = date('Y-m-d', strtotime($coupon->start_date));
            $to = date('Y-m-d', strtotime($coupon->end_date));
            if ($from <= $today && $to >= $today) {
                if ($coupon->status == 1) {
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;
                    if ($val == $code) {
                        return response()->json(2);
                    }
                    $cart = new Cart($oldCart);

                    Session::put('already', $code);

                    $data[0] = round($total, 2);
                    $data[1] = $code;
                    $data[2] = 0;
                    $data[3] = $coupon->id;
                    $data[6] = $free->product_id;
                    $data[7] = 3;
                    if ($gs->currency_format == 0) {
                        $data[4] = 0;
                        $data[0] = $curr->sign . $data[0];
                    } else {
                        $data[4] = 0;
                        $data[0] = $data[0] . $curr->sign;
                    }
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    // Session::put('coupon_total1', $data[0]);
                    Session::put('coupon_pro', $data[6]);
                    Session::put('coupon_free', $code);
                    Session::put('coupon_free_color', $free->color);
                    Session::put('coupon_free_size', $free->size);

                    $data[0] = round($total, 2);
                    $data[1] = $code;
                    $data[2] = 0;
                    $data[3] = $coupon->id;
                    $data[5] = 1;
                    $data[6] = $free->product_id;
                    $data[7] = 3;

                    Session::put('coupon_product', "Free Product");


                    return response()->json($data);
                } else {
                    return response()->json(0);
                }
            } else {
                return response()->json(0);
            }
        } elseif ($pi > 0) {

            /* return response()->json(2); */
            $coupon = Piece::where('code', '=', $code)->first();
            $piece = Propiece::where('code_id', '=', $coupon->id)->first();

            if (Session::has('currency')) {
                $curr = Currency::find(Session::get('currency'));
            } else {
                $curr = Currency::where('is_default', '=', 1)->first();
            }


            if ($coupon->times != null) {
                if ($coupon->times == "0") {
                    return response()->json(0);
                }
            }


            if (($coupon->user_id != Auth::guard('web')->user()->id)) {

                return response()->json(0);
            }



            //  dd($total);
            $today = date('Y-m-d');
            /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
            $from = date('Y-m-d', strtotime($coupon->start_date));
            $to = date('Y-m-d', strtotime($coupon->end_date));
            if ($from <= $today && $to >= $today) {
                if ($coupon->status == 1) {
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $val = Session::has('already') ? Session::get('already') : null;
                    if ($val == $code) {
                        return response()->json(2);
                    }
                    $cart = new Cart($oldCart);

                    Session::put('already', $code);

                    $data[0] = round($total, 2);
                    $data[1] = $code;
                    $data[2] = 0;
                    $data[3] = $coupon->id;
                    $data[6] = $piece->product_id;
                    $data[7] = 3;
                    if ($gs->currency_format == 0) {
                        $data[4] = 0;
                        $data[0] = $curr->sign . $data[0];
                    } else {
                        $data[4] = 0;
                        $data[0] = $data[0] . $curr->sign;
                    }
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    // Session::put('coupon_total1', $data[0]);
                    Session::put('coupon_pro', $data[6]);
                    Session::put('coupon_piece', $code);
                    Session::put('coupon_piece_color', $piece->color);
                    Session::put('coupon_piece_size', $piece->size);
                    Session::put('coupon_get', $coupon->get);
                    Session::put('coupon_take', $coupon->take);

                    $data[0] = round($total, 2);
                    $data[1] = $code;
                    $data[2] = 0;
                    $data[3] = $coupon->id;
                    $data[5] = 1;
                    $data[6] = $piece->product_id;
                    $data[7] = 3;

                    Session::put('coupon_product', "Take Product Free");


                    return response()->json($data);
                } else {
                    return response()->json(0);
                }
            } else {
                return response()->json(0);
            }
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
