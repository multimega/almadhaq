<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Notifications;
use App\Models\Page;
use App\Models\Offer;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\OfferProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class NotificationsController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Notifications::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
         
                           ->editColumn('linked', function(Notifications $data) {
                               if($data->linked == 1){
                                   $linked = "Product";
                                   
                               }elseif($data->linked == 2){
                                   
                                      $linked = "Category";
                               }elseif($data->linked == 3){
                                   
                                    $linked = "Brand";
                               }elseif($data->linked == 4){
                                   
                                    $linked = "Sub Category";
                               }else{
                                   
                                    $linked = "Offer Page";
                               }
                               
                               
                               if($data->type == "text"){
                                   $linked = "text";
                               }
                             
                               
                                return $linked;
                            })->editColumn('linked_id', function(Notifications $data) {
                                
                                if($data->linked == 1){
                                    $name = Product::select('name')->where('id',$data->linked_id)->first();
                                 $linked_id = !empty($name) ? $name->name : "Product Deleted";
                                   
                               }elseif($data->linked == 2){
                                   
                                    $name = Category::select('name')->where('id',$data->linked_id)->first();
                                 $linked_id = !empty($name) ? $name->name : "Category Deleted";
                               }elseif($data->linked == 3){
                                   
                                    $name = Brand::select('name')->where('id',$data->linked_id)->first();
                                 $linked_id = !empty($name) ? $name->name : "Brand Deleted";
                               }elseif($data->linked == 4){
                                   
                                    $name = Subcategory::select('name')->where('id',$data->linked_id)->first();
                                 $linked_id = !empty($name) ? $name->name : "Subcategory Deleted";
                               }else{
                                   
                                    $name = Offer::select('name')->where('id',$data->linked_id)->first();
                                 $linked_id = !empty($name) ? $name->name : "Offer Page Deleted";
                               }
                                if($data->type == "text"){
                                   $linked_id = "text";
                               }
                             
                                return $linked_id;
                            })
                             ->addColumn('checkbox', function(Notifications $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -27px;"></span>
                               </label>
                                </div>';
                            })
                           ->editColumn('user_id', function(Notifications $data) {
                                $name = User::select('name')->where('id',$data->user_id)->first();
                                 $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
                                return $user;
                            })
                          
                            ->addColumn('action', function(Notifications $data) {
                                return '<div class="action-list">
                                <a data-href="' . route('admin-notif-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-notif-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action','checkbox'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.notif.index');
    }

    //*** GET Request
    public function create()
    {
          $pro = User::get();
        return view('admin.notif.create',compact('pro'));
    }

    //*** POST Request
   //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
       $users = User::all();
        
      
        
        if(empty($request->user_id)){
            foreach($users as $u){
            $data = new Notifications();
             $input = $request->all(); 
             $input['user_id'] = $u->id;
             
             $data->fill($input)->save();
             
                
            }
            
        }else{
             $data = new Notifications();
             $input = $request->all(); 
              $data->fill($input)->save(); 
            
        }
 
        
     
    
        
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Notifications::findOrFail($id);
        $pro = User::get();
        return view('admin.notif.edit',compact('data','pro'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
       
        //--- Logic Section
        $data = Notifications::findOrFail($id);
        $input = $request->all();
      
       
        $data->update($input);
     
           
        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Header
    
    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Notifications::findOrFail($id);
      
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
   

    //*** GET Request
 
       public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Notifications::whereIn('id', $selected_products)
                                        ->get();
                    foreach($products as $n){
                        $n->delete();
                    }
     
                                        
          
            
          return redirect()->back()->with('success','notifications deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }  
    
}