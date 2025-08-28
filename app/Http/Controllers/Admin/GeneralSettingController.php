<?php

namespace App\Http\Controllers\Admin;
use App\Models\Generalsetting;
use Artisan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class GeneralSettingController extends Controller
{

    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affilate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner'      => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'user_image'        => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'        => 'mimes:jpeg,jpg,png,svg',
        'wallet_photo'        => 'mimes:jpeg,jpg,png,svg',
        'loyalty_photo'        => 'mimes:jpeg,jpg,png,svg'
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

  // Genereal Settings All post requests will be done in this method
    public function generalupdate(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
            $input = $request->all();
            $data = Generalsetting::findOrFail(1);
            if ($file = $request->file('wallet_photo')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->wallet_photo);
                $input['wallet_photo'] = $name;
            }
            if ($file = $request->file('loyalty_photo')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->loyalty_photo);
                $input['loyalty_photo'] = $name;
            }
            if ($file = $request->file('logo')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->logo);
                $input['logo'] = $name;
            }

            if ($file = $request->file('logo_ar')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->logo_ar);
                $input['logo_ar'] = $name;
            }

            if ($file = $request->file('feature_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->feature_icon);
                $input['feature_icon'] = $name;
            }

            if ($file = $request->file('best_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->best_icon);
                $input['best_icon'] = $name;
            }

            if ($file = $request->file('top_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->top_icon);
                $input['top_icon'] = $name;
            }

            if ($file = $request->file('big_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->big_icon);
                $input['big_icon'] = $name;
            }

            if ($file = $request->file('new_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->new_icon);
                $input['new_icon'] = $name;
            }


            if ($file = $request->file('hot_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->hot_icon);
                $input['hot_icon'] = $name;
            }

            if ($file = $request->file('trending_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->trending_icon);
                $input['trending_icon'] = $name;
            }

            if ($file = $request->file('discount_icon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->discount_icon);
                $input['discount_icon'] = $name;
            }

            if ($file = $request->file('favicon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('loader')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->admin_loader);
                $input['admin_loader'] = $name;
            }
            if ($file = $request->file('affilate_banner')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->affilate_banner);
                $input['affilate_banner'] = $name;
            }
            if ($file = $request->file('error_banner')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->error_banner);
                $input['error_banner'] = $name;
            }
            if ($file = $request->file('popup_background')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->popup_background);
                $input['popup_background'] = $name;
            }
            if ($file = $request->file('invoice_logo')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->invoice_logo);
                $input['invoice_logo'] = $name;
            }
            if ($file = $request->file('user_image')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->user_image);
                $input['user_image'] = $name;
            }

            if ($file = $request->file('footer_logo')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->footer_logo);
                $input['footer_logo'] = $name;
            }


            if ($file = $request->file('paymentsicon')) {
                $name = time() . $file->getClientOriginalName();
                $data->upload($name, $file, $data->paymentsicon);
                $input['paymentsicon'] = $name;
            }



            $data->update($input);
            //--- Logic Section Ends


            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            //--- Redirect Section
            $msg = trans('Update Success');


            return response()->json([

                'status'  => true,
                'msg'   =>   $msg

            ], 200);
            //--- Redirect Section Ends
        }
    }
    
    
    public function photoupdate(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = Generalsetting::findOrFail(1);
         if ($file = $request->file('wallet_photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->wallet_photo);
                $input['wallet_photo'] = $name;
            }
            if ($file = $request->file('loyalty_photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->loyalty_photo);
                $input['loyalty_photo'] = $name;
            }
            if ($file = $request->file('brandphoto'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->brandphoto);
                $input['brandphoto'] = $name;
            }

        $data->update($input);
        //--- Logic Section Ends

/*
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
*/
        //--- Redirect Section
         $msg = trans('Update Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);
        //--- Redirect Section Ends
        }
    }

    public function generalupdatepayment(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = Generalsetting::findOrFail(1);
        $prev = $data->molly_key;  
        
        if ($request->vendor_ship_info == ""){
            $input['vendor_ship_info'] = 0;
        }

        if ($request->instamojo_sandbox == ""){
            $input['instamojo_sandbox'] = 0;
        }

        if ($request->paypal_mode == ""){
            $input['paypal_mode'] = 'live';
        }
        else {
            $input['paypal_mode'] = 'sandbox';
        }

        if ($request->paytm_mode == ""){
            $input['paytm_mode'] = 'live';
        }
        else {
            $input['paytm_mode'] = 'sandbox';
        }
        $data->update($input);


        $this->setEnv('MOLLIE_KEY',$data->molly_key,$prev);
        // Set Molly ENV

        //--- Logic Section Ends

        //--- Redirect Section
         $msg = trans('Update Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);
        //--- Redirect Section Ends
        }
    }

    public function logo()
    {
        return view('admin.generalsetting.logo');
    }

    public function userimage()
    {
        return view('admin.generalsetting.user_image');
    }

    public function fav()
    {
        return view('admin.generalsetting.favicon');
    }
      public function  bosta()
    
    
    {
        return view('admin.generalsetting.bosta_settings');

    }
     public function load()
    {
        return view('admin.generalsetting.loader');
    }
    
     public function load2()
    {
        return view('admin.generalsetting.loader2');
    }
  
  
    public function  nbe()
    {
        return view('admin.generalsetting.nbe_settings');
    }
 
    public function  fedex()
     
    {
        return view('admin.generalsetting.fedex_settings');
    }
 
 
    public function  fastlo()
     
    {
        return view('admin.generalsetting.fastlo_settings');
    }
    
   public function  aramex()
     
    {
        return view('admin.generalsetting.aramex_settings');
    }

     public function   thwani()
     {
       
        return view('admin.generalsetting.thawany_settings');
     }
    
       public function   fatora()
        {
       
        
          return view('admin.generalsetting.fatora_setting');
        
         }
     
        public function  abs()
        {
       
        
          return view('admin.generalsetting.abs_settings');
        
         }
         
        public function  mylerz()
        {
       
          return view('admin.generalsetting.mylerz_settings');
        
         }
       
        public function vapulus()
        {
        
          return view('admin.generalsetting.vapulus_settings');
          
        }
   
       
        public function tabby()
        {
    
            return view('admin.generalsetting.tabby-settings');
        }
    
         public function telr()
        {
    
            return view('admin.generalsetting.telr-settings');
        }
    
      public function paypalpaymentt()
      {
          return view('admin.generalsetting.paypal_setting');
      }
   
     public function contents()
     {
        return view('admin.generalsetting.websitecontent');
     }
      public function  accept()
      {
        return view('admin.generalsetting.accept_settings');
      }
       public function   fawry()

    {
        return view('admin.generalsetting.fawry_settings');
    }
      
      
     public function  bank()
    {
        return view('admin.generalsetting.bankmisry');
    }
     public function  tap()
    {
        return view('admin.generalsetting.tap');
    }
     public function header()
    {
        return view('admin.generalsetting.header');
    }

     public function footer()
    {
        return view('admin.generalsetting.footer');
    }

    public function paymentsinfo()
    {
        return view('admin.generalsetting.paymentsinfo');
    }

    public function affilate()
    {
        return view('admin.generalsetting.affilate');
    }

    public function errorbanner()
    {
        return view('admin.generalsetting.error_banner');
    }

    public function popup()
    {
        return view('admin.generalsetting.popup');
    }
    
    
            
        public function whatsapp()
    {

        $settings = Generalsetting::first();

        $messageTemplate = $settings->whatsapp_message_template ?: Generalsetting::getDefaultMessageTemplate();
        $whatsappCountryCode = $settings->whatsapp_country_code;
        $whatsappNumber = $settings->whatsapp_number;
        
        return view('admin.generalsetting.whatsapp', compact('messageTemplate', 'whatsappCountryCode', 'whatsappNumber'));
    }
    
    public function templateselect()
    {
        return view('admin.generalsetting.templates');
    }
    
 
    public function maintain()
    {
        return view('admin.generalsetting.maintain');
    }
    
    public function ispopup($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_popup = $status;
        $data->update();
    }


    public function mship($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->multiple_shipping = $status;
        $data->update();
    }
  public function shipment($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->shipment = $status;
        $data->update();
    }


    public function mpackage($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->multiple_packaging = $status;
        $data->update();
    }


    public function paypal5($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->paypal_check = $status;
        $data->update();
    }


    public function instamojo($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_instamojo = $status;
        $data->update();
    }


    public function paystack($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_paystack = $status;
        $data->update();
    }


    public function paytm($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_paytm = $status;
        $data->update();
    }



    public function molly($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_molly = $status;
        $data->update();
    }

    public function razor($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_razorpay = $status;
        $data->update();
    }



    public function stripe($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->stripe_check = $status;
        $data->update();
    }

    public function guest($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->guest_checkout = $status;
        $data->update();
    }

    public function isemailverify($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_verification_email = $status;
        $data->update();
    }


    public function cod($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->cod_check = $status;
        $data->update();
    }

    public function comment($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_comment = $status;
        $data->update();
    }
    public function isaffilate($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_affilate = $status;
        $data->update();
    }

    public function issmtp($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_smtp = $status;
        $data->update();
    }

    public function talkto($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_talkto = $status;
        $data->update();
    }
    public function drift($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_drift = $status;
        $data->update();
    } 
    public function messenger($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_messenger = $status;
        $data->update();
    }

    public function issubscribe($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_subscribe = $status;
        $data->update();
    }

    public function isloader($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_loader = $status;
        $data->update();
    }

    public function stock($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->show_stock = $status;
        $data->update();
    }

    public function ishome($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_home = $status;
        $data->update();
    } 
    public function isshop($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_shop = $status;
        $data->update();
    }

    public function isadminloader($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_admin_loader = $status;
        $data->update();
    }

    public function isdisqus($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_disqus = $status;
        $data->update();
    }
 public function is_erp($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_erp = $status;
        $data->update();
    }

    public function iscontact($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_contact = $status;
        $data->update();
    }
    public function isfaq($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_faq = $status;
        $data->update();
    }
    public function language($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_language = $status;
        $data->update();
    }
    public function currency($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_currency = $status;
        $data->update();
    } 
    public function brands($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_brand = $status;
        $data->update();
    }
    public function regvendor($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->reg_vendor = $status;
        $data->update();
    }

    public function iscapcha($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_capcha = $status;
        $data->update();
    }

    public function isreport($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_report = $status;
        $data->update();
    }

    public function issecure($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_secure = $status;
        $data->update();
    }

    public function ismaintain($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_maintain = $status;
        $data->update();
    }
    
    
      public function allowZip($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->allow_zip = $status;
        $data->update();
    }
    
     public function allowShipTo($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->allow_shipto = $status;
        $data->update();
    }
    
     public function allowPickup($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->allow_pickup = $status;
        $data->update();
    }
    
     public function blockIcon()
    {
        return view('admin.generalsetting.block');
    } 
    
    public function erp_integration()
    {
        return view('admin.generalsetting.erp_integration');
    } 
    
       /**
     * Store WhatsApp settings
     */
    public function whatsapp_settings_store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'whatsapp_message_template' => 'required|string',
            'whatsapp_country_code' => 'required|string|max:10',
            'whatsapp_number' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get or create the general settings record
            $settings = Generalsetting::first();
            
            if (!$settings) {
                $settings = new Generalsetting();
            }

            // Update WhatsApp settings
            $settings->whatsapp_message_template = $request->whatsapp_message_template;
            $settings->whatsapp_country_code = $request->whatsapp_country_code;
            $settings->whatsapp_number = $request->whatsapp_number;
                        
            // Save the settings
            $settings->save();

            return response()->json([
                'success' => true,
                'message' => 'WhatsApp settings saved successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving settings: ' . $e->getMessage()
            ], 500);
        }
    }



}
