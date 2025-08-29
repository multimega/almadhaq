<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\IssueTokenTrait;
use App\Http\Controllers\Controller;
use App\Models\SocialProvider;
use App\Models\Socialsetting;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravel\Passport\Client;
use Validator;
use Socialite;
use Google_Client;



class SocialAuthController extends Controller
{


    private function token($token)
    {
        return 'Bearer ' . $token;
    }



    public function googleRedirectToProvider()
    {
        return Socialite::driver('google')->scopes(['profile', 'email'])->redirect();
    }

    public function googleHandleProviderCallback()
    {
        $google_user = Socialite::driver('google')->stateless()->user();
        return $this->registerSociaUser($google_user);
    }

    public function fbRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function fbHandleProviderCallback()
    {
        $facebook_user = Socialite::driver('facebook')->user();
        return $this->registerSociaUser($facebook_user);
    }

    private function registerSociaUser($socialObject)
    {
        $google_user = $socialObject;
        $user = User::firstOrNew(['name' => $google_user->name]);
        if (!$user->id) {
            $user->name = $google_user->name;
            $user->email = $google_user->email;
            $user->password = bcrypt(str_random(8));
            $user->save();

            $provider = new SocialProvider;
            $provider->provider_id = $google_user->provider_id;

            $provider->save();
        }
        $success['token'] = $this->token($user->CreateAcessToken());
        $success['name'] = $user->name;
        return response()->json([
            'success' => $success
        ], 200);
    }

    private function loginSocialUser(Request $request)
    {
        $google_user = $request;
        $user = User::firstOrNew(['name' => $google_user->name]);
        if (!$user->id) {
            $user->name = $google_user->name;
            $user->email = $google_user->email;

            $user->password = bcrypt(str_random(8));
            $user->save();

            $provider = new SocialProvider;
            $provider->provider_id = $google_user->provider_id;

            $provider->save();
        }
        $success['token'] = $this->token($user->CreateAcessToken());
        $success['name'] = $user->name;
        return response()->json([
            'success' => $success
        ], 200);
    }

    public function facebookToken()
    {
        $social =  Socialsetting::find(1);
        $client_id = $social->fclient_id;
        $client_secret =  $social->fclient_secret;
        $link = "https://graph.facebook.com/oauth/access_token?client_id=" . $client_id . "&client_secret=" . $client_secret . "&grant_type=client_credentials";
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        $return = (array)json_decode($return, true);
        if (isset($return['error'])) {
            return false;
        } else {
            return $return['access_token'];
        }
    }

    public function facebookGetUser($input_token)
    {
        $contents = [];
        $link = "https://graph.facebook.com/v8.0/me?access_token=" . $input_token . "&debug=all&fields=id%2Cname%2Cemail&format=json&method=get&pretty=0&suppress_http_code=1";
        try {
            $contents = (array)json_decode(file_get_contents($link), true);
        } catch (\Exception $e) {
        }
        return $contents;
    }

    public function googleAuthenticate(Request $request)
    {/*
          $social=  Socialsetting::find(1);
     
        $validator = Validator::make($request->all(), [
            'input_token' => 'required|string',
            'provider_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 201);
        }
        $input_token = $request->get('input_token');
        $CLIENT_ID = $social->gclient_id;
        $CLIENT_secret = $social->gclient_secret;
        $payload = [];
        $client = new \Google_Client(['client_id' => $CLIENT_ID]);
      
        
        
    try {   
         $payload = $client->verifyIdToken($input_token);
     
       
           
        } catch (\Exception $e) {
           
        }
        
      
        if (count($payload)) {
            $user = User::where('email', $payload['email'])->get()->first();
            if (!$user) {
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
             
                 
                    'password' => bcrypt($payload['email'] . $payload['name']),
                ]);
                 $provider = SocialProvider::create([
                    
                    'user_id' => $user->id,
                    'provider_id' => $request->provider_id,
                    'provider' => 'google',
               
                ]);
                

            }
            return response([
                'success' => true,
                'token' => $this->token($user->CreateAcessToken()),
                  'id' =>  $user->id,
                        'name' =>  $user->name,
                        'email' =>  $user->email
            ], 200);
        }
        return response([
            'success' => false,
            'error' => "Invalid ID Token",
        ], 201);

    */

        $validator = Validator::make($request->all(), [
            'input_token' => 'required|string',
            'provider_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 201);
        }
        $contents = [];

        $link = "https://www.googleapis.com/oauth2/v3/tokeninfo?access_token=" . $request->input_token;
        try {
            $contents = (array)json_decode(file_get_contents($link), true);
        } catch (\Exception $e) {
        }
        $data = $contents;
        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                $user = User::create([
                    'name' => $data['email'],
                    'email' => $data['email'],

                    'email_verified' => 'Yes',
                    'is_provider' => 1,


                    'affilate_code' => md5($data['email']),

                    'password' => bcrypt($data['email']),
                ]);
                $provider = SocialProvider::create([

                    'user_id' => $user->id,
                    'provider_id' => $request->provider_id,
                    'provider' => 'google',

                ]);


                $refelar = new Referral;
                $refelar->user_id = $user->id;
                $refelar->rand = rand(123, 999999);
                $refelar->code = str_random(6) . rand(123456, 999999);
                $refelar->save();
            }
            $res['token'] = $this->token($user->CreateAcessToken());
            $res['id'] = $user->id;
            $res['name'] = $user->name;
            $res['email'] = $user->email;
            return response($res, 200);
        } else {

            return isset($contents['error']) ? response($contents['error'], 401) : response($contents, 401);
        }
        if (isset($contents['data'])) {
            if ($contents['data']['is_valid']) {
            } else {
                return response([
                    "success" => true,
                    'error' => $contents
                ], 401);
            }
        } else {
            return isset($contents['error']) ? response($contents['error'], 401) : response($contents, 401);
        }

