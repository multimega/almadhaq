<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use App\Models\Referral;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use App\Models\UserCart;

class RegisterController extends Controller
{

   public function showRegisterForm() {
       return view('user.register');
   }
   
   
    public function register(Request $request)
    {

    	$gs = Generalsetting::findOrFail(1);

    	if($gs->is_capcha == 1)
    	{
	        $value = session('captcha_string');
	        if ($request->codes != $value){
	            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	        }    		
    	}


        //--- Validation Section

        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

	        $user = new User;
	        $input = $request->all();        
	        $input['password'] = bcrypt($request['password']);
	        $token = md5(time().$request->name.$request->email);
	        $input['verification_link'] = $token;
	        $input['affilate_code'] = md5($request->name.$request->email);
                
               if($request->refelar_code){
                   $ref = Referral::where('code',$request->refelar_code)->first();
                   if($ref){
                       $ref->times += 1; 
                       $ref->update(); 
                       $u =  User::where('id',$ref->user_id)->first();
                       if($u){
                         $u->points +=  $gs->refelar_points ;
                         $u->update();
                         
                         $input['points'] = $gs->refelar_points ;
                         $input['ref'] = $ref->user_id;
                       }
                   }else{
                       
                     return response()->json(0);  
                   }
                   
                   
                   
               } 
            

	          if(!empty($request->vendor))
	          {
					//--- Validation Section
					$rules = [
						'shop_name' => 'unique:users',
						'shop_number'  => 'max:10'
							];
					$customs = [
						'shop_name.unique' => 'This Shop Name has already been taken.',
						'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
					];

					$validator = Validator::make($request->all(), $rules, $customs);
					if ($validator->fails()) {
					return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
					}
					$input['is_vendor'] = 1;

			  }
			  
			$user->fill($input)->save();
			
			$refelar = new Referral;
			$refelar->user_id = $user->id;
			$refelar->rand = rand(123, 999999) ;
			$refelar->code = str_random(6).rand(123456, 999999);
			$refelar->save();
			
			
	        if($gs->is_verification_email == 1)
	        {
	        $to = $request->email;
	        $subject = 'Verify your email address.';
	        $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";
	        //Sending Email To Customer
	        if($gs->is_smtp == 1)
	        {
	        $data = [
	            'to' => $to,
	            'subject' => $subject,
	            'body' => $msg,
	        ];

	        $mailer = new GeniusMailer();
	        $mailer->sendCustomMail($data);
	        }
	        else
	        {
	        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
	        mail($to,$subject,$msg,$headers);
	        }
          	return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
	        }
	        else {

            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
             Auth::guard('web')->login($user); 
             
             $usrid = Auth::guard('web')->user()->id;
              $this->storeCart($usrid);
          	return response()->json(1);
	        }

    }

    public function token($token)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_verification_email == 1)
	        {    	
        $user = User::where('verification_link','=',$token)->first();
        if(isset($user))
        {
            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user); 
            return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
        }
    		}
    		else {
    		return redirect()->back();	
    		}
    }
    
    
    
    
    
    
    
    
    
      public function storeCart($usrid) {
        
        
         $Cartdta = Session::has('cart') ? Session::get('cart') : null;
       //  dd($Cartdta);
       
       
       
       $info = UserCart::where('user_id',$usrid)->first();
       
       if(!empty($info)) {
           $info->delete();
       }
       
       
       $data = [
          'cart'              =>  utf8_encode(bzcompress(serialize($Cartdta), 9)),
          'user_id'           =>  $usrid
           
         ];
         
         
         
          if($Cartdta != null) { 
               UserCart::create($data);
          }
        
    }
    
    
}