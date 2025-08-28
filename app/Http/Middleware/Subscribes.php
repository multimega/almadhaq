<?php

namespace App\Http\Middleware;
use App\Models\Generalsetting;
use App\Userdetails;
use Closure;
use Carbon\Carbon;

class Subscribes
{
    public function handle($request, Closure $next)
    {    
        
        return $next($request);
        
        $gs = Generalsetting::find(1);
           $code = env('Code');
         
	       $details =  Userdetails::Userdetail($code);  
	   
	       if($details['status'] == "Ok"){
            $last_array = end($details['subscribes'])  ;  
        if($details['details']['status'] == 0){
            if($last_array['paid'] == 1) {   
                $date =  Carbon::parse($last_array['created_at'])->adddays($last_array['days'])->format('Y-m-d');
                    if($date > Carbon::now()->format('Y-m-d')){
                        
                           return $next($request);
                           

                    }elseif($details['details']['end_trial'] > Carbon::now()->format('Y-m-d')){
                        
                         return $next($request);
                        
                    }else{
                        
                      return redirect()->route('front-userpay');  
                      
                    }
                   

            }else{
                
                if($details['details']['end_trial'] > Carbon::now()->format('Y-m-d')){
                    
                       
                }else{
                    
                           return redirect()->route('front-userpay');  
                    
                }
                
                
            }
        }else{
    
    
     return redirect()->route('front-userpay');  
    
}

	       }else{
	           
	          return redirect()->route('front-userpay');   
	       }
    }
}
