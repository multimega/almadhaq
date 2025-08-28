<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\Order;
use App\Models\Subscribe;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Point;
use App\Models\PointPiece;
use App\Models\PointFree;
use App\Models\Coupon;
use App\Models\Piece;
use App\Models\Propiece;
use App\Models\Cart;
use App\Models\Free;
use App\Models\Generalsetting;
use App\Models\Profree;
use App\Models\Referral;
use App\Models\PaymentGateway;
use Carbon\Carbon;

class CouponController extends Controller {
    
    public function pointscoupon($id)
    {
        //--- Validation Section
        $user = Auth::user();       
          $user_id = Auth::user()->id ;
           $user_points = Auth::user()->points ;
            $point = Point::where('code',$id)->where('status',1)->first();
             $piece = PointPiece::where('code',$id)->where('status',1)->first();
             $free = PointFree::where('code',$id)->where('status',1)->first();
             
           $mytime = Carbon::now();
        if($point){
        if ($user_points < $point->points) {
        //   return back()->withErrors('Your Points Not Enough');
                return response()->json(array('status' => 'Ok', 'msg' => 'Your Points Not Enough'));
        }
   
        $coupon = new Coupon();
        $coupon->code = $point->code;
        $coupon->type = $point->type;
        $coupon->price = $point->price;
        $coupon->photo = $point->photo;
       // $coupon->rand = rand();
        $coupon->limited = $point->limited;
        $coupon->times = $point->times;
        
        $coupon->start_date = date('Y-m-d', strtotime($mytime)) ;
        $coupon->end_date = date('Y-m-d', strtotime($mytime. ' + '.$point->days.' days')) ;
        $coupon->user_id = $user_id;
        $coupon->save();
        
        
        $user->points -= $point->points; 
        $user->update();
        
        $point->used += 1;
        $point->update();
        
        $msg = 'Successfully Buy Coupon';

        return response()->json(array('status' => 'Ok', 'msg' => $msg));
        
        }elseif($piece){
           if ($user_points < $piece->points) {
        //   return back()->withErrors('Your Points Not Enough');
                return response()->json(array('status' => 'Ok', 'msg' => 'Your Points Not Enough'));
        }
        
        $coupon = new Piece();
        $coupon->code = $piece->code;
        $coupon->photo = $piece->photo;
        $coupon->times = $piece->times;
        $coupon->buy = $piece->buy;
        $coupon->take = $piece->take;
        $coupon->rand = rand();
        $coupon->start_date = date('Y-m-d', strtotime($mytime)) ;
        $coupon->end_date = date('Y-m-d', strtotime($mytime. ' + '.$piece->days.' days')) ;
        $coupon->user_id = $user_id;
        $coupon->save();
        
        $pro = new Propiece() ;
        $pro->product_id = $piece->product_id ;
        $pro->code_id = $coupon->id ;
        $pro->save();
        
        
        
        $user->points -= $piece->points; 
        $user->update();
        
        $piece->used += 1;
        $piece->update();
        
        $msg = 'Successfully Buy Coupon';
        
          return response()->json(array('status' => 'Ok', 'msg' => $msg));
        
        }elseif($free){
            if ($user_points < $free->points) {
        //   return back()->withErrors('Your Points Not Enough');
                return response()->json(array('status' => 'Ok', 'msg' => 'Your Points Not Enough'));
        } 
         
           $coupon = new Free();
        $coupon->code = $free->code;
        $coupon->times = $free->times;
        $coupon->photo = $free->photo;
        $coupon->rand = rand();
        $coupon->start_date = date('Y-m-d', strtotime($mytime)) ;
        $coupon->end_date = date('Y-m-d', strtotime($mytime. ' + '.$free->days.' days')) ;
        $coupon->user_id = $user_id;
        $coupon->save();
        
        $pro = new Profree() ;
        $pro->product_id = $free->product_id ;
        $pro->code_id = $coupon->id ;
        $pro->save();
        
        
        $user->points -= $free->points; 
        $user->update();
        
        $free->used += 1;
        $free->update();
        
        $msg = 'Successfully Buy Coupon';
         
         return response()->json(array('status' => 'Ok', 'msg' => $msg));   
            
        }  
        

    }   



