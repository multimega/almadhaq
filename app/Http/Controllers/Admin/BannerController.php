<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables($type)
    {
         $datas = Banner::where('type','=',$type)->where('mobile_setting',0)->orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Banner $data) {
                                $photo = $data->photo ? url('assets/images/banners/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image" width="250px" height="250px">';
                            })
                            ->addColumn('action', function(Banner $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-sb-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                                <a href="javascript:;" data-href="' . route('admin-sb-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); 
    }

    //*** GET Request
    public function index()
    {
        return view('admin.banner.index');
    }

    //*** GET Request
    public function large()
    {
        return view('admin.banner.large');
    }

    //*** GET Request
    public function bottom()
    {
        return view('admin.banner.bottom');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.banner.create');
    }

    
    public function fix() 
    {
        return view('admin.banner.fix');
    }
    
     public function largecreate()
    {
        return view('admin.banner.largecreate');
    }
    
    public function fixcreate()
    {
        
    
        return view('admin.banner.fixcreate');
    }

    public function bottomcreate()
    {
        return view('admin.banner.bottomcreate');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg,webp',
                ];

        $messages  = [
            'photo.required' => trans('imgRequired'),
             'photo.mimes' => trans('ImgMimes'),
           
                   ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Banner();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/banners',$name);           
            $input['photo'] = $name;
        } 
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = trans('Add Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);        
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg,webp',
                ];

       $messages  = [
           
             'photo.mimes' => trans('ImgMimes'),
           
                   ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Banner::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/banners',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
                        unlink(public_path().'/assets/images/banners/'.$data->photo);
                    }
                }            
               $input['photo'] = $name;
            } 
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

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Banner::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
             $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
            unlink(public_path().'/assets/images/banners/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section     
         $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200); 
        //--- Redirect Section Ends     
    }
    
    public function bannerdatatables()
    {
         $datas = Banner::orderBy('id','desc')->where('mobile_setting',1)->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Banner $data) {
                                $photo = $data->photo ? url('assets/images/banners/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image" width="250px" height="250px">';
                            })
                            ->addColumn('action', function(Banner $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-sb-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                                <a href="javascript:;" data-href="' . route('admin-sb-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); 
    }

    //*** GET Request
    public function bannerindex()
    {
        return view('admin.banner.index');
    }


    //*** GET Request
    public function bannercreate()
    {
        return view('admin.banner.create');
    }

    //*** POST Request
    public function bannerstore(Request $request)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg,webp',
                ];

        $messages  = [
            'photo.required' => trans('imgRequired'),
             'photo.mimes' => trans('ImgMimes'),
           
                   ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Banner();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/banners',$name);           
            $input['photo'] = $name;
        } 
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = trans('Add Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);     
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function banneredit($id)
    {
        $data = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('data'));
    }

    //*** POST Request
    public function bannerupdate(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg,webp',
                ];

         $messages  = [
          
             'photo.mimes' => trans('ImgMimes'),
           
                   ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Banner::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/banners',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
                        unlink(public_path().'/assets/images/banners/'.$data->photo);
                    }
                }            
               $input['photo'] = $name;
            } 
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

  
    
    
}
