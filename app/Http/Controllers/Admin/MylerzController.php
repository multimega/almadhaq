<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use App\Imports\OrdersImport;
use Maatwebsite\Excel\Facades\Excel;

class MylerzController extends Controller
{
   
   
    public  $b;
    
    public function __construct()
    {
        
     $this->middleware('auth:admin');
     
     $this->b= Generalsetting::findOrFail(1);
       
                       $client = new Client([
                           
                        'headers' => ['Content-Type' =>'application/x-www-form-urlencoded']
                      
                      ]);
                
                          $response = $client->post('http://41.33.122.61:58639/Token',  
                         
                           ['form_params' => [ 
                              
                                "grant_type"=>"password",
                                "username"=>$this->b->mylerz_username,
                                "password"=>$this->b->mylerz_password,
                                
                                ],
                            ]); 
                                  
                       $m = json_decode($response->getBody(), true);
                       
                       $this->access_token= $m['access_token'];               
    
              }

    
                  public function  Awb($id){
                      
                     $n=$this->access_token;

                         $abs=array(
                     
                            "Barcode"=>$id
                        
                            );
                        
                      $d=$abs;
                      
                      $data = json_encode($d);
                      
                      $client = new Client([
                          
                      'headers' => ['Content-Type' =>'application/json','Authorization'=>" Bearer $n"]
                     ]);
                
                     $response = $client->post('http://41.33.122.61:58639/api/packages/GetAWB',
                
                          ['body' =>$data]
                     
                     );
                    
                    $m = json_decode($response->getBody(), true);
                    
                    
                    $awbpdf= base64_decode($m['Value']);
                    
                    
                       return response()->make($awbpdf, 200, [
                           
                                'Content-type'        => 'application/pdf',
                                'Content-Disposition' => 'attachment; filename="awb.pdf"',
                                'Content-Transfer-Encoding'=>'binary',
                                'Accept-Ranges'=>'bytes'
                            ]);
                      }
                                
                  
             public function   shipmentstatus($id){
                 
                 $n=$this->access_token;
                 //dd($n);
      
                 $client = new Client([
                     
                      'headers' => ['Content-Type' =>'application/json','Authorization'=>"Bearer $n"]
                 ]);
                
                  $response = $client->get('http://41.33.122.61:58639/api/packages/GetPackageDetails?AWB='.$id.'');
                  
                   $m = json_decode($response->getBody(), true);
                   
                   return view('admin.order.mylerzshow',compact('m'));  
                   
         }

}