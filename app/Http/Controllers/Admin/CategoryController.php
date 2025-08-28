<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Category::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(Category $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-cat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-cat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('attributes', function(Category $data) {
                                $buttons = '<div class="action-list"><a data-href="' . route('admin-attr-createForCategory', $data->id) . '" class="attribute main-bg-light br-4" data-bs-toggle="modal" data-bs-target="#attribute"> <i class="fas fa-edit"></i>Create</a>';
                                if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin-attr-manage', $data->id) .'?type=category' . '" class="edit main-bg-light br-4"> <i class="fas fa-edit"></i>Manage</a>';
                                }
                                $buttons .= '</div>';

                                return $buttons;
                            })
                             ->addColumn('checkbox', function(Category $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -18px;"></span>
                               </label>
                                </div>';
                            })
                            ->addColumn('action', function(Category $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-cat-edit',$data->id) . '" class="edit main-bg-dark br-4" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-cat-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger br-4"><i class="fas fa-trash-alt"></i> Delete</a></div>';
                            })
                            ->rawColumns(['status','attributes','action','checkbox'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.category.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.category.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
       
        $rules = [
            
            'name'                 => 'required',
            'name_ar'              => 'required',
            'photo'                => 'mimes:jpeg,jpg,png,svg,webp',
            'slug'                 => 'unique:categories|regex:/^[a-zA-Z0-9\s-]+$/'
            ];
      
      
      
        $messages  = [
            'name.required'           => trans('Name').  '  ' . trans('required'),
            'name_ar.required'        => trans('Arabic Name') .  '  ' . trans('required'),
            'photo.mimes'             => trans('Cat Mimes'),
            'slug.unique'             => trans('Cat Slug'),
            'slug.regex'              => trans('Cat Regex'),
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
        $data = new Category();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/categories',$name);
            $input['photo'] = $name;
        }
        if ($request->is_featured == ""){
            $input['is_featured'] = 0;
        }
        else {
                $input['is_featured'] = 1;
                //--- Validation Section
                $rules = [
                    'image' => 'required|mimes:jpeg,jpg,png,svg'
                        ];
               
               
                $messages = [
                    'image.required' => trans('imgRequired'),
                    'image.mimes' =>  trans('Cat Mimes'),
                        ];
                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                  return response()->json([
                      'status' =>false,
                      'errors' => $validator->messages(),
                      
                      ],200);
                }
                //--- Validation Section Ends
                if ($file = $request->file('image'))
                {
                   $name = time().$file->getClientOriginalName();
                   $file->move('assets/images/categories',$name);
                   $input['image'] = $name;
                }
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
        $data = Category::findOrFail($id);
        return view('admin.category.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            
            
            'name'                 => 'required',
            'name_ar'              => 'required',
        	'photo'                => 'mimes:jpeg,jpg,png,svg,webp',
        	'slug'                 => 'unique:categories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
        		 ];
           $messages  = [
               
            'name.required'           => trans('Name').  '  ' . trans('required'),
            'name_ar.required'        => trans('Arabic Name') .  '  ' . trans('required'),
            'photo.mimes' => trans('Cat Mimes'),
            'slug.unique' => trans('Cat Slug'),
            'slug.regex' => trans('Cat Regex'),
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
        $data = Category::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/categories',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
                        unlink(public_path().'/assets/images/categories/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }

            if ($request->is_featured == ""){
                $input['is_featured'] = 0;
            }
            else {
                    $input['is_featured'] = 1;
                    //--- Validation Section
                    $rules = [
                        'image' => 'mimes:jpeg,jpg,png,svg'
                            ];
                    $customs = [
                        'image.required' => 'Feature Image is required.'
                            ];
                    $validator = Validator::make($request->all(), $rules, $customs);

                    if ($validator->fails()) {
                    return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                    }
                    //--- Validation Section Ends
                    if ($file = $request->file('image'))
                    {
                       $name = time().$file->getClientOriginalName();
                       $file->move('assets/images/categories',$name);
                       $input['image'] = $name;
                    }
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
          $data = Category::findOrFail($id1);
          $data->status = $id2;
          $data->update();
      }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        $msg = trans('attrMsg');
      
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);
        //--- Redirect Section Ends
        }

        if($data->subs->count()>0)
        {
        //--- Redirect Section
        $msg = trans('subCatMsg');
      
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
        
         if(!empty($data->photo)) {
        if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
            unlink(public_path().'/assets/images/categories/'.$data->photo);
        }
        
         }
          if(!empty($data->image)) {
        if (file_exists(public_path().'/assets/images/categories/'.$data->image)) {
            unlink(public_path().'/assets/images/categories/'.$data->image);
        }
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

        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
         return view('admin.category.categorycsv',compact('cats','sign'));
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
                $data = new Category;
               

                $input['name'] = $line[0];
                $input['name_ar'] = $line[1];
                $input['slug'] = $line[2];

                $input['photo'] = !empty($line[3]) ? $line[3] : null ;
              
                // Save Data
                $data->fill($input)->save();

          

               


            }

            $i++;

        }
        fclose($file);


        //--- Redirect Section
        $msg = 'Bulk Category File Imported Successfully.<a href="'.route('admin-cat-index').'">View Category Lists.</a>'.$log;
        return response()->json($msg);
    } 
    
            public function ckeckall(Request $request) {
        
             if (!empty($request->input('selected_products'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products'));
    
                  
    
                    $products = Category::whereIn('id', $selected_products)
                                        ->update(['status' => 0]);
                                        
              $msg = 'Category Deactivate Successfully.';                      
             return redirect()->back()->with('success',$msg);
                }else{
             return redirect()->back(); 
         }
     
   
    }
    public function ckeckactivate(Request $request) {
        
             if (!empty($request->input('selected_products_activate'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_activate'));
    
                  
    
                    $products = Category::whereIn('id', $selected_products)
                                        ->update(['status' => 1]);
                                        
             $msg = 'Category activate Successfully.';
           return redirect()->back()->with('success',$msg);
         }else{
             return redirect()->back(); 
         }
     
   
    }  
    
    
     public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Category::whereIn('id', $selected_products)
                                        ->get();
                                        
        foreach($products as $data){
  
         if($data->attributes->count() > 0)
        {
        //--- Redirect Section
          
       
       
         return Redirect()->back()->withErrors(['Remove the Attributes first !']);
        //--- Redirect Section Ends
        }

        if($data->subs->count()>0)
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
     
            return redirect()->back()->with('success','category deleted Successfully.');
            //--- Redirect Section Ends
        }
        //If Photo Exist
         if(!empty($data->photo)) {
        if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
            unlink(public_path().'/assets/images/categories/'.$data->photo);
        }
        
         }
         
          if(!empty($data->image)) {
        if (file_exists(public_path().'/assets/images/categories/'.$data->image)) {
            unlink(public_path().'/assets/images/categories/'.$data->image);
        }
        
    }
          
          
        $data->delete();
         }                      
                                        
          
            
          return redirect()->back()->with('success','category deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }
}