        return response($contents, 500);
    }

    public function AuthenticateFacebook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input_token' => 'required|string',
            'provider_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 201);
        }
        $contents = [];
        $appToken = $this->facebookToken();
        if ($appToken) {
            $link = "https://graph.facebook.com/debug_token?" .
                "input_token=" . $request->input_token . "&" .
                "access_token=" . $appToken;
            try {
                $contents = (array)json_decode(file_get_contents($link), true);
            } catch (\Exception $e) {
            }
            $data = $this->facebookGetUser($request->input_token);
            if (isset($data['email'])) {
                $user = User::where('email', $data['email'])->first();
                if (!$user) {
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'email_verified' => 'Yes',
                        'is_provider' => 1,


                        'affilate_code' => md5($data['name'] . $data['email']),
                        'password' => bcrypt($data['email'] . $data['name']),
                    ]);
                    $provider = SocialProvider::create([

                        'user_id' => $user->id,
                        'provider_id' => $request->provider_id,
                        'provider' => 'facebook',

                    ]);


                    $refelar = new Referral;
                    $refelar->user_id = $user->id;
                    $refelar->rand = rand(123, 999999);
                    $refelar->code = str_random(6) . rand(123456, 999999);
                    $refelar->save();
                }
                $res['token'] = $this->token($user->CreateAcessToken());
                $res['id'] = $user->id;
                $res['name'] = $user->name;
                $res['email'] = $user->email;
                return response($res, 200);
            } else {

                return isset($contents['error']) ? response($contents['error'], 401) : response($contents, 401);
            }
            if (isset($contents['data'])) {
                if ($contents['data']['is_valid']) {
                } else {
                    return response([
                        "success" => true,
                        'error' => $contents
                    ], 401);
                }
            } else {
                return isset($contents['error']) ? response($contents['error'], 401) : response($contents, 401);
            }
        }
        return response($contents, 500);
    }
    public function appleAuthenticate(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 201);
        }

        $contents = [];


        if (isset($request->name)) {
            $user = User::where('name', $request->name)->first();
            if (!$user) {
                $user = User::create([
                    'name' => $request->name,
                    'contact_id' => rand(),
                    'email_verified' => 'Yes',
                    'is_provider' => 0,


                    'affilate_code' => md5($request->name),

                    'password' => bcrypt($request->name),
                ]);



                $refelar = new Referral;
                $refelar->user_id = $user->id;
                $refelar->rand = rand(123, 999999);
                $refelar->code = str_random(6) . rand(123456, 999999);
                $refelar->save();
            }
            $res['token'] = $this->token($user->CreateAcessToken());
            $res['id'] = $user->id;
            $res['name'] = $user->name;
            return response($res, 200);
        } else {

            return isset($contents['error']) ? response($contents['error'], 401) : response($contents, 401);
        }
        if (isset($contents['data'])) {
            if ($contents['data']['is_valid']) {
            } else {
                return response([
                    "success" => true,
                    'error' => $contents
                ], 401);
            }
        } else {
            return isset($contents['error']) ? response($contents['error'], 401) : response($contents, 401);
        }

        return response($contents, 500);
    }
}
