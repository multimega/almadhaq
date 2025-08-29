<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Rating;
use App\Classes\GeniusMailer;
use App\Models\Wishlist;
use App\Models\Referral;
use App\Models\Generalsetting;
use Validator;
use Session;
use App\SendCode;
use App\Models\Currency;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public $successStatus = 200;

    public function signup(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        /*     $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'phone' => 'required|numeric',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);*/

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|numeric',
            'country' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $curr = Currency::where('is_default', '=', 1)->first();
        $input = $request->all();



        $input['password'] = bcrypt($input['password']);
        $input['currency'] = $curr->id;
        $input['affilate_code'] = str_random(6) . rand(123456, 999999);

        if ($request->refelar_code) {
            $ref = Referral::where('code', $request->refelar_code)->first();
            if ($ref) {
                $ref->times += 1;
                $ref->update();
                $u =  User::where('id', $ref->user_id)->first();
                if ($u) {
                    $u->points +=  $gs->refelar_points;
                    $u->update();

                    $input['points'] = $gs->refelar_points;
                    $input['ref'] = $ref->user_id;
                }
            } else {

                return response()->json(array('status' => 'false', 'message' => 'Referral Code Not True'));
            }
        }

        $user = User::create($input);

        $refelar = new Referral;
        $refelar->user_id = $user->id;
        $refelar->rand = rand(123, 999999);
        $refelar->code = str_random(6) . rand(123456, 999999);
        $refelar->save();

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['id'] =  $user->id;
        $success['phone'] =  $user->phone;


        return response()->json(['success' => $success], $this->successStatus);
    }


    public function phoneregister(Request $request)
    {

        $gs = Generalsetting::findOrFail(1);
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'name' => 'required',
            'phonecode' => 'required',
            // 'country' => 'required',


        ], [
            'phone.required' => 'phone number field is required.',
            'phone.numeric' => 'phone number field must be Number',
            'phone.unique' => 'phone number already taked',


        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $curr = Currency::where('is_default', '=', 1)->first();
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['currency'] = $curr->id;
        $input['phone'] = $input['phonecode'] . $input['phone'];
        $input['affilate_code'] = str_random(6) . rand(123456, 999999);

        if ($request->refelar_code) {
            $ref = Referral::where('code', $request->refelar_code)->first();
            if ($ref) {
                $ref->times += 1;
                $ref->update();
                $u =  User::where('id', $ref->user_id)->first();
                if ($u) {
                    $u->points +=  $gs->refelar_points;
                    $u->update();

                    $input['points'] = $gs->refelar_points;
                    $input['ref'] = $ref->user_id;
                }
            } else {

                return response()->json(array('status' => 'false', 'message' => 'Referral Code Not True'));
            }
        }
        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['id'] =  $user->id;
        $success['phone'] =  $user->phone;

        if ($user) {
            $user->code = SendCode::sendcode($request->phone, $request->phonecode);
            $user->status = 1;
            $user->save();

            $refelar = new Referral;
            $refelar->user_id = $user->id;
            $refelar->rand = rand(123, 999999);
            $refelar->code = str_random(6) . rand(123456, 999999);
            $refelar->save();
        }


        return response()->json(['success' => $success], $this->successStatus);
    }

    public function phoneverify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric',


        ], [
            'code.required' => 'code field is required.',



        ]);
        if (!$validator->passes()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        }
        if ($user = User::where('code', $request->code)->first()) {
            $user->status = 0;
            $user->email_verified = "Yes";
            $user->code = null;
            $user->save();
            $success['success'] = "your account is Activated";
            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return response()->json(array('status' => 'true', 'message' => $success));
        } else {

            return response()->json(array('status' => 'false', 'message' => 'verify code not correct please try again'));
        }
    }



    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['name' => request('name'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['phone'] =  $user->phone;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function phonelogin()
    {

        if (is_numeric(request('phone'))) {
            if (Auth::attempt(['phone' => request('phone'), 'password' => request('password'), 'status' => 0])) {
                $user = Auth::user();
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['id'] =  $user->id;
                $success['name'] =  $user->name;
                $success['phone'] =  $user->phone;
                return response()->json(['success' => $success], $this->successStatus);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }



    /* 
      public function login(Request $request)
    {
       
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
            
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }*/
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        if (Auth::guard('api')->user()) {
            Auth::guard('api')->user()->token()->revoke();
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }


    public function forgetpass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric',
            'phonecode' => 'required',


        ], [
            'phone.required' => 'Phone field is required.',



        ]);
        if (!$validator->passes()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        }
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $user->code = SendCode::sendcode($user->phone, $request->phonecode);
            $user->save();

            return response()->json(array('status' => 'true', 'message' => 'Code Has Been Sent'));
        } else {

            return response()->json(array('status' => 'false', 'message' => 'Phone Number Not Correct Please Try Again.'));
        }
    }


    public function phonepass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric',

        ], [
            'code.required' => 'code field is required.',



        ]);
        if (!$validator->passes()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        }
        /*if(Auth::attempt(['code' => $request->code , 'active' => 1])){
                 $user = Auth::user();
                 $user->code = null;
                 $user->save() ;
            return response()->json(array('status' =>'true', 'message'=>'your account is Activated to change password'));
        }
           else{
                return response()->json(array('status' =>'false', 'message'=>'verify code not correct please try again'));
        }  */

        if ($user = User::where('code', $request->code)->first()) {
            Auth::login($user);
            $success['token'] =  $user->createToken('MyApp')->accessToken;


            $user->status = 0;
            $user->code = null;
            $user->save();

            return response()->json(array('status' => 'true', 'message' => 'your account is Activated to change password', 'success' => $success), $this->successStatus);
        } else {

            return response()->json(array('status' => 'false', 'message' => 'verify code not correct please try again'));
        }
    }


    public function forgetpasses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',

        ], []);

        if (!$validator->passes()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['phone'] =  $user->phone;
        $success['id'] =  $user->id;
        return response()->json(['message' => 'password changed', 'success' => $success], $this->successStatus);
        //   return response()->json(array('status' =>'true', 'message'=>'password changed'));



    }
    public function changepass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',

        ], []);

        if (!$validator->passes()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(array('status' => 'true', 'message' => 'password changed'));
    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {

        $user = User::where('id', Auth::user()->id)->first();
        return response([
            "success" => true,
            "message" => "The users information",
            'info' => $user,
            'address' =>  Address::where('user_id', Auth::user()->id)->get(),
            'orders' => count(Order::where('user_id', Auth::user()->id)->get()),
            'wishlists' => count(Wishlist::where('user_id', Auth::user()->id)->get()),

            'comments' =>  count(Comment::where('user_id', Auth::user()->id)->get()),
            'replies' =>  count(Reply::where('user_id', Auth::user()->id)->get()),
        ], 200);
        /*return response()->json($request->user());*/
    }

    // user profile 

    public function profile()
    {
        $user = auth('api')->user();
        return response()->json(array('status' => 'Ok', 'user' => $user));
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

        return response()->json(array('status' => 'Ok', 'user' => $user, 'coupons' => $coupons, 'piececoupons' => $piececoupons, 'freecoupons' => $freecoupons));
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
        return response()->json(array('status' => 'Ok', 'user' => $user, 'coupons' => $coupons, 'mytime' => $mytime, 'pieces' => $pieces, 'free' => $free, 'ref' => $ref));
    }

    public function usewallet()
    {




        $user = Auth::user();
        if ($user->wallet_status == 1) {
            $user->wallet_status = 0;
            $user->save();

            return response()->json(array('status' => 'Ok', 'wallet' => "Not use wallet"));
        } else {
            $user->wallet_status = 1;
            $user->save();

            return response()->json(array('status' => 'Ok', 'wallet' => "use wallet"));
        }
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section
        // dd($request);
        $rules =
            [
                'photo' => 'mimes:jpeg,jpg,png,svg'
            ];


        $validator = Validator::make($request->all(), $rules);

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
        // return response()->json($msg); 
        return response()->json(array('message' => $msg, "status" => "ok"));
    }

    // public function pointscoupon($id)
    // {
    //     //--- Validation Section
    //     $user = Auth::user();       
    //       $user_id = Auth::user()->id ;
    //       $user_points = Auth::user()->points ;
    //         $point = Point::find($id);
    //       $mytime = Carbon::now();

    //     if ($user_points < $point->points) {
    //       return back()->withErrors('Your Points Not Enough');
    //     }

    //     $coupon = new Coupon();
    //     $coupon->code = $point->code;
    //     $coupon->type = $point->type;
    //     $coupon->price = $point->price;
    //     $coupon->photo = $point->photo;
    //     $coupon->rand = rand();
    //     $coupon->limited = $point->limited;
    //     $coupon->times = $point->times;

    //     $coupon->start_date = date('Y-m-d', strtotime($mytime)) ;
    //     $coupon->end_date = date('Y-m-d', strtotime($mytime. ' + '.$point->days.' days')) ;
    //     $coupon->user_id = $user_id;
    //     $coupon->save();


    //     $user->points -= $point->points; 
    //     $user->update();

    //     $point->used += 1;
    //     $point->update();

    //     $msg = 'Successfully Buy Coupon';
    //   return back()->with('success',$msg);
    // }   


    public function piececoupon($id)
    {
        //--- Validation Section
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $user_points = Auth::user()->points;
        $point = PointPiece::find($id);
        $mytime = Carbon::now();

        if ($user_points < $point->points) {
            return back()->withErrors('Your Points Not Enough');
        }

        $coupon = new Piece();
        $coupon->code = $point->code;
        $coupon->photo = $point->photo;
        $coupon->times = $point->times;
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

        $msg = 'Successfully Buy Coupon';
        return response()->json(array('status' => 'Ok', 'msg' => $msg));
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
            return back()->withErrors('Your Points Not Enough');
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

        $msg = 'Successfully Buy Coupon';
        return response()->json(array('status' => 'Ok', 'msg' => $msg));
    }




    public function resetform()
    {
        return view('user.reset');
    }

    public function reset(Request $request)
    {
        $user = Auth::user();
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
        $user->update($input);
        $msg = 'Successfully change your passwprd';
        return response()->json($msg);
    }


    public function package()
    {
        $user = Auth::user();
        $subs = Subscription::all();
        $package = $user->subscribes()->where('status', 1)->orderBy('id', 'desc')->first();
        return response()->json(array('status' => 'Ok', 'user' => $user, 'subs' => $subs, 'package' => $package));
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
        return response()->json(array('status' => 'Ok', 'user' => $user, 'subs' => $subs, 'package' => $package));
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
        $user = Auth::user();
        $favorites = FavoriteSeller::where('user_id', '=', $user->id)->get();
        return response()->json(array('status' => 'Ok', 'user' => $user, 'favorites' => $favorites));
    }


    public function favdelete($id)
    {
        $wish = FavoriteSeller::findOrFail($id);
        $wish->delete();
        // return redirect()->route('user-favorites')->with('success','Successfully Removed The Seller.');
        $msg = "Successfully Removed The Seller.";
        return response()->json(array('status' => 'Ok', 'success' => $msg));
    }

    public function wallet()
    {




        $user = User::select('refunds', 'wallet_status', 'currency')->where('id', Auth::User()->id)->first();
        $cur = Currency::find($user->currency);
        if ($user->refunds == 0) {
            $user['refunds'] = "00.00";
            $user['currency'] = $cur->value;
        } else {

            $user['refunds'] = round($user->refunds * $cur->value);

            $user['currency'] = $cur->value;
        }



        return response()->json(array('status' => 'true', 'wallet' => $user, 'Currency' => $cur));
    }


    public function updatephoto(Request $data)
    {
        $validator = Validator::make($data->all(), [

            'photo' => 'image',

        ], []);
        if (!$validator->passes()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        }

        $user = User::find(Auth::User()->id);
        if (!empty($user)) {
            if ($file = $data->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('assets/images/users/', $name);
                if ($data->photo != null) {
                    if (file_exists(public_path() . '/assets/images/users/' . $data->photo)) {
                        unlink(public_path() . '/assets/images/users/' . $data->photo);
                    }
                }
                $input['photo'] = $name;
            }

            $up = $user->update($input);


            if ($up) {
                return response()->json(array('status' => 'true', 'user' => "photo updated Successfully"));
            } else {
                return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
            }
        } else {
            return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
        }
    }
    public function forgot(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        $input =  $request->all();
        if (User::where('phone', '=', $request->phone)->count() > 0) {
            // user found
            $user = User::where('phone', '=', $request->phone)->firstOrFail();
            $autopass = rand();
            $input['password'] = bcrypt($autopass);
            $user->update($input);
            $subject = "Reset Password Request";
            $msg = "Your New Password is : " . $autopass;
            if ($gs->is_smtp == 1) {
                $data = [
                    'to' => $request->phone,
                    'subject' => $subject,
                    'body' => $msg,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            } else {
                $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                mail($request->phone, $subject, $msg, $headers);
            }
            return response()->json(array('status' => 'true',  'message' => 'Your Password Reseted Successfully. Please Check your phone for new Password.'));
        } else {
            // user not found
            return response()->json(array('status' => 'false', 'message' => 'No Account Found With This Phone Number.'));
        }
    }
}
