<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Feature;
use App\Models\Piece;
use App\Models\GlobalMessage;
use App\Models\Product;
use App\Models\Propiece;
use App\Models\Free;
use App\Models\Profree;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class LoyaltyController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatablespoints()
    {
         $datas = User::orderBy('id','desc')->where('points','>', 0)->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            
                            ->addColumn('action', function(User $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-user-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    
    public function datatablesmessages()
    {
         $datas = User::orderBy('id','desc')->where('message','!=', null)->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            
                            ->addColumn('action', function(User $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-message-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                               </div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    
    public function datatablesglobal()
    {
         $datas = GlobalMessage::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            
                            
                            ->addColumn('action', function(GlobalMessage $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-global-message-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                                <a href="javascript:;" data-href="' . route('admin-global-message-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
         $users = User::get();
        return view('admin.loyalty.index',compact('users'));
    }

    //*** GET Request  Points
    public function createpoints()
    {
        $users = User::get();
        return view('admin.loyalty.create',compact('users'));
    }
    

    //*** POST Request
    public function storepoints(Request $request)
    {
        //--- Validation Section
        $rules = ['points' => 'required'];
      
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        $user = $request->user_id;
        //--- Logic Section
        $data = User::find($user);
         $data->points += $request->points ;
      
        $data->update();
        //--- Logic Section Ends
  
        //--- Redirect Section        
        $msg = 'points Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    } 
    
    
    //*** GET Request message
    public function createmessage()
    {
        $users = User::where('message','=',null)->get();
        return view('admin.loyalty.create_message',compact('users'));
    }
    

    //*** POST Request 
    public function storemessage(Request $request)
    {
        //--- Validation Section
        $rules = ['message' => 'required'];
      
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        $user = $request->user_id;
        //--- Logic Section
        $data = User::find($user);
         $data->message = $request->message ;
      
        $data->update();
        //--- Logic Section Ends
  
        //--- Redirect Section        
        $msg = 'message Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
    //*** GET Request
    public function editmessage($id)
    {
          $user = User::find($id);
       
        return view('admin.loyalty.edit_message',compact('data','user'));
    }

    //*** POST Request
    public function updatemessage(Request $request, $id)
    {
        //--- Validation Section

          
        //--- Validation Section Ends

        //--- Logic Section
         $data = User::find($id);
         $data->message = $request->message ;
      
        $data->update();
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }





  //*** GET Request message
    public function createglobal()
    {
        $users = User::all();
        return view('admin.loyalty.create_global',compact('users'));
    }
    

    //*** POST Request 
    public function storeglobal(Request $request)
    {
        //--- Validation Section
        $rules = ['message' => 'required'];
      
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        $user = $request->user_id;
        //--- Logic Section
        $data = new GlobalMessage();
         $data->min = $request->min ;
         $data->max = $request->max ;
         $data->message = $request->message ;
      
        $data->save();
        //--- Logic Section Ends
  
        //--- Redirect Section        
        $msg = 'message Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
    //*** GET Request
    public function editglobal($id)
    {
          $data = GlobalMessage::find($id);
       
        return view('admin.loyalty.edit_global',compact('data'));
    }

    //*** POST Request
    public function updateglobal(Request $request, $id)
    {
        //--- Validation Section

          
        //--- Validation Section Ends

        //--- Logic Section
         $data = GlobalMessage::find($id);
         $data->min = $request->min ;
         $data->max = $request->max ;
         $data->message = $request->message ;
      
        $data->update();
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = GlobalMessage::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
  
}
