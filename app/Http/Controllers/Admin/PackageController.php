<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Package;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Package::all();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('price', function(Package $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                $price = $sign->sign.$data->price*$sign->value;
                                return  $price;
                            })
                            ->addColumn('action', function(Package $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-package-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-package-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.package.index');
    }

    //*** GET Request
    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.package.create',compact('sign'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
            'title'                                          => 'unique:packages|required',
            'title_ar'                                       => 'unique:packages|required',
            'subtitle'                                       => 'required',
            'subtitle_ar'                                    => 'required',
            'price'                                         => 'required|numeric|min:0',
            
            ];
        $messages = [
            
             'title.unique'                                 => trans('Title') . '  '. trans('unique'),
             'title.required'                               => trans('Title') . '  '. trans('required'),   
             'title_ar.unique'                              => trans('Arabic Title') . '  '. trans('unique'),
             'title_ar.required'                            => trans('Arabic Title') . '  '. trans('required'),
             'subtitle.required'                            => trans('Subtitle') . '  '. trans('required'),
             'subtitle_ar.required'                         => trans('Arabic Subtitle') . '  '. trans('required'),
             'price.required'                                => trans('Price') .'    ' . trans('required'),
             'price.numeric'                                 => trans('Price') .'    ' . trans('numeric'),
             'price.min'                                     => trans('Price') .'    ' . trans('min'),
             
            
            
        ];
        $validator  = Validator::make($request->all(),$rules,$messages);
        
        
          if ($validator->fails()) {
            return response()->json([
                "status" =>  false,
                "errors" =>  $validator->messages(),
                ],200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Package();
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json([
             'status' => true,
           'msg' =>  $msg
           
           ]);      
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {
        $sign = Currency::where('is_default','=',1)->first();
        $data = Package::findOrFail($id);
        return view('admin.package.edit',compact('data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
       
        $rules = [
            
            'title'                                          => 'unique:packages,title,'.$id . '|required',
            'title_ar'                                       => 'unique:packages,title_ar,'.$id .'|required',
            'subtitle'                                       => 'required',
            'subtitle_ar'                                    => 'required',
            'price'                                          => 'required|numeric|min:0',
            
            ];
        $messages = [
            
             'title.unique'                                 => trans('Title') . '  '. trans('unique'),
             'title.required'                               => trans('Title') . '  '. trans('required'),   
             'title_ar.unique'                              => trans('Arabic Title') . '  '. trans('unique'),
             'title_ar.required'                            => trans('Arabic Title') . '  '. trans('required'),
             'subtitle.required'                            => trans('Subtitle') . '  '. trans('required'),
             'subtitle_ar.required'                          => trans('Arabic Subtitle') . '  '. trans('required'),
             'price.required'                                => trans('Price') .'    ' . trans('required'),
             'price.numeric'                                 => trans('Price') .'    ' . trans('numeric'),
             'price.min'                                     => trans('Price') .'    ' . trans('min'),
             
            
            
        ];
        $validator  = Validator::make($request->all(),$rules,$messages);
        
        
          if ($validator->fails()) {
            return response()->json([
                "status" =>  false,
                "errors" =>  $validator->messages(),
                ],200);
        }       
        //--- Validation Section Ends

        //--- Logic Section
        $data = Package::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        // return response()->json($msg);  
          return response()->json([
             'status' => true,
           'msg' =>  $msg
           
           ]);  
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Package::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
}