    public function promocodes()
    {
        
         $id = Auth::user()->id ;
         $mytime = Carbon::now()->toDateTimeString() ;
       
          $currency = Currency::find(auth()->user()->currency);
     
         $coupons = Coupon::where('status',1) 
         ->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->whereDate('end_date', '>', $mytime)->whereDate('start_date', '<', $mytime)->get();
            foreach($coupons as $c){
               if($c->type == 1){
                   
               $c['types'] = "Amount";   
               $c['price'] = round($c['price'] * $currency['value'],2);   
                $c['limited'] = round($c['limited'] * $currency['value'],2);  
               $c['currency_ar'] = $currency['name_ar'];
               $c['currency_en'] = $currency['name'];
               $c['currency_sign'] = $currency['sign'];
               $c['currency_value'] = $currency['value'];
                   
               }else{
                   
                 $c['types'] = "Percentage";  
                 $c['limited'] = round($c['limited'] * $currency['value'],2);  
               $c['currency_ar'] = $currency['name_ar'];
               $c['currency_en'] = $currency['name'];
               $c['currency_sign'] = "%";
                 
               } 
                
            }
            
            
            
         $pieces = Piece::where('status',1) 
         ->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->whereDate('end_date', '>', $mytime)->whereDate('start_date', '<', $mytime)->get();
            
            foreach($pieces as $p){
                     $p['currency_ar'] = $currency['name_ar'];
               $p['currency_en'] = $currency['name'];
                $pro = Propiece::where('code_id',$p->id)->pluck('product_id');
                   $p['limited'] = round($p['limited'] * $currency['value'],2);   
                $p['products'] = Product::whereIn('id',$pro)->get(); 
            }
            
            
            
         $free = Free::where('status', 1) 
         ->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->whereDate('end_date', '>', $mytime)->whereDate('start_date', '<', $mytime)->get();
            
             foreach($free as $f){
                  $f['currency_ar'] = $currency['name_ar'];
               $f['currency_en'] = $currency['name'];
                $prof = Profree::where('code_id',$f->id)->pluck('product_id');
                  $f['limited'] = round($f['limited'] * $currency['value'],2);   
                $f['products'] = Product::whereIn('id',$prof)->get(); 
            }
            
      
        
        $user = Auth::user();  

        return response()->json(array('status' => 'Ok','coupons'=>$coupons,'mytime'=>$mytime,'pieces'=>$pieces,'free'=>$free));

    } 
    
    
    public function refelar()
    {
        
         $id = Auth::user()->id ;
         $mytime = Carbon::now()->toDateTimeString() ;
       
       
      
        
            
            
         $ref = Referral::where('user_id', Auth::user()->id )->where('status',1)->first();
    
       if($ref ){
       return response()->json(array('status' => 'Ok','ref'=>$ref));

            }else{
 return response()->json(array('status' => 'false','ref'=> 'no code'));
           }
    }



    public function points()
    {
        $user = Auth::user(); 
        $id = Auth::user()->id ;
           
          $currency = Currency::find(auth()->user()->currency);
      
        $coupons = Point::where('status',1)
            ->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->get(); 
        foreach($coupons as $c){
               if($c->type == 1){
                   
               $c['types'] = "Amount";   
               $c['price'] = round($c['price'] * $currency['value'],2);   
               $c['limited'] = round($c['limited'] * $currency['value'],2);   
               $c['currency_ar'] = $currency['name_ar'];
               $c['currency_en'] = $currency['name'];
               $c['currency_sign'] = $currency['sign'];
               $c['currency_value'] = $currency['value'];
                   
               }else{
                   
                 $c['types'] = "Percentage";  
                   $c['currency_ar'] = $currency['name_ar'];
               $c['currency_en'] = $currency['name'];
               $c['currency_sign'] = $currency['sign'];
              $c['limited'] = round($c['limited'] * $currency['value'],2);  
               $c['currency_sign'] = "%";
                 
               } 
                
            }
            
            
            
        $piececoupons = PointPiece::where('status',1)
            ->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->get(); 
            
             foreach($piececoupons as $p){
             
                  $p['limited'] = round($p['limited'] * $currency['value'],2);   
                $p['products'] = Product::where('id',$p->product_id)->first(); 
            }
            
            
            
        $freecoupons = PointFree::where('status',1)
            ->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->get();
             foreach($freecoupons as $f){
             
                   $f['limited'] = round($f['limited'] * $currency['value'],2);   
                $f['products'] = Product::where('id',$f->product_id)->first(); 
            }

        return response()->json(array('status' => 'Ok', 'user' => $user,'coupons'=>$coupons,'piececoupons'=>$piececoupons,'freecoupons'=>$freecoupons));

    }  
    
