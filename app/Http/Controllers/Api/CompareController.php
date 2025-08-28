<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Compare;
use App\Models\NewCompare;
use App\Models\Product;

class CompareController extends Controller
{

    public function compares()
    {
       $oldCompare = NewCompare::where('user_id',auth()->user()->id)->pluck('product_id');
    
        if (count($oldCompare) < 1) {
             return response()->json(array('status' => 'false',  'products' => "no products in compare"));
        }
  
            
          $products = Product::whereIn('id',$oldCompare)->get();
          
          
        
       
       
        $counts = count($oldCompare);
      return response()->json(array('status' => 'Ok', 'counts' => $counts, 'products' => $products));

    }

    public function addcompares($id)
    {
        $user = auth()->user()->id;
       
        $old = NewCompare::where('product_id',$id)->where('user_id',$user)->first();
        if($old){
            return response()->json(array('status' => 'false', 'message' =>"products already in compare "));  
            
        }
        $compare = new NewCompare();
        $compare->user_id = $user;
        $compare->product_id = $id;
        $compare->save();
            
         return response()->json(array('status' => 'true', 'message' =>"products dsadd to compare successfuly")); 
   
    }

    public function removecompares($id)
    {
       $user = auth()->user()->id;
       
        $old = NewCompare::where('product_id',$id)->where('user_id',$user)->first();
        if($old){
            $old->delete();
            return response()->json(array('status' => 'false', 'message' =>"products removed from compare "));  
            
        }else{
                return response()->json(array('status' => 'false', 'message' =>"no product for this id in compare"));  
        }
    }

    public function clearcompare($id)
    {
        Session::forget('compare');
    }


    // Capcha Code Image
  
}