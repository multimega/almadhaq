<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Subcategory::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('category', function(Subcategory $data) {
                                if(!empty($data->category->name)){
                                return $data->category->name;
                                }else{
                                    return 'deleted';
                                }
                            })
                            ->addColumn('status', function(Subcategory $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-subcat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-subcat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('attributes', function(Subcategory $data) {
                                $buttons = '<div class="action-list"><a data-href="' . route('admin-attr-createForSubcategory', $data->id) . '" class="attribute main-bg-light br-4" data-bs-toggle="modal" data-bs-target="#attribute"> <i class="fas fa-edit"></i>Create</a>';
                                if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin-attr-manage', $data->id) .'?type=subcategory' . '" class="edit main-bg-light br-4"> <i class="fas fa-edit"></i>Manage</a>';
                                }
                                $buttons .= '</div>';

                                return $buttons;
                            })
                            ->addColumn('checkbox', function(Subcategory $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -18px;"></span>
                               </label>
                                </div>';
                            })
                            ->addColumn('action', function(Subcategory $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-subcat-edit',$data->id) . '" class="edit main-bg-dark br-4" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-subcat-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger br-4"><i class="fas fa-trash-alt"></i> Delete</a></div>';
                            })
                            ->rawColumns(['status','attributes','action','checkbox'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.subcategory.index');
    }

    //*** GET Request
    public function create()
    {
      	$cats = Category::all();
        return view('admin.subcategory.create',compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
                    'name'                 => 'required',
                    'name_ar'              => 'required',
                    'photo'                => 'mimes:jpeg,jpg,png,svg',
                    'slug'                 => 'unique:subcategories|regex:/^[a-zA-Z0-9\s-]+$/',
                    'category_id'          => 'required'
                 ];
        
        
        
        $messages = [
            
             'name.required'                                      => trans('Name').  '  ' . trans('required'),
             'name_ar.required'                                   => trans('Arabic Name') .  '  ' . trans('required'),
             'photo.mimes'                                        => trans('Cat Mimes'),
             'slug.unique'                                        =>  trans('Cat Slug'),
             'slug.regex'                                         => trans('Cat Regex'),
             'category_id.required'                               => trans('Category').  '  ' . trans('required'),
                  
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
        $data = new Subcategory();
        $input = $request->all();
        
             if ($file = $request->file('photo'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/subcategories',$name);
            $input['photo'] = $name;
        }
        
        if (!empty($request->meta_tag))
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);
         }else {
               
              $input['meta_tag']= null;
 
         }




        if (!empty($request->tags))
         {
            $input['tags'] = implode(',', $request->tags);
         }
        if (empty($request->tags))
         {
            $input['tags'] = null;
         }


       

if (!empty($request->tags_ar))
         {
            $input['tags_ar'] = implode(',', $request->tags_ar);
         }
        if (empty($request->tags_ar))
         {
            $input['tags_ar'] = null;
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
    	$cats = Category::all();
        $data = Subcategory::findOrFail($id);
        return view('admin.subcategory.edit',compact('data','cats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
     
      $rules = [
            
                    'name'                 => 'required',
                    'name_ar'              => 'required',
                    'photo'                => 'mimes:jpeg,jpg,png,svg',
                    'slug'                 => 'unique:subcategories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/',
                    'category_id'          => 'required'
                 ];
        
        
        
        $messages = [
            
             'name.required'                                      => trans('Name').  '  ' . trans('required'),
             'name_ar.required'                                   => trans('Arabic Name') .  '  ' . trans('required'),
             'photo.mimes'                                        => trans('Cat Mimes'),
             'slug.unique'                                        =>  trans('Cat Slug'),
             'slug.regex'                                         => trans('Cat Regex'),
             'category_id.required'                               => trans('Category').  '  ' . trans('required'),
                  
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
        $data = Subcategory::findOrFail($id);
        $input = $request->all();
           if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/subcategories',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/subcategories/'.$data->photo)) {
                        unlink(public_path().'/assets/images/subcategories/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }
            
            
          if (!empty($request->meta_tag))
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);
         }else {
               
              $input['meta_tag']= null;
 
         }




        if (!empty($request->tags))
         {
            $input['tags'] = implode(',', $request->tags);
         }
        if (empty($request->tags))
         {
            $input['tags'] = null;
         }


       

if (!empty($request->tags_ar))
         {
            $input['tags_ar'] = implode(',', $request->tags_ar);
         }
        if (empty($request->tags_ar))
         {
            $input['tags_ar'] = null;
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

      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = Subcategory::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }

    //*** GET Request
    public function load($id)
    {
        $cat = Category::findOrFail($id);
        return view('load.subcategory',compact('cat'));
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Subcategory::findOrFail($id);


        if($data->attributes->count()>0)
        {
        //--- Redirect Section
        $msg = trans('attrMsg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);
        //--- Redirect Section Ends
        }
        if($data->childs->count()>0)
        {
        //--- Redirect Section
        $msg = trans('childCatMsg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);
        //--- Redirect Section Ends
        }
        if($data->products->count()>0)
        {
        //--- Redirect Section
        $msg = trans('prodMsg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);
        //--- Redirect Section Ends
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
      public function import(){

        $cats = Subcategory::all();
        
         return view('admin.subcategory.subcategorycsv',compact('cats'));
    }

    public function importSubmit(Request $request)
    {
        $log = "";
        //--- Validation Section
        $rules = [
            'csvfile'      => 'required|mimes:csv,txt',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $filename = '';
        if ($file = $request->file('csvfile'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            $file->move('assets/temp_files',$filename);
        }

        //$filename = $request->file('csvfile')->getClientOriginalName();
        //return response()->json($filename);
        $datas = "";

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $i = 1;
        while (($line = fgetcsv($file)) !== FALSE) {

            if($i != 1)
            {

           


                //--- Logic Section
                $data = new Subcategory;
               
             $mcat = Category::where(DB::raw('lower(name)'), strtolower($line[0]));
                //$mcat = Category::where("name", $line[1]);

                if($mcat->exists()){
                  $input['category_id'] = $mcat->first()->id;
                  $input['name'] = $line[1];
                  $input['name_ar'] = $line[2];
                  $input['slug'] = $line[3];
 
              
                // Save Data
                $data->fill($input)->save();

          
            
                }else{
                    $log .= "<br>Row No: ".$i." - No Category Found!<br>";
                }
          

           

               


            }

            $i++;

        }
        fclose($file);


        //--- Redirect Section
        $msg = 'Bulk SubCategory File Imported Successfully.<a href="'.route('admin-subcat-index').'">View SubCategory Lists.</a>'.$log;
        return response()->json($msg);
    } 
    
          public function ckeckall(Request $request) {
        
             if (!empty($request->input('selected_products'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products'));
    
                  
    
                    $products = Subcategory::whereIn('id', $selected_products)
                                        ->update(['status' => 0]);
                                        
              $msg = 'SubCategory Deactivate Successfully.';                      
             return redirect()->back()->with('success',$msg);
                }else{
             return redirect()->back(); 
         }
     
   
    }
    public function ckeckactivate(Request $request) {
        
             if (!empty($request->input('selected_products_activate'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_activate'));
    
                  
    
                    $products = Subcategory::whereIn('id', $selected_products)
                                        ->update(['status' => 1]);
                                        
             $msg = 'subCategory activate Successfully.';
           return redirect()->back()->with('success',$msg);
         }else{
             return redirect()->back(); 
         }
     
   
    }  
    
    
     public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Subcategory::whereIn('id', $selected_products)
                                        ->get();
                                        
        foreach($products as $data){
  
         if($data->attributes->count() > 0)
        {
        //--- Redirect Section
          
       
       
         return Redirect()->back()->withErrors(['Remove the Attributes first !']);
        //--- Redirect Section Ends
        }

        if($data->childs->count()>0)
        {
        //--- Redirect Section
       
       
      Session::flash('error','Remove the subcategory first !');
       return Redirect()->back();
        //--- Redirect Section Ends
        }
        if($data->products->count()>0)
        {
        //--- Redirect Section
          
       
       
         return Redirect()->back()->withErrors([ 'Remove the products first !']);
        //--- Redirect Section Ends
        }

                              
             
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section
     
            return redirect()->back()->with('success','subcategory deleted Successfully.');
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/subcategories/'.$data->photo)) {
            unlink(public_path().'/assets/images/subcategories/'.$data->photo);
        }
      
        $data->delete();
         }                      
                                        
          
            
          return redirect()->back()->with('success','subcategory deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }
}
