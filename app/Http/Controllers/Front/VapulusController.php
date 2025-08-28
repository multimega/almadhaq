<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;

class VapulusController extends Controller
{
   
   
    public  $b;
    
    public function __construct()
    {
     $this->b= Generalsetting::findOrFail(1);
     
    }
       
    
             public function    store(Request $request){
                 
              $string="amount=$request->amount&cardCVC=$request->cardCvc&cardExp=$request->cardexp&cardNum=$request->cardNumber&email=$request->email&holderName=$request->name&mobileNumber=$request->mobileNumber&onAccept=https://www.google.com&onFail=https://www.google.com";
              
              $hashSecret= $this->b->vapulus_hash;
              
              $secrets = pack('H*', $hashSecret);

              $sig = hash_hmac('sha256',$string,$secrets);
                 
      
               $client = new Client([
                                           
                                     
               ]);
                        
               $response = $client->post('https://api.vapulus.com:1338/app/makeTransaction',
                        
                  [
                                             
                                             
                'form_params' => [
                                                    
                 "cardNum"=> $request->cardNumber,
                 "cardExp"=> $request->cardexp,
                 "cardCVC"=>  $request->cardCvc,
                 "holderName"=> $request->name,
                 "mobileNumber" => $request->mobileNumber,
                 "email" =>$request->email,
                 "amount" =>$request->amount,
                 "onAccept" => 'https://www.google.com',
                 "onFail" => 'https://www.google.com',
                 "password" => $this->b->vapulus_secret,
                 "appId" => $this->b->application_id,
                 "hashSecret"=> $sig 
                                                 
                ],
             ]);
                                
             
              
            
              $m = json_decode($response->getBody(), true); 
              
              $trans=$m['data']['transactionId'];
               
              $d="transactionId=$trans";

              $hashsecret = $this->b->vapulus_hash;
              
              $s = pack('H*', $hashsecret);

              $hash = hash_hmac('sha256',$d,$s);
              
               $client = new Client([
                                           
                                     
               ]);
                        
               $response = $client->post('https://api.vapulus.com:1338/app/transactionInfo',
                        
                  [
                                             
                                             
                'form_params' => [
                                                    
                 "transactionId"=>$m['data']['transactionId'],
                 "password" => $this->b->vapulus_secret,
                 "appId" => $this->b->application_id,
                 "hashSecret"=>$hash
                                                 
                ],
             ]);
                                
             
             $z = json_decode($response->getBody(), true); 
               
               if($z['data']['status'] == 0 || $z['data']['status'] == 1 )
               {
                  
                  return redirect()->to('https://version3.vooecommerce.com/editorder/'.$request->order_id);
                   
               }
              
              else{
                  
                  return redirect()->to('https://version3.vooecommerce.com/en/cancelpayment');
                  
              }
               
         }

}