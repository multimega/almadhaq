<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Subscribe;
use App\Models\Feature;
use App\Models\Piece;
use App\Models\Product;
use App\Models\Propiece;
use App\Models\Free;
use App\Models\Profree;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class SubscribesController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Subscribe::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('product_id', function(Subscribe $data) {
                                $pro = Product::find($data->product_id);
                                $type = !empty($pro) ? $pro->name : $data->product_id;
                                return $type;
                            })
                            ->editColumn('user_id', function(Subscribe $data) {
                                $name = User::select('name')->where('id',$data->user_id)->first();
                                 $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
                                return $user;
                            })
                            ->editColumn('start_date', function(Subscribe $data) {
                               
                                 $start_date = $data->start_date != null ? $data->start_date : 'Not Started Yet' ;
                                return $start_date;
                            })  ->editColumn('end_date', function(Subscribe $data) {
                               
                                 $end_date = $data->end_date != null ? $data->end_date : 'date Not created Yet' ;
                                return $end_date;
                            })
                            ->addColumn('status', function(Subscribe $data) {
                                $class = $data->status == "approved" ? 'drop-success' : ( $data->status == "declined" ? 'drop-danger' : 'drop-') ;
                                $s = $data->status == "approved" ? 'selected' : '';
                                $ns = $data->status == "declined" ? 'selected' : '';
                                $wns = $data->status == "waiting" ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'">
                                <option data-val="approved" value="'. route('admin-subscribes-status',['id1' => $data->id, 'id2' => "approved"]).'" '.$s.'>Approved</option>
                                <<option data-val="declined" value="'. route('admin-subscribes-status',['id1' => $data->id, 'id2' => "declined"]).'" '.$ns.'>Declined</option>
                                <<option data-val="waiting" value="'. route('admin-subscribes-status',['id1' => $data->id, 'id2' => "waiting"]).'" '.$wns.'>Waiting</option>
                                
                                </select></div>';
                            }) 
                            ->addColumn('action', function(Subscribe $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-subscribes-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-subscribes-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        
        return view('admin.subscribes.index');
    }

    //*** GET Request
    public function create()
    {
        $users = User::get();
        $pro = Product::where('feature',1)->get();
        return view('admin.subscribes.create',compact('users','pro'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
 
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Subscribe();
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
        $input['rand'] = rand(123, 999999) ;
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {
        $users = User::get();
        $data = Subscribe::findOrFail($id);
            $pro = Product::where('feature',1)->get();
        return view('admin.subscribes.edit',compact('data','users','pro'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:coupons,code,'.$id];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $data = Subscribe::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function status($id1,$id2)
        {
            
             $now = Carbon::now();
                            
            $data = Subscribe::findOrFail($id1);
            $data->status = $id2;
            if($id2 == "approved"){
                if(empty($data->start_date)){
              $data->start_date = Carbon::parse($now)->format('Y-m-d');
                }
              $pro = Product::where('feature',1)->where('id',$data->product_id)->first();
              if($pro){
                  if($pro->subscription_type == "Days"){
                      $days = $pro->subscription_period + $pro->trial_period;
                  }elseif($pro->subscription_type == "Months"){
                      $days = ($pro->subscription_period * 30) + $pro->trial_period;
                  }else{
                      $days = ($pro->subscription_period * 365) + $pro->trial_period;
                  }
                  
                $nows = Carbon::now()->addDays($days);  
                if(empty($data->end_date)){
                 $data->end_date = Carbon::parse($nows)->format('Y-m-d');  
                 $data->trial_end_date = date('Y-m-d', strtotime($data->start_date. ' + '.$pro->trial_period.' days')) ;   
                 
                }else{
                 $days =  $days -  $pro->trial_period ;
                 $data->end_date = date('Y-m-d', strtotime($data->end_date. ' + '.$days.' days')) ; 
                }
              }
            }
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Subscribe::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
    
  
}
