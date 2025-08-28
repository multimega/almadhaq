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

class absController extends Controller
{
   
   
    public  $b;
    protected $tokenz;
    public function __construct()
    {
                       $this->middleware('auth:admin');
                       $this->b= Generalsetting::findOrFail(1);
                       $bostaa=array(
                        
                          "UserName"=>$this->b->abs_username,
                          "Password"=>$this->b->abs_password,
                     );
                 
                       $d = $bostaa ;
                       $data = json_encode($d) ;
                       $client = new Client([
                        'headers' => ['Content-Type' =>'application/json']
                      
                      ]);
                
                          $response = $client->put('http://a1.mpsegypt.com/DemoAPI/api/ClientUsers/Login',
                
                              ['body' =>$data]
                        
                      );
                      
                       $m = json_decode($response->getBody(), true);
                       
                       $this->tokenz=$m['AccessToken'];
                }

    
               public function   Awbs(){
                   
    
                   $nowtimz =date("Y-m-d");
                   $d=strtotime("-1 Days");

                    $abs=array(
                        
                         "Date1"=> date("Y-m-d",$d),
                         "Date2"=> $nowtimz
                        );
                        
                           
                      $d=$abs;
                      $data = json_encode($d) ;
                      $client = new Client([
                      'headers' => ['Content-Type' =>'application/json','AccessToken'=>$this->tokenz]
                     ]);
                
                     $response = $client->post('http://a1.mpsegypt.com/DemoAPI/api/ClientUsers/GetAllAWBs',
                
                          ['body' =>$data]
                     
                     );
                
                   $m = json_decode($response->getBody(), true);
                   
                   return view('admin.order.show_awbs',compact('m'));  
                   
               }

              

          

             public function   shipment($id){
      
                     
                    $abs=array(
                
                      "AWBs"=>array(
                          
                          $id
                          
                          )

                        );
                        
                           
                      $d=$abs;
                      $data = json_encode($d) ;
                      $client = new Client([
                      'headers' => ['Content-Type' =>'application/json','AccessToken'=>$this->tokenz]
                     ]);
                
                     $response = $client->post('http://a1.mpsegypt.com/DemoAPI/api/ClientUsers/V2/GetShipmentsEx',
                
                          ['body' =>$data]
                     
                     );
                
                   $m = json_decode($response->getBody(), true);
                   
                   return view('admin.order.abs-show',compact('m'));  
                   
               }

                
       
                   
             
    

}