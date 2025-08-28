<?php

namespace App;


use Illuminate\Http\Response;


class Userdetails // extends Model
{
    

    public static function Userdetail($code){
        
        $link = 'https://vowalaa.vooecommerce.com/api/userdetails/'.$code.'';
      /*  $link = 'https://vowalaa.vooecommerce.com/api/userdetails/1507524935';
        
       $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);(array)json_decode($return, true);*/
        $details = (array)json_decode(file_get_contents($link), true);
        
        
        return $details ;
        
        
     
    } 
    
    
}
