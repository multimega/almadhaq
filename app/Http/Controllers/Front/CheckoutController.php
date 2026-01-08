<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Country;

use App\Models\Free;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Profree;
use App\Models\Subscribe;
use App\Models\Piece;
use App\Models\Propiece;
use App\Models\Shipment;
use App\Models\ShipmentPrice;
use App\Models\ShipmentZone;
use App\Models\Admin;
use phpseclib\Crypt\RSA as Crypt_RSA;
use App\Models\AffiliateSetting;
use App\Models\AffilateUsers;
use App\Models\Color;
use App\Models\Referral;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderTrack;
use App\Models\PaymentGateway;
use App\Models\Pickup;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;
use Validator;

class CheckoutController extends Controller
{

    protected  $shipping_price = 0, $shipping_tax = 0;

    public function loadpayment($slug1, $slug2)
    {
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $payment = $slug1;
        $pay_id = $slug2;
        $gateway = '';
        if ($pay_id != 0) {
            $gateway = PaymentGateway::findOrFail($pay_id);
        }
        return view('load.payment', compact('payment', 'pay_id', 'gateway', 'curr'));
    }

    public function checkout($lang)
    {

        $id = DB::table('languages')->where('sign', '=', $lang)->first();

        if ($id) {
            Session::put('language', $id->id);
        } else {
            $data = DB::table('languages')->where('is_default', '=', 1)->first();
            Session::put('language', $data->id);
        }

        $this->code_image();
        if (!Session::has('cart')) {
            return redirect()->route('front.cart', ['lang' => $id->sign])->with('unsuccess', "You don't have any product to checkout.");
        }
        $gs = Generalsetting::findOrFail(1);
        $dp = 1;
        $vendor_shipping_id = 0;
        $vendor_packing_id = 0;


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        // If a user is Authenticated then there is no problm user can go for checkout
        /* $shipments = Shipment::all();*/
        if (Auth::guard('web')->check()) {

            $gateways =  PaymentGateway::where('status', '=', 1)->get();



            $pickups = Pickup::all();

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            // Shipping Method

            if ($gs->multiple_shipping == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {

                    $shipping_data  = DB::table('shippings')->where('user_id', '=', $users[0])->get();
                    if (count($shipping_data) == 0) {
                        $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_shipping_id = $users[0];
                    }
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }
            } else {
                $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
            }

            // Packaging

            if ($gs->multiple_packaging == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $package_data  = DB::table('packages')->where('user_id', '=', $users[0])->get();
                    if (count($package_data) == 0) {
                        $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_packing_id = $users[0];
                    }
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }
            } else {
                $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
            }


            foreach ($products as $prod) {


                if ($prod['item']['type'] == 'Physical') {
                    $dp = 0;
                    break;
                }
            }
            if ($dp == 1) {
                $ship  = 0;
            }
            $total = $cart->totalPrice;
            $tax_value = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
            /*free product Coupon*/
            $free = Session::has('coupon_free') ? Session::get('coupon_free') : 0;
            $free_pro = Session::has('coupon_pro') ? Session::get('coupon_pro') : 0;
            $free_color = Session::has('coupon_free_color') ? Session::get('coupon_free_color') : 0;
            $free_size = Session::has('coupon_free_size') ? Session::get('coupon_free_size') : 0;


            /*Take  product Free  Coupon*/
            $piece = Session::has('coupon_piece') ? Session::get('coupon_free') : 0;
            $piece_pro = Session::has('coupon_pro') ? Session::get('coupon_pro') : 0;
            $piece_color = Session::has('coupon_piece_color') ? Session::get('coupon_piece_color') : 0;
            $piece_size = Session::has('coupon_piece_size') ? Session::get('coupon_piece_size') : 0;


            if ($gs->tax != 0) {
                $tax = ($total / 100) * $gs->tax;

                $total = $total + $tax;
            } else {
                $tax = 0;
            }
            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total = $total + round(0 * $curr->value, 2);
            }
            if ($free) {
                foreach ($cart->items as $item) {
                    if ($item['item']['id'] == $free_pro) {
                        $total = $total - $item['item']['price'];
                        break;
                    }
                }
            }

            if ($piece) {
                foreach ($cart->items as $item) {
                    if ($item['item']['id'] == $piece_pro) {

                        $item['qty']++;
                        $cart->totalQty++;
                        break;
                    }
                }
            }

            return view('front.checkout', ['products' => $cart->items, 'tax' => $tax, 'totalPrice' => $total, 'pickups' => $pickups/*, 'shipments' => $shipments*/, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
        } else {
        }
        if ($gs->guest_checkout == 1) {
            $gateways =  PaymentGateway::where('status', '=', 1)->get();
            $pickups = Pickup::all();
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            // Shipping Method

            if ($gs->multiple_shipping == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', $users[0])->get();

                    if (count($shipping_data) == 0) {
                        $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_shipping_id = $users[0];
                    }
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }
            } else {
                $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
            }

            // Packaging

            if ($gs->multiple_packaging == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $package_data  = DB::table('packages')->where('user_id', '=', $users[0])->get();

                    if (count($package_data) == 0) {
                        $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_packing_id = $users[0];
                    }
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }
            } else {
                $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
            }


