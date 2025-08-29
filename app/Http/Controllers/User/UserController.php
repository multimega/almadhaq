<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Subscription;
use App\Models\Generalsetting;
use App\Models\UserSubscription;
use App\Models\FavoriteSeller;
use App\Models\Coupon;
use App\Models\Notifications;
use App\Models\Point;
use App\Models\PointPiece;
use App\Models\Address;
use App\Models\Propiece;
use App\Models\PointFree;
use App\Models\Profree;
use App\Models\Piece;
use App\Models\Free;
use App\Models\Referral;
use Session;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }
    public function index_34()
    {
        $user = Auth::user();
        return view('user.dashboard_34', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    public function profile_34()
    {
        $user = Auth::user();
        return view('user.profile_34', compact('user'));
    }

    public function wallet()
    {
        $user = Auth::user();
        return view('user.wallet', compact('user'));
    }
    public function wallet_34()
    {
        $user = Auth::user();
        return view('user.wallet_34', compact('user'));
    }
    public function refelar()
    {
        $user = Auth::user();
        $ref = Referral::where('user_id', Auth::user()->id)->first();
        return view('user.refelar', compact('user', 'ref'));
    }
    public function refelar_34()
    {
        $user = Auth::user();
        $ref = Referral::where('user_id', Auth::user()->id)->first();
        return view('user.refelar_34', compact('user', 'ref'));
    }
    public function notifications()
    {
        $user = Auth::user();
        $notifications = Notifications::where('user_id', Auth::user()->id)->orderby('id', 'desc')->take(70)->get();
        return view('user.notifications', compact('user', 'notifications'));
    }
    public function notifications_34()
    {
        $user = Auth::user();
        $notifications = Notifications::where('user_id', Auth::user()->id)->orderby('id', 'desc')->take(70)->get();
        return view('user.notifications_34', compact('user', 'notifications'));
    }

    public function points()
    {
        $user = Auth::user();
        $id = Auth::user()->id;
        $coupons = Point::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();

        $piececoupons = PointPiece::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();

        $freecoupons = PointFree::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();

        return view('user.points', compact('user', 'coupons', 'piececoupons', 'freecoupons'));
    }

    public function points_34()
    {
        $user = Auth::user();
        $id = Auth::user()->id;
        $coupons = Point::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();

        $piececoupons = PointPiece::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();

        $freecoupons = PointFree::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();

        return view('user.points_34', compact('user', 'coupons', 'piececoupons', 'freecoupons'));
    }

    public function promocodes()
    {

        $id = Auth::user()->id;
        $mytime = Carbon::now()->toDateTimeString();
        $coupons = Coupon::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();
        $pieces = Piece::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();
        $free = Free::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();
        $ref = Referral::where('user_id', Auth::user()->id)->where('status', 1)->get();

        $user = Auth::user();
        return view('user.coupons', compact('user', 'coupons', 'mytime', 'pieces', 'free', 'ref'));
    }
    public function promocodes_34()
    {

        $id = Auth::user()->id;
        $mytime = Carbon::now()->toDateTimeString();
        $coupons = Coupon::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();
        $pieces = Piece::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();
        $free = Free::where('status', 1)
            ->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id)
                    ->orWhere('user_id', '=', null);
            })->get();
        $ref = Referral::where('user_id', Auth::user()->id)->where('status', 1)->get();

        $user = Auth::user();
        return view('user.coupons_34', compact('user', 'coupons', 'mytime', 'pieces', 'free', 'ref'));
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section
        $rules =
            [
                'photo' => 'mimes:jpeg,jpg,png,svg'
            ];

        $validator = Validator::make($request->all(), $rules);
        // dd($validator);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = Auth::user();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('assets/images/users/', $name);
            if ($data->photo != null) {
                if (file_exists(public_path() . '/assets/images/users/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/users/' . $data->photo);
                }
            }
            $input['photo'] = $name;
        }
        $data->update($input);
        $msg = 'Successfully updated your profile';
        return response()->json($msg);
    }

    public function pointscoupon($id)
    {
        //--- Validation Section
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $user_points = Auth::user()->points;
        $point = Point::find($id);
        $mytime = Carbon::now();

        if ($user_points < $point->points) {
            $slang = Session::get('language');

            $lang  = DB::table('languages')->where('is_default', '=', 1)->first();

            if (!$slang) {
                if ($lang->id == 2) {
                    return back()->withErrors('نقاطك غير كافية ');
                } else {
                    return back()->withErrors('Your Points Not Enough');
                }
            } else {
                if ($slang == 2) {
                    return back()->withErrors('نقاطك غير كافية ');
                } else {
                    return back()->withErrors('Your Points Not Enough');
                }
            }
        }

        $coupon = new Coupon();
        $coupon->code = $point->code;
        $coupon->type = $point->type;
        $coupon->price = $point->price;
        $coupon->photo = $point->photo;
        $coupon->rand = rand();
        $coupon->limited = $point->limited;
        $coupon->times = $point->times;

        $coupon->start_date = date('Y-m-d', strtotime($mytime));
        $coupon->end_date = date('Y-m-d', strtotime($mytime . ' + ' . $point->days . ' days'));
        $coupon->user_id = $user_id;
        $coupon->save();


        $user->points -= $point->points;
        $user->update();

        $point->used += 1;
        $point->update();

        $slang = Session::get('language');

        $lang  = DB::table('languages')->where('is_default', '=', 1)->first();

        if (!$slang) {
            if ($lang->id == 2) {
                $msg = 'تم شراء الكوبون بنجاح';
            } else {
                $msg = 'Successfully Buy Coupon';
            }
        } else {
            if ($slang == 2) {
                $msg = 'تم شراء الكوبون بنجاح';
            } else {
                $msg = 'Successfully Buy Coupon';
            }
        }


        return back()->with('success', $msg);
    }


    public function piececoupon($id)
    {
        //--- Validation Section
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $user_points = Auth::user()->points;
        $point = PointPiece::find($id);
        $mytime = Carbon::now();

        if ($user_points < $point->points) {

            $slang = Session::get('language');

            $lang  = DB::table('languages')->where('is_default', '=', 1)->first();

            if (!$slang) {
                if ($lang->id == 2) {
                    return back()->withErrors('نقاطك غير كافية ');
                } else {
                    return back()->withErrors('Your Points Not Enough');
                }
            } else {
                if ($slang == 2) {
                    return back()->withErrors('نقاطك غير كافية ');
                } else {
                    return back()->withErrors('Your Points Not Enough');
                }
            }
        }

        $coupon = new Piece();
        $coupon->code = $point->code;
        $coupon->photo = $point->photo;
        $coupon->times = $point->times;
        $coupon->buy = $point->buy;
        $coupon->take = $point->take;
        $coupon->rand = rand();
        $coupon->start_date = date('Y-m-d', strtotime($mytime));
        $coupon->end_date = date('Y-m-d', strtotime($mytime . ' + ' . $point->days . ' days'));
        $coupon->user_id = $user_id;
        $coupon->save();

        $pro = new Propiece();
        $pro->product_id = $point->product_id;
        $pro->code_id = $coupon->id;
        $pro->save();



        $user->points -= $point->points;
        $user->update();

        $point->used += 1;
        $point->update();

        $slang = Session::get('language');

        $lang  = DB::table('languages')->where('is_default', '=', 1)->first();

        if (!$slang) {
            if ($lang->id == 2) {
                $msg = 'تم شراء الكوبون بنجاح';
            } else {
                $msg = 'Successfully Buy Coupon';
            }
        } else {
            if ($slang == 2) {
                $msg = 'تم شراء الكوبون بنجاح';
            } else {
                $msg = 'Successfully Buy Coupon';
            }
        }
        return back()->with('success', $msg);
    }

    public function freecoupon($id)
    {
        //--- Validation Section
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $user_points = Auth::user()->points;
        $point = PointFree::find($id);
        $mytime = Carbon::now();

        if ($user_points < $point->points) {
            $slang = Session::get('language');

            $lang  = DB::table('languages')->where('is_default', '=', 1)->first();

            if (!$slang) {
                if ($lang->id == 2) {
                    return back()->withErrors('نقاطك غير كافية ');
                } else {
                    return back()->withErrors('Your Points Not Enough');
                }
            } else {
                if ($slang == 2) {
                    return back()->withErrors('نقاطك غير كافية ');
                } else {
                    return back()->withErrors('Your Points Not Enough');
                }
            }
        }

        $coupon = new Free();
        $coupon->code = $point->code;
        $coupon->times = $point->times;
        $coupon->photo = $point->photo;
        $coupon->rand = rand();
        $coupon->start_date = date('Y-m-d', strtotime($mytime));
        $coupon->end_date = date('Y-m-d', strtotime($mytime . ' + ' . $point->days . ' days'));
        $coupon->user_id = $user_id;
        $coupon->save();

        $pro = new Profree();
        $pro->product_id = $point->product_id;
        $pro->code_id = $coupon->id;
        $pro->save();


        $user->points -= $point->points;
        $user->update();

        $point->used += 1;
        $point->update();

        $slang = Session::get('language');

        $lang  = DB::table('languages')->where('is_default', '=', 1)->first();

        if (!$slang) {
            if ($lang->id == 2) {
                $msg = 'تم شراء الكوبون بنجاح';
            } else {
                $msg = 'Successfully Buy Coupon';
            }
        } else {
            if ($slang == 2) {
                $msg = 'تم شراء الكوبون بنجاح';
            } else {
                $msg = 'Successfully Buy Coupon';
            }
        }
        return back()->with('success', $msg);
    }




    public function resetform()
    {
        return view('user.reset');
    }
    public function resetform_34()
    {
        return view('user.reset_34');
    }

    public function reset(Request $request)
    {
        $user = Auth::user();

        if (empty($user->password)) {

            if ($request->newpass == $request->renewpass) {
                $input['password'] = Hash::make($request->newpass);
            } else {
                return response()->json(array('errors' => [0 => 'Confirm password does not match.']));
            }
        } else {

            if ($request->cpass) {
                if (Hash::check($request->cpass, $user->password)) {
                    if ($request->newpass == $request->renewpass) {
                        $input['password'] = Hash::make($request->newpass);
                    } else {
                        return response()->json(array('errors' => [0 => 'Confirm password does not match.']));
                    }
                } else {
                    return response()->json(array('errors' => [0 => 'Current password Does not match.']));
                }
            }
        }

        $user->update($input);
        $msg = 'Successfully change your passwprd';
        return response()->json($msg);
    }


    public function package()
    {
        $user = Auth::user();
        $subs = Subscription::all();
        $package = $user->subscribes()->where('status', 1)->orderBy('id', 'desc')->first();
        return view('user.package.index', compact('user', 'subs', 'package'));
    }


    public function vendorrequest($id)
    {
        $subs = Subscription::findOrFail($id);
        $gs = Generalsetting::findOrfail(1);
        $user = Auth::user();
        $package = $user->subscribes()->where('status', 1)->orderBy('id', 'desc')->first();
        if ($gs->reg_vendor != 1) {
            return redirect()->back();
        }
        return view('user.package.details', compact('user', 'subs', 'package'));
    }

    public function vendorrequestsub(Request $request)
    {
        $this->validate($request, [
            'shop_name'   => 'unique:users',
        ], [
            'shop_name.unique' => 'This shop name has already been taken.'
        ]);
        $user = Auth::user();
        $package = $user->subscribes()->where('status', 1)->orderBy('id', 'desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
        $today = Carbon::now()->format('Y-m-d');
        $input = $request->all();
        $user->is_vendor = 2;
        $user->date = date('Y-m-d', strtotime($today . ' + ' . $subs->days . ' days'));
        $user->mail_sent = 1;
        $user->update($input);
        $sub = new UserSubscription;
        $sub->user_id = $user->id;
        $sub->subscription_id = $subs->id;
        $sub->title = $subs->title;
        $sub->currency = $subs->currency;
        $sub->currency_code = $subs->currency_code;
        $sub->price = $subs->price;
        $sub->days = $subs->days;
        $sub->allowed_products = $subs->allowed_products;
        $sub->details = $subs->details;
        $sub->method = 'Free';
        $sub->status = 1;
        $sub->save();
        if ($settings->is_smtp == 1) {
            $data = [
                'to' => $user->email,
                'type' => "vendor_accept",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => "",
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);
        } else {
            $headers = "From: " . $settings->from_name . "<" . $settings->from_email . ">";
            mail($user->email, 'Your Vendor Account Activated', 'Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.', $headers);
        }

        return redirect()->route('user-dashboard')->with('success', 'Vendor Account Activated Successfully');
    }


    public function favorite($id1, $id2)
    {
        $fav = new FavoriteSeller();
        $fav->user_id = $id1;
        $fav->vendor_id = $id2;
        $fav->save();
    }

    public function favorites()
    {
        $user = Auth::guard('web')->user();
        $favorites = FavoriteSeller::where('user_id', '=', $user->id)->get();
        return view('user.favorite', compact('user', 'favorites'));
    }
    public function favorites_34()
    {
        $user = Auth::guard('web')->user();
        $favorites = FavoriteSeller::where('user_id', '=', $user->id)->get();
        return view('user.favorite_34', compact('user', 'favorites'));
    }


    public function favdelete($id)
    {
        $wish = FavoriteSeller::findOrFail($id);
        $wish->delete();
        return redirect()->route('user-favorites')->with('success', 'Successfully Removed The Seller.');
    }


    public function address(Request $request)
    {


        $address = Address::where('user_id', Auth::user()->id)->get();
        return view('user.address', compact('address'));
    }
    public function address_34(Request $request)
    {


        $address = Address::where('user_id', Auth::user()->id)->get();
        return view('user.address_34', compact('address'));
    }

    public function addressdelete($id)
    {
        $add =  Address::findOrfail($id);

        $add->delete();
        $msg = 'Address Deleted Successfully  ';
        return redirect()->route('user-address')->with('success', $msg);
    }
    public function addressdelete_34($id)
    {
        $add =  Address::findOrfail($id);

        $add->delete();
        $msg = 'Address Deleted Successfully  ';
        return redirect()->route('user-address-34')->with('success', $msg);
    }


    public function addressstore(Request $request)
    {


        //--- Validation Section Ends

        $data = new Address;
        $data->user_id = Auth::user()->id;
        $data->country = $request->country;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->phone = $request->phone;

        $data->save();
        $msg = 'Successfully Added your Address';
        return redirect()->route('user-address')->with('success', $msg);
    }
    public function addressstore_34(Request $request)
    {


        //--- Validation Section Ends

        $data = new Address;
        $data->user_id = Auth::user()->id;
        $data->country = $request->country;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->phone = $request->phone;

        $data->save();
        $msg = 'Successfully Added your Address';
        return redirect()->route('user-address-34')->with('success', $msg);
    }

    public function addressupdate($id, Request $request)
    {


        //--- Validation Section Ends
        $input = $request->all();
        $data = Address::find($id);

        $data->country = $request->country;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->update();
        $msg = 'Successfully Updated your Address';
        return redirect()->route('user-address')->with('success', $msg);
    }

    public function addressupdate_34($id, Request $request)
    {


        //--- Validation Section Ends
        $input = $request->all();
        $data = Address::find($id);

        $data->country = $request->country;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->update();
        $msg = 'Successfully Updated your Address';
        return redirect()->route('user-address-34')->with('success', $msg);
    }
}
