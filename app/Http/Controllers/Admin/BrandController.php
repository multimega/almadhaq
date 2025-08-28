<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Brand::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(Brand $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('checkbox', function(Brand $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -18px;"></span>
                               </label>
                                </div>';
                            })
                            ->addColumn('action', function(Brand $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-brand-edit',$data->id) . '" class="edit main-bg-dark br-4" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-brand-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger br-4"><i class="fas fa-trash-alt"></i> Delete</a></div>';
                            })
                            ->rawColumns(['status','action','checkbox'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.brand.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.brand.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
            'name'                       => 'required',
            'name_ar'                    => 'required',
            'photo'                      => 'mimes:jpeg,jpg,png,svg',
            'slug'                       => 'required|unique:brands|regex:/^[a-zA-Z0-9\s-]+$/'
            
            
            ];
        $messages = [
            
            'name.required'              => trans('Name').  '  ' . trans('required'),
            'name_ar.required'           => trans('Arabic Name') .  '  ' . trans('required'),
            'photo.mimes'                => trans('ImgMimes'),
            'slug.required'              => trans('Slug') .  '  ' . trans('required'),
            'slug.unique'                =>  trans('Cat Slug'),
            'slug.regex'                 =>  trans('Cat Regex'),
            
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
        $data = new Brand();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/brands',$name);
            $input['photo'] = $name;
        }

        $data->fill($input)->save();
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
        $data = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
       
          $rules = [
            
            'name'                       => 'required',
            'name_ar'                    => 'required',
            'photo'                      => 'mimes:jpeg,jpg,png,svg',
           	'slug'                       => 'unique:brands,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
            
            
            ];
        $messages = [
            
            'name.required'              => trans('Name').  '  ' . trans('required'),
            'name_ar.required'           => trans('Arabic Name') .  '  ' . trans('required'),
            'photo.mimes'                => trans('ImgMimes'),
            'slug.required'              => trans('Slug') .  '  ' . trans('required'),
            'slug.unique'                =>  trans('Cat Slug'),
            'slug.regex'                 =>  trans('Cat Regex'),
            
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
        $data = Brand::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/brands',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/brands/'.$data->photo)) {
                        unlink(public_path().'/assets/images/brands/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }

       

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
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
          $data = Brand::findOrFail($id1);
          $data->status = $id2;
          $data->update();
      }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Brand::findOrFail($id);



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
        if (file_exists(public_path().'/assets/images/brands/'.$data->photo)) {
            unlink(public_path().'/assets/images/brands/'.$data->photo);
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
    
    
       public function ckeckall(Request $request) {
        
             if (!empty($request->input('selected_products'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products'));
    
                  
    
                    $products = Brand::whereIn('id', $selected_products)
                                        ->update(['status' => 0]);
                                        
              $msg = 'Brand Deactivate Successfully.';                      
             return redirect()->back()->with('success',$msg);
                }else{
             return redirect()->back(); 
         }
     
   
    }
    public function ckeckactivate(Request $request) {
        
             if (!empty($request->input('selected_products_activate'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_activate'));
    
                  
    
                    $products = Brand::whereIn('id', $selected_products)
                                        ->update(['status' => 1]);
                                        
             $msg = 'Brand activate Successfully.';
             return redirect()->back()->with('success',$msg);
         }else{
             return redirect()->back(); 
         }
     
   
    }  
    
    
     public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Brand::whereIn('id', $selected_products)
                                        ->get();
                                        
        foreach($products as $data){
  
      if($data->photo == null){
            $data->delete();
            //--- Redirect Section
            
             return redirect()->back()->with('success','Brand deleted Successfully.');
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/brands/'.$data->photo)) {
            unlink(public_path().'/assets/images/brands/'.$data->photo);
        }
      
      
        $data->delete();
         }                      
                                        
          
            
          return redirect()->back()->with('success','Brand deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }
}
