<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Referral;
use App\Models\Feature;
use App\Models\Piece;
use App\Models\Product;
use App\Models\Propiece;
use App\Models\Free;
use App\Models\Pagesetting;
use App\Models\Generalsetting;

use App\Models\Profree;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class ReferralController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Referral::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('type', function(Referral $data) {
                                $type = $data->type == 0 ? "Discount By Percentage" : "Discount By Amount";
                                return $type;
                            })
                            ->editColumn('price', function(Referral $data) {
                                $price = $data->type == 0 ? $data->price.'%' : $data->price.'$';
                                return $price;
                            }) ->editColumn('limited', function(Referral $data) {
                                $limit = $data->limited < 0 ? $data->limited.'%' : $data->limited.'$';
                                return $limit;
                            }) ->editColumn('user_id', function(Referral $data) {
                                
                               
                                        $name = User::select('name')->where('id',$data->user_id)->first();
                                           if(!empty($name)) {
                                          $user = !empty($name) ? $name->name  : 'User deleted';
                                      
                                        return $user;
                                         }
                              
                            })->editColumn('new_id', function(Referral $data) {
                                
                                $name = User::select('name')->where('id',$data->new_id)->first();
                                   if(!empty($name)) {
                                        $user = $data->new_id != null ? $name->name  : 'Not Used';
                                        return $user;
                                  }
                            })
                            ->addColumn('status', function(Referral $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-Referral-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-Referral-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            }) 
                            ->addColumn('action', function(Referral $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-Referral-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-Referral-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        
        return view('admin.Referral.index');
    }

    //*** GET Request
    public function create()
    {
        $users = User::get();
        return view('admin.Referral.create',compact('users'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = ['code' => 'unique:referrals'];
        $messages = ['code.unique' => trans('codeUnique')];
          $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Referral;
        $input = $request->all();
       
        $input['rand'] = rand(123, 999999) ;
      //  $input = ;
      
        $data->create($input);
        //--- Logic Section Ends

        //--- Redirect Section        
          $msg = trans('Add Success');
        
        
        return response()->json([
            'status' => true,
            'msg'   => $msg
            
        ],200);
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {
        $users = User::get();
        $data = Referral::findOrFail($id);
        return view('admin.Referral.edit',compact('data','users'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:referrals,code,'.$id];
          $messages = ['code.unique' => trans('codeUnique')];
          $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }  
        //--- Validation Section Ends

        //--- Logic Section
        $data = Referral::findOrFail($id);
        $input = $request->all();
         
     
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
         $msg = trans('Update Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);   
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = Referral::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Referral::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
           $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);    
        //--- Redirect Section Ends   
    }
     public function walletphoto()
    {
        $data = Generalsetting::find(1); 
        return view('admin.Referral.photo',compact('data'));
    }
    
    

    
}
