<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\ads;
use App\Models\Pagesetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class adsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = ads::all(); 
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(ads $data) {
                                $photo = $data->photo ? url('assets/images/ads/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->editColumn('title', function(ads $data) {
                                $title = strlen(strip_tags($data->title)) > 250 ? substr(strip_tags($data->title),0,250).'...' : strip_tags($data->title);
                                return  $title;
                            })
                            ->addColumn('action', function(ads $data) {
                                return '<div class="action-list"><a href="' . route('admin-ads-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-ads-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete" style="display:none"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
        // dd($datas);
    }
  public function datatables2()
    {
         $datas = ads::skip(3)->take(5)->get(); 
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(ads $data) {
                                $photo = $data->photo ? url('assets/images/ads/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->editColumn('title', function(ads $data) {
                                $title = strlen(strip_tags($data->title)) > 250 ? substr(strip_tags($data->title),0,250).'...' : strip_tags($data->title);
                                return  $title;
                            })
                            ->addColumn('action', function(ads $data) {
                                return '<div class="action-list"><a href="' . route('admin-ads-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-ads-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
        // dd($datas);
    }

    //*** GET Request
    public function index()
    {
        
     
        return view('admin.ads.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.ads.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        
        // dd($request);
        //--- Validation Section
        $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new ads();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/ads',$name);           
            $input['photo'] = $name;
        } 
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
        $data = ads::findOrFail($id);
        return view('admin.ads.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
       
        //--- Validation Section Ends

        //--- Logic Section
        $data = ads::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/ads',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/ads/'.$data->photo)) {
                        unlink(public_path().'/assets/images/ads/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            } 
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = ads::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            $msg = 'Data Deleted Successfully.';
            return response()->json($msg);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/ads/'.$data->photo)) {
            unlink(public_path().'/assets/images/ads/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
    
    
    
//         // Page Settings All post requests will be done in this method
//     public function updatePageSliders(Request $request)
//     {

//         //--- Validation Section
//   /*      $validator = Validator::make($request->all(), $this->rules,$this->customs);

//         if ($validator->fails()) {
//           return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
//         }*/
//         //--- Validation Section Ends

//         $data = Pagesetting::findOrFail(1);
//         $input = $request->all();
        
//             if ($file = $request->file('best_seller_banner')) 
//             {              
//                 $name = time().$file->getClientOriginalName();
//                 $data->upload($name,$file,$data->best_seller_banner);
//                 $input['best_seller_banner'] = $name;
//             }    
//             if ($file = $request->file('big_save_banner')) 
//             {              
//                 $name = time().$file->getClientOriginalName();
//                 $data->upload($name,$file,$data->big_save_banner);           
//                 $input['big_save_banner'] = $name;
//             } 

//             if ($file = $request->file('best_seller_banner1')) 
//             {              
//                 $name = time().$file->getClientOriginalName();
//                 $data->upload($name,$file,$data->best_seller_banner1);
//                 $input['best_seller_banner1'] = $name;
//             }    
//             if ($file = $request->file('big_save_banner1')) 
//             {              
//                 $name = time().$file->getClientOriginalName();
//                 $data->upload($name,$file,$data->big_save_banner1);           
//                 $input['big_save_banner1'] = $name;
//             } 


//         $data->update($input);
//         $msg = 'Data Updated Successfully.';
//         return response()->json($msg);      
//     }
    
    
}