            foreach ($products as $prod) {
                if ($prod['item']['type'] == 'Physical') {
                    $dp = 0;
                    break;
                }
            }
            if ($dp == 1) {
                $ship  = 0;
            }
            $total = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
            if ($gs->tax != 0) {
                $tax = ($total / 100) * $gs->tax;
                $total = $total + $tax;
            } else {
                $tax = 0;
            }

            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total =  str_replace($curr->sign, '', $total) + round(0 * $curr->value, 2);
            }
            foreach ($products as $prod) {
                if ($prod['item']['type'] != 'Physical') {
                    if (!Auth::guard('web')->check()) {

                        $ck = 1;

                        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups/*, 'shipments' => $shipments*/, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
                    }
                }
            }
            return view('front.checkout', ['products' => $cart->items, 'tax' => $tax, 'totalPrice' => $total, 'pickups' => $pickups/*, 'shipments' => $shipments*/, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
        }

        // If guest checkout is Deactivated then display pop up form with proper error message

        else {
            $gateways =  PaymentGateway::where('status', '=', 1)->get();
            $pickups = Pickup::all();
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            // Shipping Method

            if ($gs->multiple_shipping == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', $users[0])->get();

                    if (count($shipping_data) == 0) {
                        $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_shipping_id = $users[0];
                    }
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }
            } else {
                $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
            }

            // Packaging

            if ($gs->multiple_packaging == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $package_data  = DB::table('packages')->where('user_id', '=', $users[0])->get();

                    if (count($package_data) == 0) {
                        $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_packing_id = $users[0];
                    }
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }
            } else {
                $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
            }


            $total = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
            if ($gs->tax != 0) {
                $tax = ($total / 100) * $gs->tax;
                $total = $total + $tax;
            }

            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total = $total + round(0 * $curr->value, 2);
            }
            $ck = 1;
            return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
        }
    }

    public function checkout_34($lang)


    {

        $id = DB::table('languages')->where('sign', '=', $lang)->first();
        if ($id) {
            Session::put('language', $id->id);
        } else {
            $data = DB::table('languages')->where('is_default', '=', 1)->first();
            Session::put('language', $data->id);
        }


        $this->code_image();
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success', "You don't have any product to checkout.");
        }
        $gs = Generalsetting::findOrFail(1);
        $dp = 1;
        $vendor_shipping_id = 0;
        $vendor_packing_id = 0;


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        // If a user is Authenticated then there is no problm user can go for checkout
        /* $shipments = Shipment::all();*/
        if (Auth::guard('web')->check()) {

            $gateways =  PaymentGateway::where('status', '=', 1)->get();




            $pickups = Pickup::all();
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            // Shipping Method

            if ($gs->multiple_shipping == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {

                    $shipping_data  = DB::table('shippings')->where('user_id', '=', $users[0])->get();
                    if (count($shipping_data) == 0) {
                        $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_shipping_id = $users[0];
                    }
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }
            } else {
                $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
            }

            // Packaging

            if ($gs->multiple_packaging == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $package_data  = DB::table('packages')->where('user_id', '=', $users[0])->get();
                    if (count($package_data) == 0) {
                        $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_packing_id = $users[0];
                    }
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }
            } else {
                $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
            }


            foreach ($products as $prod) {


                if ($prod['item']['type'] == 'Physical') {
                    $dp = 0;
                    break;
                }
            }
            if ($dp == 1) {
                $ship  = 0;
            }
            $total = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
            /*free product Coupon*/
            $free = Session::has('coupon_free') ? Session::get('coupon_free') : 0;
            $free_pro = Session::has('coupon_pro') ? Session::get('coupon_pro') : 0;
            $free_color = Session::has('coupon_free_color') ? Session::get('coupon_free_color') : 0;
            $free_size = Session::has('coupon_free_size') ? Session::get('coupon_free_size') : 0;


            /*Take  product Free  Coupon*/
            $piece = Session::has('coupon_piece') ? Session::get('coupon_free') : 0;
            $piece_pro = Session::has('coupon_pro') ? Session::get('coupon_pro') : 0;
            $piece_color = Session::has('coupon_piece_color') ? Session::get('coupon_piece_color') : 0;
            $piece_size = Session::has('coupon_piece_size') ? Session::get('coupon_piece_size') : 0;


            if ($gs->tax != 0) {
                $tax = ($total / 100) * $gs->tax;
                $total = $total + $tax;
            }

            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total = $total + round(0 * $curr->value, 2);
            }
            if ($free) {
                foreach ($cart->items as $item) {
                    if ($item['item']['id'] == $free_pro) {
                        $total = $total - $item['item']['price'];
                        break;
                    }
                }
            }

            if ($piece) {
                foreach ($cart->items as $item) {
                    if ($item['item']['id'] == $piece_pro) {

                        $item['qty']++;
                        $cart->totalQty++;
                        break;
                    }
                }
            }

            return view('front.f-checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups/*, 'shipments' => $shipments*/, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
        } else {
        }
        if ($gs->guest_checkout == 1) {
            $gateways =  PaymentGateway::where('status', '=', 1)->get();
            $pickups = Pickup::all();
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            // Shipping Method

            if ($gs->multiple_shipping == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', $users[0])->get();

                    if (count($shipping_data) == 0) {
                        $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_shipping_id = $users[0];
                    }
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }
            } else {
                $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
            }

            // Packaging

            if ($gs->multiple_packaging == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $package_data  = DB::table('packages')->where('user_id', '=', $users[0])->get();

                    if (count($package_data) == 0) {
                        $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_packing_id = $users[0];
                    }
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }
            } else {
                $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
            }


            foreach ($products as $prod) {
                if ($prod['item']['type'] == 'Physical') {
                    $dp = 0;
                    break;
                }
            }
            if ($dp == 1) {
                $ship  = 0;
            }
            $total = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
            if ($gs->tax != 0) {
                $tax = ($total / 100) * $gs->tax;
                $total = $total + $tax;
            }

            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total =  str_replace($curr->sign, '', $total) + round(0 * $curr->value, 2);
            }
            foreach ($products as $prod) {
                if ($prod['item']['type'] != 'Physical') {
                    if (!Auth::guard('web')->check()) {

                        $ck = 1;

                        return view('f-front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups/*, 'shipments' => $shipments*/, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
                    }
                }
            }
            return view('front.f-checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups/*, 'shipments' => $shipments*/, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
        }

        // If guest checkout is Deactivated then display pop up form with proper error message

        else {
            $gateways =  PaymentGateway::where('status', '=', 1)->get();
            $pickups = Pickup::all();
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            // Shipping Method

            if ($gs->multiple_shipping == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', $users[0])->get();

                    if (count($shipping_data) == 0) {
                        $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_shipping_id = $users[0];
                    }
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }
            } else {
                $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
            }

            // Packaging

            if ($gs->multiple_packaging == 1) {
                $user = null;
                foreach ($cart->items as $prod) {
                    $user[] = $prod['item']['user_id'];
                }
                $users = array_unique($user);
                if (count($users) == 1) {
                    $package_data  = DB::table('packages')->where('user_id', '=', $users[0])->get();

                    if (count($package_data) == 0) {
                        $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                    } else {
                        $vendor_packing_id = $users[0];
                    }
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }
            } else {
                $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
            }


            $total = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
            if ($gs->tax != 0) {
                $tax = ($total / 100) * $gs->tax;
                $total = $total + $tax;
            }
            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total = $total + round(0 * $curr->value, 2);
            }
            $ck = 1;
            return view('front.f-checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);
        }
    }

    /*============================      checkout store   ==================================*/

    public function checkoutStore(Request $request)
    {


        // dd($request->all());
        if (Auth::check()) {
            $addressCheck = $request->address;
            if (is_numeric($addressCheck)) {
                // Get the address details from the database
                $address = Address::find($addressCheck);
                $request->address = $address->address;
            } else {

                //   $request->address = Auth::user()->address;
            }

            // dd($request->all() ,$request->address);

        }

        if (Auth::check()) {

            $validator = Validator::make($request->only(['personal_name']), [

                // 'address'   => 'required',
                'personal_name' => 'required|min:4',

            ]);
        } else {
            $validator = Validator::make($request->only(['personal_name']), [

                // 'address'   => 'required|min:5',
                'personal_name' => 'required|min:4',

            ]);
        }




        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $zone = \App\Models\Zone::where('name', $request->city)->orWhere('name_ar', $request->city)->first();

        if (!$zone) {
            return redirect()->back()->with('unsuccess', "The selected city ($request->city) is not allowed for delivery.");
        }

        // dd($request->all(),$zone);
        if ($zone->allow_cash != "on") {
            return redirect()->back()->with('unsuccess', "You must choose any payment getway");
        }
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
                    //   $zone = \App\Models\Country::where('country_name', $request->customer_country)->first();
                    $zone = \App\Models\Zone::where('name', $request->city)->first();
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

        // $validator = Validator::make($request->all(), [

        //     'address'   => 'required|min:10',
        //     'personal_name'=>'required|min:5',
        //     'personal_email'=>'required|email',

        // ]);


        // if ($validator->fails()) {
        //     return  redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $shippingService = new \App\Services\ShippingService();

        try {
            // Validate the shipping slot is still available

            if (!$shippingService->validateShippingSlot($request->shipping_schedule_id, $request->scheduled_delivery_date)) {

                return redirect()->back()->with('unsuccess', "Selected shipping slot is no longer available.");
            }

            // Reserve the shipping slot
            $shippingDetails = $shippingService->reserveShippingSlot(
                $request->shipping_schedule_id,
                $request->scheduled_delivery_date
            );
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('unsuccess', "Error reserving shipping slot:" . $e->getMessage());
        }

        $paymentGateway = \App\Models\PaymentGateway::find($request->payment_gateway_id);

        if (empty($paymentGateway)) {
            return redirect()->back()->with('unsuccess', "Payment gateway not found.");
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
        $order['method'] = $paymentGateway->title;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;

        $order['company_name'] = $request->company_name;
        $order['domain_name'] = $request->is_domain == "yes" ? $request->domain_name : null;
        $order['add_domain'] =  $request->is_domain == "no" ? $request->add_domain : "no";


        $order['order_completed'] = 1;
        $order['shipment_id'] = $request->shipment;
        $order['shipping_price'] = $this->shipping_price;
        $order['shipping_tax'] = $this->shipping_tax;
        $order['tax'] = 15;
        $order['tax_value'] = $pay_amount - round($pay_amount / (1.15), 2);
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

        $order['shipping_schedule_id'] = $request->shipping_schedule_id;
        $order['scheduled_delivery_date'] = $request->scheduled_delivery_date;
        $order['scheduled_delivery_start_time'] = $request->scheduled_delivery_start_time;
        $order['scheduled_delivery_end_time'] = $request->scheduled_delivery_end_time;

        $order['area'] = $request->area;
        $order['building_number'] = $request->building_number;


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
        $order->invoice_url = 'https://almuslhi.com/invoice/' . $order->id;
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

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

        //Sending Email To Buyer - DISABLED (email removed)
        /*if ($gs->is_smtp == 1) {
            if (!empty($request->personal_email)) {
                $msg = "Hello " . $request->personal_name . "!<br> You have placed a new order.<br>Your order number is " . $order->order_number . ".Please wait for your delivery. <br>Thank you.";
                $msgs = '<html><body>';
                $msgs = '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgs = $msg;
                $msgs .= "</table>";
                $msgs .= "</body></html>";
                $data = [

                    'subject' => "Your Order Placed!!",
                    'body' => $msgs,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMailToUser($data, $order->id);
            } else {

                $subject = "Your Order Placed!!";
                $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
                $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                mail($to, $subject, $msg, $headers);
            }
        }*/



        //Sending Email To Admin
        //Sending Email To Admin
        if ($gs->is_smtp == 1) {
            $msg = "مرحباً أيها المسؤول!<br> تم استلام طلب جديد في متجرك. <br> رقم الطلب هو " . $order->order_number . " <br> اسم العميل : " . $order->customer_name . "<br>رقم هاتف العميل : " . $order->customer_phone . "<br> يرجى تسجيل الدخول إلى لوحة التحكم الخاصة بك للتحقق. <br> شكراً لك.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            $data = [
                'to' => $gs->email,
                'subject' => "تم استلام طلب جديد!!",
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMailToAdmin($data);
        } else {
            $to = $gs->email;
            $subject = "تم استلام طلب جديد!!";
            $msg = "مرحباً أيها المسؤول!\nتم استلام طلب جديد في متجرك.\nرقم الطلب هو " . $order->order_number . "\nاسم العميل : " . $order->customer_name . "\nرقم هاتف العميل : " . $order->customer_phone . "\nيرجى تسجيل الدخول إلى لوحة التحكم الخاصة بك للتحقق. \nشكراً لك.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
        }


        $this->erporder($order);



        return redirect($success_url);
    }

    public function getWhatsAppMessage($id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        // Use findOrFail(1) to ensure we get the latest data, not cached
        $settings = Generalsetting::findOrFail(1);

        // Get phone number from settings
        $phone = $settings->whatsapp_number;

        if (!$phone) {
            return response()->json(['error' => 'No phone number found for this order'], 400);
        }

        // Clean phone number (remove spaces, dashes, etc.) - keep only digits and +
        $phone = preg_replace('/[^\d+]/', '', trim($phone));

        // Get country code from settings (default to +20 for Egypt)
        $countryCode = trim($settings->whatsapp_country_code ?: '+20');

        // Ensure country code starts with +
        if (!str_starts_with($countryCode, '+')) {
            $countryCode = '+' . ltrim($countryCode, '+');
        }

        // Add country code if not present
        if (!str_starts_with($phone, '+')) {
            // Remove country code digits if they're already at the start
            $cleanCountryCode = str_replace('+', '', $countryCode);
            if (str_starts_with($phone, $cleanCountryCode)) {
                $phone = '+' . $phone;
            } else {
                $phone = $countryCode . $phone;
            }
        }

        // Final cleanup: ensure phone contains only + followed by digits
        // Remove any non-digit characters except the leading +
        if (str_starts_with($phone, '+')) {
            $phone = '+' . preg_replace('/[^\d]/', '', substr($phone, 1));
        } else {
            $phone = '+' . preg_replace('/[^\d]/', '', $phone);
        }

        // Get custom message template or use default
        $messageTemplate = $settings->whatsapp_message_template ?: Generalsetting::getDefaultMessageTemplate();

        // Prepare products list
        $productsList = '';
        foreach ($cart->items as $key => $product) {
            $productsList .= "• " . $product['item']['name'] . "\n";
            $productsList .= "  Qty: " . $product['qty'] . " | Price: " .  round($product['price'] * $order->currency_value, 2) . $order->currency_sign . "\n";

            if ($product['size']) {
                $productsList .= "  Size: " . $product['size'] . "\n";
            }
            if ($product['color']) {
                $productsList .= "  Color: #" . $product['color'] . "\n";
            }
            $productsList .= "\n";
        }

        $customerDetails = '';
        if ($order->dp == 0) {
            $customerDetails .= "Name: " . ($order->shipping_name ?: $order->customer_name) . "\n";
        }


        // Prepare shipping details
        $shippingDetails = '';
        if ($order->shipping != "pickup" && $order->dp == 0) {
            // $shippingDetails .= "Name: " . ($order->shipping_name ?: $order->customer_name) . "\n";

            // $shippingDetails .= "Address: " . ($order->shipping_address ?: $order->customer_address) . "\n";

            $shippingDetails .= "Phone Number: " . ($order->shipping_phone ?: $order->customer_phone) . "\n";
            $shippingDetails .= "City: " . ($order->shipping_city ?: $order->customer_city) . "\n";
            $shippingDetails .= "Area: " . $order->area . "\n";
            $shippingDetails .= "Building Number: " . $order->building_number . "\n";
            // $shippingDetails .= "Country: " . ($order->shipping_country ?: $order->customer_country) . "\n";
            // if ($order->shipping_zip || $order->customer_zip) {
            //     $shippingDetails .= "Postal Code: " . ($order->shipping_zip ?: $order->customer_zip) . "\n";
            // }
        } elseif ($order->shipping == "pickup") {
            $shippingDetails = "Pickup Location: " . $order->pickup_location . "\n";
        }

        // Prepare tracking info
        $trackingInfo = '';
        if ($order->status == "processing" || $order->status == "on delivery") {
            if ($order->shipment_id == 1 && $order->company_fastlo_api) {
                $trackingInfo = "Fastlo Order: " . $order->company_fastlo_api;
            } elseif ($order->shipment_id == 2 && $order->aramex_api_numbeer) {
                $trackingInfo = "Aramex Track: " . $order->aramex_api_numbeer;
            } elseif ($order->shipment_id == 4 && $order->serial) {
                $trackingInfo = "Fedex Serial: " . $order->serial;
            } elseif ($order->shipment_id == 6 && $order->Awb) {
                $trackingInfo = "ABS Number: " . $order->Awb;
            } elseif ($order->shipment_id == 7 && $order->barcod) {
                $trackingInfo = "Mylerz Barcode: " . $order->barcod;
            }
        }

        $deliverySchedule = '';
        if ($order->scheduled_delivery_date && $order->scheduled_delivery_start_time && $order->scheduled_delivery_end_time) {
            $deliveryDate = date('d/m/Y', strtotime($order->scheduled_delivery_date));
            $startTime = date('h:i A', strtotime($order->scheduled_delivery_start_time));
            $endTime = date('h:i A', strtotime($order->scheduled_delivery_end_time));

            $deliverySchedule = "{$deliveryDate} ({$startTime} - {$endTime})";
        }



        // Replace placeholders in the message template
        $placeholders = [
            '{ORDER_NUMBER}' => $order->order_number,
            '{ORDER_DATE}' => date('d/m/Y h:i A', strtotime($order->created_at)),
            '{DELIVERY_SCHEDULE}' => $deliverySchedule,
            '{ORDER_TOTAL}' =>  round($order->pay_amount * $order->currency_value, 2) . $order->currency_sign,
            '{PAYMENT_METHOD}' => $order->method,
            '{ORDER_STATUS}' => ucwords($order->status),
            '{PRODUCTS_LIST}' => trim($productsList),
            '{SHIPPING_DETAILS}' => trim($shippingDetails),
            '{CUSTOMER_DETAILS}' => trim($customerDetails),
            '{TRACKING_INFO}' => $trackingInfo,
            '{CUSTOMER_NAME}' => $order->customer_name,

            '{CUSTOMER_PHONE}' => $order->customer_phone,
            '{CURRENCY_SIGN}' => $order->currency_sign,
        ];


        $message = str_replace(array_keys($placeholders), array_values($placeholders), $messageTemplate);

        // Clean up empty sections
        $message = preg_replace('/\n\s*\n/', "\n\n", $message); // Remove extra blank lines
        $message = trim($message);

        // URL encode the message
        $encodedMessage = urlencode($message);

        // Create WhatsApp URL
        $whatsappUrl = "https://wa.me/{$phone}?text={$encodedMessage}";

        return response()->json([
            'phone' => $phone,
            'message' => $message,
            'whatsapp_url' => $whatsappUrl
        ]);
    }

    /*============================ cash on delivry        ==================================*/



    public function cashondelivery(Request $request)
    {


        dd($request->all());
        if (Auth::check()) {
            $addressCheck = $request->address;
            if (is_numeric($addressCheck)) {
                // Get the address details from the database
                $address = Address::find($addressCheck);
                $request->address = $address->address;
            } else {

                //   $request->address = Auth::user()->address;
            }

            // dd($request->all() ,$request->address);

        }

        if (Auth::check()) {

            $validator = Validator::make($request->only(['personal_name']), [

                // 'address'   => 'required',
                'personal_name' => 'required|min:4',


            ]);
        } else {
            $validator = Validator::make($request->only(['personal_name']), [

                // 'address'   => 'required|min:5',
                'personal_name' => 'required|min:4',


            ]);
        }




        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $zone = \App\Models\Zone::where('name', $request->city)->orWhere('name_ar', $request->city)->first();

        if (!$zone) {
            return redirect()->back()->with('unsuccess', "The selected city ($request->city) is not allowed for delivery.");
        }

        // dd($request->all(),$zone);
        if ($zone->allow_cash != "on") {
            return redirect()->back()->with('unsuccess', "You must choose any payment getway");
        }
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
                    //   $zone = \App\Models\Country::where('country_name', $request->customer_country)->first();
                    $zone = \App\Models\Zone::where('name', $request->city)->first();
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

        // $validator = Validator::make($request->all(), [

        //     'address'   => 'required|min:10',
        //     'personal_name'=>'required|min:5',
        //     'personal_email'=>'required|email',

        // ]);


        // if ($validator->fails()) {
        //     return  redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $shippingService = new \App\Services\ShippingService();

        try {
            // Validate the shipping slot is still available
            if (!$shippingService->validateShippingSlot($request->shipping_schedule_id, $request->scheduled_delivery_date)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Selected shipping slot is no longer available.'
                ], 400);
            }

            // Reserve the shipping slot
            $shippingDetails = $shippingService->reserveShippingSlot(
                $request->shipping_schedule_id,
                $request->scheduled_delivery_date
            );
        } catch (\Exception $e) {
            dd($e);
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
        $order['method'] = $request->method;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;

        $order['company_name'] = $request->company_name;
        $order['domain_name'] = $request->is_domain == "yes" ? $request->domain_name : null;
        $order['add_domain'] =  $request->is_domain == "no" ? $request->add_domain : "no";


        $order['order_completed'] = 1;
        $order['shipment_id'] = $request->shipment;
        $order['shipping_price'] = $this->shipping_price;
        $order['shipping_tax'] = $this->shipping_tax;
        $order['tax'] = 15;
        $order['tax_value'] = $pay_amount - round($pay_amount / (1.15), 2);
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

        $order['shipping_schedule_id'] = $request->shipping_schedule_id;
        $order['scheduled_delivery_date'] = $request->scheduled_delivery_date;
        $order['scheduled_delivery_start_time'] = $request->scheduled_delivery_start_time;
        $order['scheduled_delivery_end_time'] = $request->scheduled_delivery_end_time;

        $order['area'] = $request->area;
        $order['building_number'] = $request->building_number;


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
        $order->invoice_url = 'https://almuslhi.com/invoice/' . $order->id;
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

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

        //Sending Email To Buyer - DISABLED (email removed)
        /*if ($gs->is_smtp == 1) {
            if (!empty($request->personal_email)) {
                $msg = "Hello " . $request->personal_name . "!<br> You have placed a new order.<br>Your order number is " . $order->order_number . ".Please wait for your delivery. <br>Thank you.";
                $msgs = '<html><body>';
                $msgs = '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgs = $msg;
                $msgs .= "</table>";
                $msgs .= "</body></html>";
                $data = [

                    'subject' => "Your Order Placed!!",
                    'body' => $msgs,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMailToUser($data, $order->id);
            } else {

                $subject = "Your Order Placed!!";
                $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
                $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                mail($to, $subject, $msg, $headers);
            }
        }*/



        //Sending Email To Admin
        //Sending Email To Admin
        if ($gs->is_smtp == 1) {
            $msg = "مرحباً أيها المسؤول!<br> تم استلام طلب جديد في متجرك. <br> رقم الطلب هو " . $order->order_number . " <br> اسم العميل : " . $order->customer_name . "<br>رقم هاتف العميل : " . $order->customer_phone . "<br> يرجى تسجيل الدخول إلى لوحة التحكم الخاصة بك للتحقق. <br> شكراً لك.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            $data = [
                'to' => $gs->email,
                'subject' => "تم استلام طلب جديد!!",
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMailToAdmin($data);
        } else {
            $to = $gs->email;
            $subject = "تم استلام طلب جديد!!";
            $msg = "مرحباً أيها المسؤول!\nتم استلام طلب جديد في متجرك.\nرقم الطلب هو " . $order->order_number . "\nاسم العميل : " . $order->customer_name . "\nرقم هاتف العميل : " . $order->customer_phone . "\nيرجى تسجيل الدخول إلى لوحة التحكم الخاصة بك للتحقق. \nشكراً لك.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
        }


        $this->erporder($order);



        return redirect($success_url);
    }

    /*================================ Bank Transfer ================================*/
    public function bankTransfer(Request $request)
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

        $validator = Validator::make($request->all(), [

            'address'   => 'required|min:5',
            'personal_name' => 'required|min:4',


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
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total)  / $curr->value, 2);
        $order['method'] = $request->method;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;

        $order['company_name'] = $request->company_name;
        $order['domain_name'] = $request->is_domain == "yes" ? $request->domain_name : null;
        $order['add_domain'] =  $request->is_domain == "no" ? $request->add_domain : "no";


        $order['order_completed'] = 1;
        $order['shipment_id'] = $request->shipment;
        $order['shipping_price'] = $this->shipping_price;
        $order['shipping_tax'] = $this->shipping_tax;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = $request->phone;
        //$order['order_number'] = str_random(4).time();

        $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
        }


        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //     $order['customer_zip'] = $request->zip;

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


            if ($prod['item']['feature'] == 1) {

                $subscribe = Subscribe::where('product_id', $prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id)->first();
                if (!empty($subscribe)) {
                    if ($subscribe->end_date != null) {
                        if ($prod['item']['subscription_type'] == "Days") {
                            $days = $prod['item']['subscription_period'];
                        } elseif ($prod['item']['subscription_type'] == "Months") {
                            $days = $prod['item']['subscription_period'] * 30;
                        } else {
                            $days = $prod['item']['subscription_period'] * 365;
                        }

                        $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date . ' + ' . $days . ' days'));
                    }

                    $subscribe->order_id = $order->id;
                    $subscribe->paid_via = "bank transfer";
                    $subscribe->update();
                } else {

                    $subscribe = new Subscribe();
                    $subscribe->user_id = Auth::guard('web')->user()->id;
                    $subscribe->product_id = $prod['item']['id'];
                    $subscribe->paid_via = "bank transfer";
                    $subscribe->package_details = "Gona Check it And be avaiible soon";
                    $subscribe->order_id = $order->id;
                    $subscribe->package_price = $prod['price'] * $curr->value;
                    $subscribe->save();
                }
            }
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
        Session::forget('free_shipping');
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
                'to' => $request->personal_email,
                'type' => "new_order",
                'cname' => $request->personal_name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
                'onumber' => $order->order_number,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoOrderMail($data, $order->id);
        } else {

            $subject = "Your Order Placed!!";
            $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
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
            $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is " . $order->order_number . "\nCompany Name : " . $order->company_name . "\nCustomer name : " . $order->customer_name . "\nCustomer Email : " .
                "\nCustomer phone : " . $order->customer_phone . "\nPlease login to your panel to check. \nThank you.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
        }


        return redirect($success_url);
    }

    /*-------------------------------------------------------------*/
    public function accepts(Request $request)
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
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
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
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }



            /*  if(Session::has('coupon_get')){
            $take = Session::get('coupon_take');
            if($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get') ){
                $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
              
               $cart->items[$itemid]['qty'] = 5 ; 
            
               Session::put('cart',$cart);
               
            }
            
        }*/

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

            'address'   => 'required|min:5',
            'personal_name' => 'required|min:4',


        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $order = new Order;
        $success_url = action('Front\PaymentController@accept');
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total)  / $curr->value, 2);
        $order['method'] = "Accept";
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
        //    $order['customer_zip'] = $request->zip;

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


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
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

        foreach ($cart->items as $prod) {


            /*  if($prod['item']['feature'] == 1){
                
               $subscribe = Subscribe::where('product_id',$prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id )->first(); 
                if(!empty($subscribe)){
                   if($subscribe->end_date != null){
                   if($prod['item']['subscription_type'] == "Days"){
                      $days = $prod['item']['subscription_period'] ;
                  }elseif($prod['item']['subscription_type'] == "Months"){
                      $days = $prod['item']['subscription_period'] * 30;
                  }else{
                      $days = $prod['item']['subscription_period'] * 365;
                  }  
                  
                  $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date. ' + '.$days.' days')) ;
                 
                  
                       
                   }
                   
                   $subscribe->order_id = $order->id; 
                   $subscribe->paid_via = "Cash"; 
                   $subscribe->update(); 
                  
                   
                }else{
                    
                    $subscribe = new Subscribe() ;
                    $subscribe->user_id = Auth::guard('web')->user()->id ;
                    $subscribe->product_id = $prod['item']['id'] ;
                    $subscribe->paid_via = "Cash"; 
                    $subscribe->package_details = "Gona Check it And be avaiible soon"; 
                    $subscribe->order_id = $order->id; 
                    $subscribe->package_price = $prod['price'] * $curr->value ; 
                    $subscribe->save(); 
                }
            }*/
            $x = (string)$prod['size_qty'];
            if (!empty($x)) {
                $product = Product::findOrFail($prod['item']['id']);
                if (!empty($product->size_qty)) {
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    if (is_array($temp)) {
                        $temp1 = implode(',', $temp);
                        $product->size_qty = $temp1;
                    } else {

                        $product->size_qty = $temp;
                    }
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('free_shipping');
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


        $tokken = array(

            "api_key" => $gs->accept_key,
        );

        $d = $tokken;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $responses = $client->post(
            'https://accept.paymobsolutions.com/api/auth/tokens',

            ['body' => $data]


        );

        $tokens = json_decode($responses->getBody(), true);

        $bostaa = array(

            "auth_token" => $tokens['token'],
            "delivery_needed" => "false",
            "amount_cents" => (int)round($order->pay_amount  / $curr->value, 2),
            "merchant_id" => $gs->accept_merchant,
            "currency" => "EGP",
            "merchant_order_id" => $order->id

        );


        $bostaa['shipping_data'] = array(

            "apartment" => "803",
            "phone" => $order->customer_phone,
            "floor" => "42",
            "first_name" => $order->customer_name,
            "street" => $order->customer_address,
            "building" => $order->customer_address,
            "phone_number" => $order->customer_phone,
            "shipping_method" => "PKG",
            //  "postal_code"=> $order->customer_zip,
            "city" => $order->customer_city,
            "country" => $order->customer_country,
            "last_name" => $order->customer_name,
            "state" => $order->customer_city,


        );


        $d = $bostaa;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);


        $response = $client->post(
            'https://accept.paymobsolutions.com/api/ecommerce/orders',

            ['body' => $data]
        );




        $items = json_decode($response->getBody(), true);
        $tokens = json_decode($responses->getBody(), true);

        $payy_keys = array(

            "auth_token" => $tokens['token'],
            "amount_cents" => (int)(round($order->pay_amount / $curr->value, 2)),
            "currency" => "EGP",
            "integration_id" => $gs->paymentid,
            "expiration" => 3600,
            "order_id" => $items['id'],
        );



        $payy_keys['billing_data'] = array(

            "apartment" => "803",
            "phone" => $order->customer_phone,
            "floor" => "42",
            "first_name" => $order->customer_name,
            "street" => $order->customer_address,
            "building" => "8028",
            "phone_number" => $order->customer_phone,
            "shipping_method" => "PKG",
            //  "postal_code"=>$order->customer_zip,
            "city" => $order->customer_city,
            "country" => $order->customer_country,
            "last_name" => $order->customer_name,
            "state" => $order->customer_city,


        );
        $d = $payy_keys;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $response = $client->post(
            'https://accept.paymobsolutions.com/api/acceptance/payment_keys',

            ['body' => $data]



        );


        $key2 = json_decode($response->getBody(), true);

        return redirect($success_url)->with('key2', $key2);
    }




    public function thawany(Request $request)
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
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
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
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }



            /*  if(Session::has('coupon_get')){
            $take = Session::get('coupon_take');
            if($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get') ){
                $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
              
               $cart->items[$itemid]['qty'] = 5 ; 
            
               Session::put('cart',$cart);
               
            }
            
        }*/

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


        $order = new Order;
        $success_url = action('Front\PaymentController@thwani');
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total)  / $curr->value, 2);
        $order['method'] = "Thawani";
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
        //$order['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //    $order['customer_zip'] = $request->zip;

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


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
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

        foreach ($cart->items as $prod) {


            /*  if($prod['item']['feature'] == 1){
                
               $subscribe = Subscribe::where('product_id',$prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id )->first(); 
                if(!empty($subscribe)){
                   if($subscribe->end_date != null){
                   if($prod['item']['subscription_type'] == "Days"){
                      $days = $prod['item']['subscription_period'] ;
                  }elseif($prod['item']['subscription_type'] == "Months"){
                      $days = $prod['item']['subscription_period'] * 30;
                  }else{
                      $days = $prod['item']['subscription_period'] * 365;
                  }  
                  
                  $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date. ' + '.$days.' days')) ;
                 
                  
                       
                   }
                   
                   $subscribe->order_id = $order->id; 
                   $subscribe->paid_via = "Cash"; 
                   $subscribe->update(); 
                  
                   
                }else{
                    
                    $subscribe = new Subscribe() ;
                    $subscribe->user_id = Auth::guard('web')->user()->id ;
                    $subscribe->product_id = $prod['item']['id'] ;
                    $subscribe->paid_via = "Cash"; 
                    $subscribe->package_details = "Gona Check it And be avaiible soon"; 
                    $subscribe->order_id = $order->id; 
                    $subscribe->package_price = $prod['price'] * $curr->value ; 
                    $subscribe->save(); 
                }
            }*/
            $x = (string)$prod['size_qty'];
            if (!empty($x)) {
                $product = Product::findOrFail($prod['item']['id']);
                if (!empty($product->size_qty)) {
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    if (is_array($temp)) {
                        $temp1 = implode(',', $temp);
                        $product->size_qty = $temp1;
                    } else {

                        $product->size_qty = $temp;
                    }
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('free_shipping');
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


        $payy = array(
            "client_reference_id" => rand(),
            "products" => array(
                array(

                    "name" => "Dukan Market",
                    "unit_amount" => round(($request->total + $request->shipping_cost)  / $curr->value, 2) * 1000,
                    "quantity" => 1

                )
            ),

            "cancel_url" => "https://version3.vooecommerce.com/en/cancelpayment",
            "success_url" => "https://version3.vooecommerce.com/en/editorder/$order->id",

        );


        $payy['metadata'] = array(

            "customer" => "Thawani User",
            "order_id" => $order->id,
            'name' => $order->customer_name,
            'mobile' => $order->customer_phone,



        );


        $d = $payy;

        $data = json_encode($d);

        $client = new Client([

            'headers' => ['Content-Type' => 'application/json', 'Thawani-Api-Key' => $gs->thawani_secret]


        ]);

        $response = $client->post(
            "$gs->thawani_link/api/v1/checkout/session",

            ['body' => $data]


        );

        $key2 = json_decode($response->getBody(), true);

        return redirect()->to("$gs->thawani_link/pay/{$key2['data']['session_id']}?key=$gs->thawani_publish");
    }


    public function fatora(Request $request)
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
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
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
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }



            /*  if(Session::has('coupon_get')){
            $take = Session::get('coupon_take');
            if($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get') ){
                $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
              
               $cart->items[$itemid]['qty'] = 5 ; 
            
               Session::put('cart',$cart);
               
            }
            
        }*/

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


        $order = new Order;
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total)  / $curr->value, 2);
        $order['method'] = "Thawani";
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
        //$order['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //    $order['customer_zip'] = $request->zip;

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


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
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

        foreach ($cart->items as $prod) {


            /*  if($prod['item']['feature'] == 1){
                
               $subscribe = Subscribe::where('product_id',$prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id )->first(); 
                if(!empty($subscribe)){
                   if($subscribe->end_date != null){
                   if($prod['item']['subscription_type'] == "Days"){
                      $days = $prod['item']['subscription_period'] ;
                  }elseif($prod['item']['subscription_type'] == "Months"){
                      $days = $prod['item']['subscription_period'] * 30;
                  }else{
                      $days = $prod['item']['subscription_period'] * 365;
                  }  
                  
                  $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date. ' + '.$days.' days')) ;
                 
                  
                       
                   }
                   
                   $subscribe->order_id = $order->id; 
                   $subscribe->paid_via = "Cash"; 
                   $subscribe->update(); 
                  
                   
                }else{
                    
                    $subscribe = new Subscribe() ;
                    $subscribe->user_id = Auth::guard('web')->user()->id ;
                    $subscribe->product_id = $prod['item']['id'] ;
                    $subscribe->paid_via = "Cash"; 
                    $subscribe->package_details = "Gona Check it And be avaiible soon"; 
                    $subscribe->order_id = $order->id; 
                    $subscribe->package_price = $prod['price'] * $curr->value ; 
                    $subscribe->save(); 
                }
            }*/
            $x = (string)$prod['size_qty'];
            if (!empty($x)) {
                $product = Product::findOrFail($prod['item']['id']);
                if (!empty($product->size_qty)) {
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    if (is_array($temp)) {
                        $temp1 = implode(',', $temp);
                        $product->size_qty = $temp1;
                    } else {

                        $product->size_qty = $temp;
                    }
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('free_shipping');
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

        $payy_keys = array(

            "token" => $gs->fatoratoken,
            "currencyCode" => "QAR",
            "orderId" => $order->id,
            "amount" => round($order->pay_amount * $order->currency_value, 2),

            "customerName" => $order->customer_name,
            "customerPhone" => $order->customer_phone,
            "CustomerCountry" => $order->customer_country,
            "lang" => "ar",

        );

        $data = json_encode($payy_keys);

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']

        ]);

        $response = $client->post(
            'https://maktapp.credit/v3/AddTransaction',

            ['body' => $data]

        );

        $key2 = json_decode($response->getBody(), true);

        return redirect()->to($key2['result']);
    }

    public function tap(Request $request)
    {
        if (Auth::check()) {
            $addressCheck = $request->address;
            if (is_numeric($addressCheck)) {
                // Get the address details from the database
                $address = Address::find($addressCheck);
                $request->address = $address->address;
            } else {

                $request->address = Auth::user()->address;
            }

            // dd($request->all() ,$request->address);

        }

        if (Auth::check()) {

            $validator = Validator::make($request->only(['address', 'personal_name']), [

                'address'   => 'required',
                'personal_name' => 'required|min:4',


            ]);
        } else {
            $validator = Validator::make($request->only(['address', 'personal_name']), [

                'address'   => 'required|min:5',
                'personal_name' => 'required|min:4',


            ]);
        }


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
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
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
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
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }



            /*  if(Session::has('coupon_get')){
            $take = Session::get('coupon_take');
            if($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get') ){
                $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
              
               $cart->items[$itemid]['qty'] = 5 ; 
            
               Session::put('cart',$cart);
               
            }
            
        }*/

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



        $order = new Order;
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total + $this->shipping_price) /  $curr->value, 2);
        $order['method'] = "tap";
        $order['payment_status'] = "processing";
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
        $order['tax'] = 15;
        $order['tax_value'] = $pay_amount - round($pay_amount / (1.15), 2);
        $order['customer_phone'] = $request->phone;
        //$order['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city']    = $request->city;
        //    $order['customer_zip'] = $request->zip;

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
        $order['tap_order_id'] = "";
        $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
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

        foreach ($cart->items as $prod) {


            /*  if($prod['item']['feature'] == 1){
                
               $subscribe = Subscribe::where('product_id',$prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id )->first(); 
                if(!empty($subscribe)){
                   if($subscribe->end_date != null){
                   if($prod['item']['subscription_type'] == "Days"){
                      $days = $prod['item']['subscription_period'] ;
                  }elseif($prod['item']['subscription_type'] == "Months"){
                      $days = $prod['item']['subscription_period'] * 30;
                  }else{
                      $days = $prod['item']['subscription_period'] * 365;
                  }  
                  
                  $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date. ' + '.$days.' days')) ;
                 
                  
                       
                   }
                   
                   $subscribe->order_id = $order->id; 
                   $subscribe->paid_via = "Cash"; 
                   $subscribe->update(); 
                  
                   
                }else{
                    
                    $subscribe = new Subscribe() ;
                    $subscribe->user_id = Auth::guard('web')->user()->id ;
                    $subscribe->product_id = $prod['item']['id'] ;
                    $subscribe->paid_via = "Cash"; 
                    $subscribe->package_details = "Gona Check it And be avaiible soon"; 
                    $subscribe->order_id = $order->id; 
                    $subscribe->package_price = $prod['price'] * $curr->value ; 
                    $subscribe->save(); 
                }
            }*/
            $x = (string)$prod['size_qty'];
            if (!empty($x)) {
                $product = Product::findOrFail($prod['item']['id']);
                if (!empty($product->size_qty)) {
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    if (is_array($temp)) {
                        $temp1 = implode(',', $temp);
                        $product->size_qty = $temp1;
                    } else {

                        $product->size_qty = $temp;
                    }
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





        $country = Country::where('country_name', $request->customer_country)->first();

        $client = new Client([

            'headers' => [
                'Authorization' => 'Bearer ' . $gs->tap_auth_key,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]

        ]);

        $data = [
            'body' => '{
    "amount": ' . round(($request->total + $this->shipping_price) / $curr->value, 2) . ',
    "currency": "' . $curr->sign . '",
    "customer_initiated": true,
    "threeDSecure": true,
    "save_card": false,
    "description": "almuslhi order",
    "metadata": {"udf1": "Metadata 1"},
    "reference": {"transaction": "txn_' . $order->order_number . '", "order": "ord_' . $order->order_number . '"},
    "receipt": {"email": true},
    "customer": {"first_name": "' . $request->personal_name . '", "phone": {"country_code": ' . $country->phonecode . ', "number": "' . $request->phone . '"}},
    "source": {"id": "src_all"},
    "redirect": {"url": "' . route('tap.notify') . '"}
  }',

        ];

        // dd($data);

        $response = $client->request('POST', 'https://api.tap.company/v2/charges', $data);
        $result = $response->getBody()->getContents();
        $responseData = json_decode($result);
        $transactionUrl = $responseData->transaction->url;


        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        // Session::forget('cart');

        // Session::forget('already');
        // Session::forget('coupon');
        // Session::forget('free_shipping');
        // Session::forget('coupon_id');
        // Session::forget('coupon_total');
        // Session::forget('coupon_total1');
        // Session::forget('coupon_percentage');
        // Session::forget('coupon_product');
        // Session::forget('coupon_free');
        // Session::forget('coupon_free_color');
        // Session::forget('coupon_free_size');

        // Session::forget('coupon_piece');
        // Session::forget('coupon_piece_color');
        // Session::forget('coupon_piece_size');
        // Session::forget('coupon_pro');


        return redirect()->to($transactionUrl);
    }


    public function tapCallback(Request $request)
    {

        $input = $request->all();
        $gs = Generalsetting::findOrFail(1);

        $client = new Client([

            'headers' => [
                'Authorization' => 'Bearer ' . $gs->tap_auth_key,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]

        ]);


        $response = $client->request('GET', 'https://api.tap.company/v2/charges/' . $input['tap_id']);

        $getChargeResponse = $response->getBody()->getContents();
        $getChargeData = json_decode($getChargeResponse);

        $chargeStatusesArray = ['CANCELLED', 'FAILED', 'DECLINED'];
        // Check if the charge status is 'CANCELLED' or 'FAILED'
        if (in_array($getChargeData->status, $chargeStatusesArray)) {
            // Redirect back with an error message
            $data = DB::table('languages')->where('is_default', '=', 1)->first();

            return redirect()->route('front.checkout', $data->sign)->with('unsuccess', 'Payment not completed.');
        }



        $order = Session::get('temporder');

        $order->tap_order_id = $input['tap_id'];
        $order->order_completed = 1;
        $order->payment_status = 'Processing';
        $order->update();

        //Sending Email To Buyer - DISABLED (email removed)
        /*if ($gs->is_smtp == 1) {
            if (!empty($request->personal_email)) {
                $msg = "مرحبًا " . $order->customer_name . "!<br> لقد قمت بطلب طلب جديد.<br> رقم طلبك هو " . $order->order_number . ". يرجى الانتظار لتسليم طلبك.<br> شكرا لك.";
                $msgs = '<html><body>';
                $msgs = '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgs = $msg;
                $msgs .= "</table>";
                $msgs .= "</body></html>";
                $data = [
        
                    'subject' => "تم تقديم طلبك!",
                    'body' => $msgs,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMailToUser($data, $order->id);
            } else {

                $subject = "تم تقديم طلبك!";
                $msg = "مرحبًا " . $request->personal_name . "! \n لقد قمت بطلب طلب جديد.\n رقم طلبك هو " . $order->order_number . ". يرجى الانتظار لتسليم طلبك.\n شكرا لك.";
                $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                mail($to, $subject, $msg, $headers);
            }
        }*/



        //Sending Email To Admin
        if ($gs->is_smtp == 1) {
            $msg = "مرحباً أيها المسؤول!<br> تم استلام طلب جديد في متجرك. <br> رقم الطلب هو " . $order->order_number . " <br> اسم العميل : " . $order->customer_name . "<br>رقم هاتف العميل : " . $order->customer_phone . "<br> يرجى تسجيل الدخول إلى لوحة التحكم الخاصة بك للتحقق. <br> شكراً لك.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            $data = [
                'to' => $gs->email,
                'subject' => "تم استلام طلب جديد!!",
                'body' => $msg,
            ];


            $mailer = new GeniusMailer();
            $mailer->sendCustomMailToAdmin($data);
        } else {
            $to = $gs->email;
            $subject = "تم استلام طلب جديد!!";
            $msg = "مرحباً أيها المسؤول!\nتم استلام طلب جديد في متجرك.\nرقم الطلب هو " . $order->order_number . "\nاسم العميل : " . $order->customer_name . "\nرقم هاتف العميل : " . $order->customer_phone . "\nيرجى تسجيل الدخول إلى لوحة التحكم الخاصة بك للتحقق. \nشكراً لك.";
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            mail($to, $subject, $msg, $headers);
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


        $this->erporder($order);

        session()->forget(['request', 'payment_id']);

        Session::forget('cart');
        Session::forget('already');
        Session::forget('coupon');
        Session::forget('free_shipping');
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

        $this->erporder($order);

        $success_url = action('Front\PaymentController@payreturn');


        return redirect($success_url);
    }

    public function  gateway(Request $request)
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
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
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
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }



            /*  if(Session::has('coupon_get')){
            $take = Session::get('coupon_take');
            if($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get') ){
                $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
              
               $cart->items[$itemid]['qty'] = 5 ; 
            
               Session::put('cart',$cart);
               
            }
            
        }*/

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

            'address'   => 'required|min:5',
            'personal_name' => 'required|min:4',


        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $order = new Order;
        $success_url = action('Front\PaymentController@bankmasr');
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total)  / $curr->value, 2);
        $order['method'] = "Bank Misr";
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
        // $order['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //   $order['customer_zip'] = $request->zip;

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


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
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

        foreach ($cart->items as $prod) {


            /*  if($prod['item']['feature'] == 1){
                
               $subscribe = Subscribe::where('product_id',$prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id )->first(); 
                if(!empty($subscribe)){
                   if($subscribe->end_date != null){
                   if($prod['item']['subscription_type'] == "Days"){
                      $days = $prod['item']['subscription_period'] ;
                  }elseif($prod['item']['subscription_type'] == "Months"){
                      $days = $prod['item']['subscription_period'] * 30;
                  }else{
                      $days = $prod['item']['subscription_period'] * 365;
                  }  
                  
                  $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date. ' + '.$days.' days')) ;
                 
                  
                       
                   }
                   
                   $subscribe->order_id = $order->id; 
                   $subscribe->paid_via = "Cash"; 
                   $subscribe->update(); 
                  
                   
                }else{
                    
                    $subscribe = new Subscribe() ;
                    $subscribe->user_id = Auth::guard('web')->user()->id ;
                    $subscribe->product_id = $prod['item']['id'] ;
                    $subscribe->paid_via = "Cash"; 
                    $subscribe->package_details = "Gona Check it And be avaiible soon"; 
                    $subscribe->order_id = $order->id; 
                    $subscribe->package_price = $prod['price'] * $curr->value ; 
                    $subscribe->save(); 
                }
            }*/
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('free_shipping');
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

        return redirect($success_url);
    }



    public function  Nbe(Request $request)
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
            if ($prod['item']['free_ship'] != 1) {
                if ($pro['measure'] == "Gram") {
                    $weights += ($pro['scale'] / 1000) * $prod['qty'];
                } else {

                    $weights += $pro['scale'] * $prod['qty'];
                }
            }
            if ($pro->user_id == 0) {


                if (!$request->diff_address) {
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
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
                    $zone = \App\Models\Zone::where('name', $request->city)->orwhere('name_ar', $request->city)->first();
                    if ($zone) {
                        $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $zone->zone_id)->first();
                    } else {
                        $shippment_price = "";
                    }
                } else {
                    $shippment_price = ShipmentPrice::select('value', 'extra')->where('shipment_id', $request->shipment)->where('to', $request->shipping_city)->first();
                }
            }



            /*  if(Session::has('coupon_get')){
            $take = Session::get('coupon_take');
            if($prod['item']['id'] ==  Session::get('coupon_pro') && $prod['qty'] == Session::get('coupon_get') ){
                $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
              
               $cart->items[$itemid]['qty'] = 5 ; 
            
               Session::put('cart',$cart);
               
            }
            
        }*/

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

            'address'   => 'required|min:5',

            'personal_name' => 'required|min:4',

        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $order = new Order;
        $success_url = action('Front\PaymentController@NBE_payment');
        $item_name = $gs->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round(($request->total)  / $curr->value, 2);
        $order['method'] = "Natioinal Bank of Egypt";
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
        //['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //  $order['customer_zip'] = $request->zip;

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


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
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

        foreach ($cart->items as $prod) {


            /*  if($prod['item']['feature'] == 1){
                
               $subscribe = Subscribe::where('product_id',$prod['item']['id'])->where('user_id', Auth::guard('web')->user()->id )->first(); 
                if(!empty($subscribe)){
                   if($subscribe->end_date != null){
                   if($prod['item']['subscription_type'] == "Days"){
                      $days = $prod['item']['subscription_period'] ;
                  }elseif($prod['item']['subscription_type'] == "Months"){
                      $days = $prod['item']['subscription_period'] * 30;
                  }else{
                      $days = $prod['item']['subscription_period'] * 365;
                  }  
                  
                  $subscribe->end_date = date('Y-m-d', strtotime($subscribe->end_date. ' + '.$days.' days')) ;
                 
                  
                       
                   }
                   
                   $subscribe->order_id = $order->id; 
                   $subscribe->paid_via = "Cash"; 
                   $subscribe->update(); 
                  
                   
                }else{
                    
                    $subscribe = new Subscribe() ;
                    $subscribe->user_id = Auth::guard('web')->user()->id ;
                    $subscribe->product_id = $prod['item']['id'] ;
                    $subscribe->paid_via = "Cash"; 
                    $subscribe->package_details = "Gona Check it And be avaiible soon"; 
                    $subscribe->order_id = $order->id; 
                    $subscribe->package_price = $prod['price'] * $curr->value ; 
                    $subscribe->save(); 
                }
            }*/
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

        Session::put('temporder', $order);
        Session::put('tempcart', $cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('free_shipping');
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

        return redirect($success_url);
    }


    public function  fawrypaymentt(Request $request)
    {
        $input = $request->all();
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

        $gs = Generalsetting::findOrFail(1);
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success', "You don't have any product to checkout.");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        foreach ($cart->items as $key => $prod) {
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
        $validator = Validator::make($request->all(), [

            'address'   => 'required|min:5',

            'personal_name' => 'required|min:4',

        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $success_url = action('Front\PaymentController@fawry_paymentz');
        $item_name = $settings->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($request->total / $curr->value, 2);
        $order['method'] = "Fawry";
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['order_completed'] = 0;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = $request->phone;
        //$order['order_number'] = str_random(4).time();

        $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
        }






        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //  $order['customer_zip'] = $request->zip;

        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['txnid'] = $request->txn_id4;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['wallet'] = $request->wallet_cost;
        if (!empty($request->user_id)) {
            if ($request->wallet_cost && $request->wallet_cost > 0) {
                $user = User::find($request->user_id);
                $user->refunds -= $request->wallet_cost / $curr->value;
                $user->points += round($request->total / $curr->value);
                $user->update();
            }
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
                if (is_array($temp)) {
                    $temp1 = implode(',', $temp);
                    $product->size_qty = $temp1;
                } else {

                    $product->size_qty = $temp;
                }
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
        Session::forget('free_shipping');
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
                'to' => $request->personal_email,
                'type' => "new_order",
                'cname' => $request->personal_name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
                'onumber' => $order->order_number,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoOrderMail($data, $order->id);
        } else {

            $subject = "Your Order Placed!!";
            $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
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

        return redirect($success_url);
    }




    public function  paypal(Request $request)
    {
        $input = $request->all();
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

        $gs = Generalsetting::findOrFail(1);
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success', "You don't have any product to checkout.");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        foreach ($cart->items as $key => $prod) {
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
        $validator = Validator::make($request->all(), [

            'address'   => 'required|min:5',
            'personal_name' => 'required|min:4',


        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $success_url = action('Front\PaypalController@payWithPaypal');
        $item_name = $settings->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($request->total / $curr->value, 2);
        $order['method'] = "Paypal";
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['order_completed'] = 0;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = $request->phone;
        //$order['order_number'] = str_random(4).time();

        $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {

            $order['order_number'] = $last_row->order_number + 1;
        }






        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //  $order['customer_zip'] = $request->zip;

        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['txnid'] = $request->txn_id4;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['wallet'] = $request->wallet_cost;
        if (!empty($request->user_id)) {
            if ($request->wallet_cost && $request->wallet_cost > 0) {
                $user = User::find($request->user_id);
                $user->refunds -= $request->wallet_cost / $curr->value;
                $user->points += round($request->total / $curr->value);
                $user->update();
            }
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
                if (is_array($temp)) {
                    $temp1 = implode(',', $temp);
                    $product->size_qty = $temp1;
                } else {

                    $product->size_qty = $temp;
                }
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
        Session::forget('free_shipping');
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
                'to' => $request->personal_email,
                'type' => "new_order",
                'cname' => $request->personal_name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
                'onumber' => $order->order_number,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoOrderMail($data, $order->id);
        } else {

            $subject = "Your Order Placed!!";
            $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
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
        return redirect($success_url);
    }

    public function   vapulus(Request $request)
    {
        $input = $request->all();
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

        $gs = Generalsetting::findOrFail(1);
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success', "You don't have any product to checkout.");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        foreach ($cart->items as $key => $prod) {
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
        $validator = Validator::make($request->all(), [

            'address'   => 'required|min:5',
            'personal_name' => 'required|min:4',


        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $success_url = action('Front\PaymentController@vapulus');
        $item_name = $settings->title . " Order";
        $item_number = str_random(4) . time();
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($request->total / $curr->value, 2);
        $order['method'] = "vapulus";
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;

        $order['customer_name'] = $request->personal_name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['order_completed'] = 0;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = $request->phone;
        //$order['order_number'] = str_random(4).time();

        $last_row = DB::table('orders')->orderBy('id', 'DESC')->first();


        if ($last_row->order_number == 0) {
            $order['order_number'] = 1;
        } else {


            $order['order_number'] = $last_row->order_number + 1;
        }


        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        //  $order['customer_zip'] = $request->zip;

        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['txnid'] = $request->txn_id4;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['wallet'] = $request->wallet_cost;
        if (!empty($request->user_id)) {
            if ($request->wallet_cost && $request->wallet_cost > 0) {
                $user = User::find($request->user_id);
                $user->refunds -= $request->wallet_cost / $curr->value;
                $user->points += round($request->total / $curr->value);
                $user->update();
            }
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
                if (is_array($temp)) {
                    $temp1 = implode(',', $temp);
                    $product->size_qty = $temp1;
                } else {

                    $product->size_qty = $temp;
                }
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
        Session::forget('free_shipping');
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
                'to' => $request->personal_email,
                'type' => "new_order",
                'cname' => $request->personal_name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
                'onumber' => $order->order_number,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoOrderMail($data, $order->id);
        } else {

            $subject = "Your Order Placed!!";
            $msg = "Hello " . $request->personal_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
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

        return redirect($success_url);
    }

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

    public  function  cities(Request $request)
    {
        $c = DB::table('countries')->where('country_name', $request->id)->first();
        $zones = \App\Models\Zone::where('country_id', $c->id)->where('status', '=', 1)->get();
        $data = view('front.city', compact('zones'))->render();

        return response()->json(['options' => $data]);
    }
    public  function  citiess(Request $request)
    {
        $c = DB::table('countries')->where('country_name', $request->id)->first();
        $zones = \App\Models\Zone::where('country_id', $c->id)->where('zone_id', '=', null)->where('status', '=', 1)->get();
        $data = view('front.cities', compact('zones'))->render();

        return response()->json(['options' => $data]);
    }


    public  function  phoneNumbers(Request $request)
    {
        $c = DB::table('countries')->where('country_name', $request->id)->first();

        return response()->json(['options' => $c->phone_numbers]);
    }

    public  function shipmentss(Request $request)
    {
        $shipments = [];
        //   $city = \App\Models\Country::Where(function ($query) use ($request) {
        $city = \App\Models\Zone::Where(function ($query) use ($request) {
            $query->where('name', $request->id)->orwhere('name_ar', $request->id);
        })->where('zone_id', '!=', null)->first();
        if ($city) {
            $zone =  ShipmentZone::find($city->zone_id);

            $c = ShipmentPrice::where('to', $city->zone_id)->pluck('shipment_id');
            $shipments = Shipment::whereIn('id', $c)->orderby('id', 'desc')->get();
        } else {
            $shipments = [];
        }
        $dataa = view('shipment', compact('shipments'))->render();


        return response()->json(['options' => $dataa]);
    }


    public  function shipments(Request $request)
    {

        //    $city = \App\Models\Country::Where(function ($query) use ($request) {
        $city = \App\Models\Zone::Where(function ($query) use ($request) {
            $query->where('name', $request->id)->orwhere('name_ar', $request->id);
        })->where('zone_id', '!=', null)->first();
        if ($city) {
            $shipment = ShipmentPrice::where('to', $city->zone_id)->first();
        } else {
            $shipment = '';
        }
        $products = $request->product;

        $dataa = view('shipmentz', compact('shipment', 'products'))->render();

        if (Session::has('free_shipping')) {
            $dataa = [];

            return response()->json(['options' => 0]);
        } else {
            return response()->json(['options' => $dataa]);
        }
    }



    public function cancelpayment($lang)
    {
        $id = DB::table('languages')->where('sign', '=', $lang)->first();
        if ($id) {
            Session::put('language', $id->id);
        } else {
            $data = DB::table('languages')->where('is_default', '=', 1)->first();
            Session::put('language', $data->id);
        }

        return view('front.completepayment');
    }


    public function editfinalorder($id, Request $request)
    {


        $order = Order::find($id);
        $order->order_completed = 1;
        $order->payment_status = "paid";
        $order->save();

        \Session::flash('message', 'orders checkout  successfully ');

        return view('front.checkout_purchase', compact('order'));
    }

    public function editthawaniorders($id, Request $request)
    {

        $order = Order::find($id);
        $oldCart = Session::get('tempcart');
        $cart = new Cart($oldCart);

        $gs = Generalsetting::findOrFail(1);
        if ($gs->is_smtp == 1) {


            $msg = "Hello " . $order->customer_name . "!<br> You have placed a new order.<br>Your order number is " . $order->order_number . ".Please wait for your delivery. <br>Thank you.";
            $msgs = '<html><body>';
            $msgs = '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $msgs = $msg;
            $msgs .= "</table>";
            $msgs .= "</body></html>";
            $data = [

                'subject' => "Your Order Placed!!",
                'body' => $msgs,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        } else {

            $subject = "Your Order Placed!!";
            $msg = "Hello " . $order->customer_name . "!\nYou have placed a new order.\nYour order number is " . $order->order_number . ".Please wait for your delivery. \nThank you.";
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

        $pay_ref = Session::get('number');

        $payy = array(

            "merchant_reference" => $pay_ref,
            "limit" => "50",
            "skip" => "1",


        );


        $d = $payy;

        $data = json_encode($d);
        $client = new Client([

            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer NtAVpmLXQVNsKIa2d4Bb8pZiVUuG5WzU4R6p/1wq7R4='
            ]

        ]);

        $response = $client->post(
            'https://thirdparty.thawani.om/api/TransactionHistory/',

            ['body' => $data]


        );

        $key2 = json_decode($response->getBody(), true);

        if ($key2[0]['status'] == "failed") {

            return redirect('https://version2.vooecommerce.com/cancelpayment');
        } else {


            $order->order_completed = 1;
            $order->payment_status = "Completed";
            $order->save();

            return view('front.checkout_purchase', compact('order', 'key2'));
        }
    }





    public  function colorss(Request $request)
    {


        $colorss = Color::where('product_id', $request->idd)->where('size', $request->size)->where('size_qty', '>', 0)->get();
        $data = view('colors', compact('colorss'))->render();

        return response()->json(['option' => $data]);
    }

    public  function addressscity(Request $request)
    {

        $city = $request->city;
        $addresses = Address::where('user_id', Auth::guard('web')->user()->id)->where('city', $request->city)->get();
        $data = view('address', compact('addresses'))->render();

        return response()->json(['option' => $data]);
    }

    public  function getAddressForCheckout(Request $request)
    {

        $addressCheck = $request->id;
        if (is_numeric($addressCheck)) {
            // Get the address details from the database
            $address = Address::find($addressCheck);

            // Update the customer's country and city inputs
            // dd([
            //     'country' => $address->country,
            //     'city' => $address->city
            // ]);

            // Return the country and city from the address
            return response()->json([
                'country' => $address->country,
                'city' => $address->city,
                'address' => $address->address
            ]);
        } else {




            // Return the country and city from the user's address
            return response()->json([
                'country' => Auth::guard('web')->user()->country,
                'city' => Auth::guard('web')->user()->city,
                'address' => Auth::guard('web')->user()->address
            ]);
        }
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



    public function checkCityAllowCash(Request $request)
    {
        $cityName = $request->input('id');
        $city = \App\Models\Zone::where('name_ar', $cityName)->orWhere('name', $cityName)->first();
        // dd($city->allow_cash);
        if ($city->allow_cash == "on") {
            return response()->json(['allowCashPayment' => true]);
        } else {
            return response()->json(['allowCashPayment' => false]);
        }
    }
}
