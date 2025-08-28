<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\UserCart;
use App\Models\UserDelete;
use App\Models\Product;

class UserCartController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    
      public function datatables()
    {
         $datas = UserCart::orderBy('id','desc')->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
         
                           ->addColumn('name', function(UserCart $data) {
                              if(!empty($data->user->name)) {
                                $name = $data->user->name;
                                return  $name;
                              }
                            })->editColumn('created_at', function(UserCart $data) {
                                $date = $data->created_at->diffForHumans();
                                return  $date;
                            })
                        
                            ->addColumn('action', function(UserCart $data) {
                                return '<div class="action-list"><a href="' . route('admin-user-cart-show',$data->user_id) . '"> <i class="fas fa-eye"></i> Details</a><a href="javascript:;" data-href="' . route('admin-user-cart-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    
    
    public function index()
    {
        return view('admin.UserCart.index');            
    }


   public function CustomerCartDetails($id) {
        
        $order = UserCart::where('user_id','=',$id)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
      
     //   dd($cart->items);
        $deleted_ids = UserDelete::where('user_id','=',$id)->first();
        
     if(!empty($deleted_ids)) {
        
        $arr2  = unserialize($deleted_ids->deleted_items);
        
       
        $arr = [];
        $i = 0;
        foreach($arr2 as $key=>$val) {
            $arr[$i] = $val;
            $i++;
        }
        
      //  dd($arr);
      
      $deleted_products = Product::whereIn('id',$arr)->get();
      
    
      
        return view('admin.UserCart.details',compact('order','cart','deleted_products'));
     }else {
          return view('admin.UserCart.details',compact('order','cart'));
     }
   }
    
    

    
    
    
    
    
    
}