    public function coupondetails($id){
       
          $currency = Currency::find(auth()->user()->currency);
      
         $fnd = Coupon::where('code', '=', $id)
            ->first();
            
        $fr = Free::where('code','=',$id)->first();
        $pi = Piece::where('code','=',$id)->first();
        if(!empty($fnd)){
                  if($fnd->type == 1){
                   
               $fnd['types'] = "Amount";   
               $fnd['price'] = round($fnd['price'] * $currency['value'],2);   
                $fnd['limited'] = round($fnd['limited'] * $currency['value'],2);  
               $fnd['currency_ar'] = $currency['name_ar'];
               $fnd['currency_en'] = $currency['name'];
               $fnd['currency_sign'] = $currency['sign'];
               $fnd['currency_value'] = $currency['value'];
                   
               }else{
                   
                 $fnd['types'] = "Percentage";  
                  $fnd['limited'] = round($fnd['limited'] * $currency['value'],2);  
               $fnd['currency_ar'] = $currency['name_ar'];
               $fnd['currency_en'] = $currency['name'];
               $fnd['currency_sign'] = "%";
                 
               } 
            $coupons = $fnd ;
            
            
        }elseif(!empty($fr)){
              $fr['currency_ar'] = $currency['name_ar'];
               $fr['currency_en'] = $currency['name'];
                $prof = Profree::where('code_id',$fr->id)->pluck('product_id');
                 
                $fr['products'] = Product::whereIn('id',$prof)->get(); 
             $coupons = $fr ;
            
        }elseif(!empty($pi)){
               $pi['currency_ar'] = $currency['name_ar'];
               $pi['currency_en'] = $currency['name'];
                $pro = Propiece::where('code_id',$pi->id)->pluck('product_id');
                 $pi['limited'] = round($pi['limited'] * $currency['value'],2);  
                $pi['products'] = Product::whereIn('id',$pro)->get(); 
             $coupons = $pi ;
            
        }else{
            
             $coupons = "no coupon";
        }

        return response()->json(array('status' => 'Ok','coupons'=>$coupons));

    }
    
    
    
    
        public function couponcheck(Request $request)
    {
        
        $code = $request['code'];
        $total = $request['total'];
       
        $id = auth()->user()->id;
   /*     $fnd = Coupon::where('code','=',$code)->where('user_id',Auth::guard('web')->user()->id)->get()->count();*/
          if(Session::has('already'))
                {
                    return response()->json(array('status' => 'false','message'=>'you already using coupon'));   
                }
        
        $fnd = Coupon::where(function ($query) use ($code) {
               $query->where('code', '=', $code);
            
            })->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->where('status',1)->get()->count();
            
        $fr = Free::where('code','=',$code)->where('status',1)->get()->count();
        $pi = Piece::where('code','=',$code)->where('status',1)->get()->count();
     
        if($fnd < 1 && $fr < 1 && $pi < 1  )
        {
      return response()->json(array('status' => 'false','message'=>'coupon not right try again'));                
        }
        elseif($fnd > 0 ){
        /*$coupon = Coupon::where('code','=',$code)->where('user_id',Auth::guard('web')->user()->id)->first();*/
         $coupon = Coupon::where(function ($query) use ($code) {
               $query->where('code', '=', $code);
            
            })->where(function ($query) use ($id)  {
              $query->where('user_id', '=', $id)
                  ->orWhere('user_id', '=', null);
            })->first();
            
          
                $curr = Currency::find(auth()->user()->currency);
            
        if($coupon->times != null)
        {
            if($coupon->times == "0")
            {
                return response()->json(array('status' => 'false','message'=>'cant use coupon anymore'));                
            }
        } 
        if(($coupon->limited * $curr->value ) > $total)
        {
           
                return response()->json(array('status' => 'false','message'=>'موصلتش للحد المسموح لاستعمال الكوبون'));              
            
        }
        
      //  dd($total);
        $today = date('Y-m-d');
          /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
        $from = date('Y-m-d',strtotime($coupon->start_date));
        $to = date('Y-m-d',strtotime($coupon->end_date));
        if($from <= $today && $to >= $today )
        {
            if($coupon->status == 1 )
            {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $val = Session::has('already') ? Session::get('already') : null;
                if($val == $code)
                {
                    return response()->json(array('status' => 'false','message'=>'you already using coupon'));   
                }
                $cart = new Cart($oldCart);
                if($coupon->type == 0)
                {
                    Session::put('already', $code);
                    $coupon->price = (int)$coupon->price;

                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);

                   

                    $val = $total / 100;
                    $sub = $val * $coupon->price;
                    $total = $total - $sub;
                    
                    $data[0] = round($total,2);
                    $data[1] = $code;      
                    $data[2] = round($sub, 2);
                  
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    Session::put('coupon_total1', $data[0]);
                    Session::forget('coupon_total');
                    $data['total'] = round($total,2);
                    $data['code'] = $code;      
                    $data['type'] = "Percentage";      
                    $data['value'] = $coupon->price."%";      
                    
                    $data['coupon_id'] = $coupon->id;
                    $data['price'] = round($sub, 2);
                   

                    Session::put('coupon_percentage', $coupon->price);


                    return response()->json(array('status' => 'true','coupon'=> $data));   
                }
                else{
                    Session::put('already', $code);
                    $total = $total - round($coupon->price * $curr->value, 2);
                    $data[0] = round($total,2);
                    $data[1] = $code;
                    $data[2] = round($coupon->price * $curr->value, 2);
                    $data[3] = $coupon->id;
                
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    Session::put('coupon_total1', $data[0]);
                    Session::forget('coupon_total');
                    $data['total'] = round($total,2);
                    $data['code'] = $code;
                    $data['type'] = "Amount";  
                    $data['price'] = round($coupon->price * $curr->value, 2);
                    $data['coupon_id'] = $coupon->id;                  
                    $data[4] = 0;

                    Session::put('coupon_percentage', $data[4]);

                    return response()->json(array('status' => 'true','coupon'=> $data));            
                }
            }
            else{
                   return response()->json(array('status' => 'false','message'=>'coupon not avaliable'));   
            }              
        }
        else{
       return response()->json(array('status' => 'false','message'=>'coupon Expired'));              
        }
        }elseif( $fr > 0){
            
           /* return response()->json(2); */
            $coupon = Free::where('code','=',$code)->first();
            $free = Profree::where('code_id','=',$coupon->id)->first();
        
           
                $curr = Currency::find(auth()->user()->currency);
            
            
            
             if($coupon->times != null)
                {
            if($coupon->times == "0")
                    {
                  return response()->json(array('status' => 'false','message'=>'cant use coupon anymore'));          
                    }
              } 
              
                
        if(($coupon->user_id != Auth()->user()->id ) )
        {
           
                  return response()->json(array('status' => 'false','message'=>'this coupon not for you'));              
           
        } 
        

        
      //  dd($total);
        $today = date('Y-m-d');
          /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
        $from = date('Y-m-d',strtotime($coupon->start_date));
        $to = date('Y-m-d',strtotime($coupon->end_date));
        if($from <= $today && $to >= $today )
        {
            if($coupon->status == 1 )
            {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $val = Session::has('already') ? Session::get('already') : null;
                if($val == $code)
                {
                   return response()->json(array('status' => 'false','message'=>'you already using coupon'));   
                }
                $cart = new Cart($oldCart);
               
                     Session::put('already', $code);
                    
                    $data[0] = round($total,2);
                    $data[1] = $code;
                    $data[2] = 0;
                    $data[3] = $coupon->id;
                    $data[6] = $free->product_id;
                 //   $data[7] = 3;
              
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                   // Session::put('coupon_total1', $data[0]);
                    Session::put('coupon_pro', $data[6]);
                    Session::put('coupon_free', $code);
                    Session::put('coupon_free_color', $free->color);
                    Session::put('coupon_free_size', $free->size);
                    
                    $data['total'] = round($total,2);
                    $data['code'] = $code;
                    $data['price'] = 0 ;
                    $data['code_id'] = $coupon->id;                  
                     $data['type'] = "Free Product";
                    $data['product_id'] = $free->product_id;
                 //   $data[7] = 3;

                    Session::put('coupon_product', "Free Product");
                    

                    return response()->json(array('status' => 'true','coupon'=> $data));     
                
                
            }
            else{
                     return response()->json(array('status' => 'false','message'=>'coupon not avaliable'));  
            }              
        }
        else{
        return response()->json(array('status' => 'false','message'=>'coupon Expired'));            
        }
            
        
            
        }elseif( $pi > 0){
            
           /* return response()->json(2); */
            $coupon = Piece::where('code','=',$code)->first();
            $piece = Propiece::where('code_id','=',$coupon->id)->first();
        
          
          $curr = Currency::find(auth()->user()->currency);
            
            
            
         if($coupon->times != null)
                {
            if($coupon->times == "0")
                    {
               return response()->json(array('status' => 'false','message'=>'cant use coupon anymore'));           
                    }
              } 
              
                
        if(($coupon->user_id != Auth()->user()->id ) )
        {
           
              return response()->json(array('status' => 'false','message'=>'this coupon not for you'));               
           
        } 
        

        
      //  dd($total);
        $today = date('Y-m-d');
          /*$order = Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' ;
        $limit = $coupon->limited;*/
        $from = date('Y-m-d',strtotime($coupon->start_date));
        $to = date('Y-m-d',strtotime($coupon->end_date));
        if($from <= $today && $to >= $today )
        {
            if($coupon->status == 1 )
            {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $val = Session::has('already') ? Session::get('already') : null;
                if($val == $code)
                {
                   return response()->json(array('status' => 'false','message'=>'you already using coupon'));   
                }
                $cart = new Cart($oldCart);
                
                /* foreach($cart->items as $key => $prod)
        {
                if($prod['item']['id'] ==  $piece->product_id && $prod['qty'] >= $coupon->buy ){
                   $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
                
               $cart->items[$itemid]['qty'] += $coupon->take ; 
               $cart->totalQty += $coupon->take ; 
            
               Session::put('cart',$cart);
                break;
            }
        }*/
               
               
               
                     Session::put('already', $code);
                    
                    $data[0] = round($total,2);
                    $data[1] = $code;
                    $data[2] = 0;
                    $data[3] = $coupon->id;
                    $data[6] = $piece->product_id;
                 //   $data[7] = 3;
              
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                   // Session::put('coupon_total1', $data[0]);
                    Session::put('coupon_pro', $data[6]);
                    Session::put('coupon_piece', $code);
                    Session::put('coupon_piece_color', $piece->color);
                    Session::put('coupon_piece_size', $piece->size);
                    Session::put('coupon_get', $coupon->buy);
                    Session::put('coupon_take', $coupon->take);
                    
                    $data['total'] = round($total,2);
                    $data['code'] = $code;
                    $data['price'] = 0 ;
                    $data['code_id'] = $coupon->id;                  
                    $data['buy_piece'] = $coupon->buy;                  
                    $data['take_piece'] = $coupon->take;                  
                  //  $data[5] = 1;
                    $data['product_id'] = $piece->product_id;
                   $data['type'] = "Take Product Free";

                    Session::put('coupon_product', "Take Product Free");
                    

                    return response()->json(array('status' => 'true','coupon'=> $data));  
                
                
            }
            else{
                    return response()->json(array('status' => 'false','message'=>'coupon not avaliable'));  
            }              
        }
        else{
        return response()->json(array('status' => 'false','message'=>'coupon Expired'));            
        }
            
        }          
    } 
    
        public function forget() {
      
        if (Session::has('already')) {
            Session::forget('already');
        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        if (Session::has('coupon_total')) {
            Session::forget('coupon_total');
        }
        if (Session::has('coupon_total1')) {
            Session::forget('coupon_total1');
        }
        if (Session::has('coupon_percentage')) {
            Session::forget('coupon_percentage');
        }  
            
         if (Session::has('coupon_piece')) {
             $oldCart = Session::has('cart') ? Session::get('cart') : null;
               $cart = new Cart($oldCart);
                 foreach($cart->items as $key => $prod)
            {
                if($prod['item']['id'] ==  Session::get('coupon_pro')){
                   $itemid = $prod['item']['id'].$prod['size'].$prod['color'] ;
                
               $cart->items[$itemid]['qty'] -=  Session::get('coupon_take'); 
               $cart->totalQty -=  Session::get('coupon_take') ; 
            
               Session::put('cart',$cart);
                break;
            }
        } 
             
            Session::forget('coupon_piece');
        }
        if (Session::has('coupon_pro')) {
            Session::forget('coupon_pro');
        } 
        
         if (Session::has('coupon_free')) {
            Session::forget('coupon_free');
        }
         if (Session::has('coupon_free_color')) {
            Session::forget('coupon_free_color');
        } 
        
        if (Session::has('coupon_free_size')) {
            Session::forget('coupon_free_size');
        }
        if (Session::has('coupon_product')) {
            Session::forget('coupon_product');
        } 
        if (Session::has('coupon_take')) {
            Session::forget('coupon_take');
        }
      if (Session::has('coupon_get')) {
            Session::forget('coupon_get');
        }
    
         if (Session::has('coupon_piece_color')) {
            Session::forget('coupon_piece_color');
        } 
        
        if (Session::has('coupon_piece_size')) {
            Session::forget('coupon_piece_size');
        }
        return response()->json(array('status' => 'true','message'=> 'coupon removed'));   
    }
    
    
}