<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Point;
use App\Models\PointPiece;
use App\Models\PointFree;
use App\Models\Feature;
use App\Models\Piece;
use App\Models\Generalsetting;
use App\Models\Product;
use App\Models\Propiece;
use App\Models\Free;
use App\Models\Profree;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class PointController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Point::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('type', function(Point $data) {
                                $type = $data->type == 0 ? "Discount By Percentage" : "Discount By Amount";
                                return $type;
                            })
                            ->editColumn('price', function(Point $data) {
                                $price = $data->type == 0 ? $data->price.'%' : $data->price;
                                return $price;
                            }) ->editColumn('limited', function(Point $data) {
                                $limit = $data->limited < 0 ? $data->limited.'%' : $data->limited;
                                return $limit;
                            }) ->editColumn('user_id', function(Point $data) {
                                $name = User::select('name')->where('id',$data->user_id)->first();
                                 $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
                                return $user;
                            })
                            ->addColumn('status', function(Point $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select selects droplinks '.$class.'"><option data-val="1" value="'. route('admin-points-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-points-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            }) 
                            ->addColumn('action', function(Point $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-points-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-points-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        
        return view('admin.points.index');
    }

    //*** GET Request
    public function create()
    {
        $users = User::get();
        return view('admin.points.create',compact('users'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = ['code' => 'unique:points'];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Point();
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
        $input['rand'] = rand(123, 999999) ;
       
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
        $data = Point::findOrFail($id);
        return view('admin.points.edit',compact('data','users'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:points,code,'.$id];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $data = Point::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
    
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
            $data = Point::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Point::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
    
    /* ==================================  Buy One Get One Coupon ========================================= */
    
      public function datatablespiece()
    {
         $datas = PointPiece::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('product_id', function(PointPiece $data) {
                                $type = Product::select('name')->where('id',$data->product_id)->first();
                                $pro = $data->product_id == null ? 'For All' : (!empty($type) ? $type->name : "product Deleted");
                                return $pro;
                            })
                            ->editColumn('user_id', function(PointPiece $data) {
                                $name = User::select('name')->where('id',$data->user_id)->first();
                                 $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
                                return $user;
                            })
                            ->addColumn('status', function(PointPiece $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.' " style="display: block"><option data-val="1" value="'. route('admin-points-piece-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-points-piece-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            }) 
                            ->addColumn('action', function(PointPiece $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-points-piece-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-points-piece-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function createpiece()
    {
        $users = User::get();
        $pro = Product::where('status',1)->get();
       
        return view('admin.points.piece.create',compact('users','pro'));
    }

    //*** POST Request
    public function storepiece(Request $request)
    {
        //--- Validation Section
        $rules = ['code' => 'unique:point_pieces'];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        //--- Logic Section
        $data = new PointPiece();
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
        $input['rand'] = rand(123, 999999) ;
       
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function editpiece($id)
    { 
        $pro = Product::where('status',1)->get();
        $users = User::get();
        $data = PointPiece::findOrFail($id);
        return view('admin.points.piece.edit',compact('data','users','pro'));
    }

    //*** POST Request
    public function updatepiece(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:point_pieces,code,'.$id];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $data = PointPiece::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
    
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function statuspiece($id1,$id2)
        {
            $data = PointPiece::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroypiece($id)
    {
        $data = PointPiece::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
      
    /* ==================================  Take One Free Coupon ========================================= */
    
      public function datatablesfree()
    {
         $datas = PointFree::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('product_id', function(PointFree $data) {
                                $type = Product::select('name')->where('id',$data->product_id)->first();
                                $pro = $data->product_id == null ? 'For All' : (!empty($type) ? $type->name : "product Deleted");
                                return $pro;
                            })
                            ->editColumn('user_id', function(PointFree $data) {
                                $name = User::select('name')->where('id',$data->user_id)->first();
                                 $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
                                return $user;
                            })
                            ->addColumn('status', function(PointFree $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.' " style="display: block"><option data-val="1" value="'. route('admin-points-free-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-points-free-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            }) 
                            ->addColumn('action', function(PointFree $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-points-free-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-points-free-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function createfree()
    {
        $users = User::get();
        $pro = Product::where('status',1)->get();
       
        return view('admin.points.free.create',compact('users','pro'));
    }

    //*** POST Request
    public function storefree(Request $request)
    {
        //--- Validation Section
        $rules = ['code' => 'unique:point_free'];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        //--- Logic Section
        $data = new PointFree();
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
        $input['rand'] = rand(123, 999999) ;
       
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function editfree($id)
    { 
        $pro = Product::where('status',1)->get();
        $users = User::get();
        $data = PointFree::findOrFail($id);
        return view('admin.points.free.edit',compact('data','users','pro'));
    }

    //*** POST Request
    public function updatefree(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:point_free,code,'.$id];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $data = PointFree::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }
    
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function statusfree($id1,$id2)
        {
            $data = PointFree::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroyfree($id)
    {
        $data = PointFree::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
    
 /* ===================================== Points For Pound ================================*/   
 
    public function edits()
    {
       
        $data = Generalsetting::findOrFail(1);
        return view('admin.points.points',compact('data'));
    }

    //*** POST Request
    public function updates(Request $request)
    {
        
        //--- Logic Section
        $data = Generalsetting::findOrFail(1);
        
        $input = $request->all();
       
    
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
}
