<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;

class ChildCategoryController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Childcategory::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('category', function(Childcategory $data) {
                                
                                 if(!empty($data->subcategory->category->name)){
                                     
                                return $data->subcategory->category->name;
                                
                                }else{
                                    return 'deleted';
                                }
                            })
                            ->addColumn('subcategory', function(Childcategory $data) {
                                if(!empty($data->subcategory->name)){
                                    
                                   return $data->subcategory->name; 
                                   
                                }else{
                                    
                                    return "deleted";
                                }
                                
                            })
                            ->addColumn('status', function(Childcategory $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-childcat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-childcat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('attributes', function(Childcategory $data) {
                                $buttons = '<div class="action-list"><a data-href="' . route('admin-attr-createForChildcategory', $data->id) . '" class="attribute main-bg-light br-4" data-bs-toggle="modal" data-bs-target="#attribute"> <i class="fas fa-edit"></i>Create</a>';
                                if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin-attr-manage', $data->id) .'?type=childcategory' . '" class="edit main-bg-light br-4"> <i class="fas fa-edit"></i>Manage</a>';
                                }
                                $buttons .= '</div>';

                                return $buttons;
                            })
                             ->addColumn('checkbox', function(Childcategory $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -18px;"></span>
                               </label>
                                </div>';
                            })
                            ->addColumn('action', function(Childcategory $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-childcat-edit',$data->id) . '" class="edit main-bg-dark br-4" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-childcat-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger br-4"><i class="fas fa-trash-alt"></i> Delete</a></div>';
                            })
                            ->rawColumns(['status', 'attributes','action','checkbox'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    //*** GET Request
    public function index()
    {
        return view('admin.childcategory.index');
    }

    //*** GET Request
    public function create()
    {
      	$cats = Category::all();
        return view('admin.childcategory.create',compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
             'name'                             => 'required',
            'name_ar'                           => 'required', 
            'slug'                              => 'unique:childcategories|regex:/^[a-zA-Z0-9\s-]+$/',
            'category_id'                       => 'required',
            'subcategory_id'                    => 'required'
            
                 ];
        $messages = [
            
              'name.required'                                      => trans('Name').  '  ' . trans('required'),
              'name_ar.required'                                   => trans('Arabic Name') .  '  ' . trans('required'),
              'slug.unique'                                        =>  trans('Cat Slug'),
              'slug.regex'                                         => trans('Cat Regex'),
              'category_id.required'                               => trans('Category').  '  ' . trans('required'),
              'subcategory_id.required'                            => trans('Sub Category').  '  ' . trans('required'),
               
            
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
        $data = new Childcategory();
        $input = $request->all();
        
        
            if ($file = $request->file('photo'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/childcategories',$name);
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
        $subcats = Subcategory::all();
        $data = Childcategory::findOrFail($id);
        return view('admin.childcategory.edit',compact('data','cats','subcats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
       
        $rules = [
            
             'name'                             => 'required',
            'name_ar'                           => 'required', 
            'slug'                              => 'unique:childcategories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/',
            'category_id'                       => 'required',
            'subcategory_id'                    => 'required'
            
                 ];
        $messages = [
            
              'name.required'                                      => trans('Name').  '  ' . trans('required'),
              'name_ar.required'                                   => trans('Arabic Name') .  '  ' . trans('required'),
              'slug.unique'                                        =>  trans('Cat Slug'),
              'slug.regex'                                         => trans('Cat Regex'),
              'category_id.required'                               => trans('Category').  '  ' . trans('required'),
              'subcategory_id.required'                            => trans('Sub Category').  '  ' . trans('required'),
               
            
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
        $data = Childcategory::findOrFail($id);
        $input = $request->all();
        
             if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/childcategories',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/childcategories/'.$data->photo)) {
                        unlink(public_path().'/assets/images/childcategories/'.$data->photo);
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
            $data = Childcategory::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }

    //*** GET Request
    public function load($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Childcategory::findOrFail($id);

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

        $cats = Category::all();
      
        return view('admin.childcategory.childcategorycsv',compact('cats'));
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
                $data = new Childcategory;
        


                $input['category_id'] = null;
                $input['subcategory_id'] = null;
            

                $mcat = Category::where(DB::raw('lower(name)'), strtolower($line[0]));
                //$mcat = Category::where("name", $line[1]);

                if($mcat->exists()){
                    $input['category_id'] = $mcat->first()->id;

                    if($line[1] != ""){
                        $scat = Subcategory::where(DB::raw('lower(name)'), strtolower($line[1]));
                        if($scat->exists()) {
                            $input['subcategory_id'] = $scat->first()->id;
                            
                            $input['name'] = $line[2];
                            $input['name_ar'] = $line[3];
                            $input['slug'] = $line[4];
                            
                                           
                            // Save Data
                            $data->fill($input)->save();

                            
                        }else{
                      $log .= "<br>Row No: ".$i." - No Sub Category Found!<br>";
                      }
                    }

          

                }else{
                    $log .= "<br>Row No: ".$i." - No Category Found!<br>";
                }


            }

            $i++;

        }
        fclose($file);


        //--- Redirect Section
        $msg = 'Bulk ChildCategory File Imported Successfully.<a href="'.route('admin-childcat-index').'">View ChildCategory Lists.</a>'.$log;
        return response()->json($msg);
    }
      public function ckeckall(Request $request) {
        
             if (!empty($request->input('selected_products'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products'));
    
                  
    
                    $products = Childcategory::whereIn('id', $selected_products)
                                        ->update(['status' => 0]);
                                        
              $msg = 'Childcategory Deactivate Successfully.';                      
             return redirect()->back()->with('success',$msg);
                }else{
             return redirect()->back(); 
         }
     
   
    }
    public function ckeckactivate(Request $request) {
        
             if (!empty($request->input('selected_products_activate'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_activate'));
    
                  
    
                    $products = Childcategory::whereIn('id', $selected_products)
                                        ->update(['status' => 1]);
                                        
             $msg = 'Childcategory activate Successfully.';
           return redirect()->back()->with('success',$msg);
         }else{
             return redirect()->back(); 
         }
     
   
    }  
    
    
     public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Childcategory::whereIn('id', $selected_products)
                                        ->get();
                                        
        foreach($products as $data){
  
         if($data->attributes->count() > 0)
        {
        //--- Redirect Section
          
       
       
         return Redirect()->back()->withErrors(['Remove the Attributes first !']);
        //--- Redirect Section Ends
        }

      
        if($data->products->count()>0)
        {
        //--- Redirect Section
          
       
       
         return Redirect()->back()->withErrors([ 'Remove the products first !']);
        //--- Redirect Section Ends
        }

                              
             
        //If Photo Doesn't Exist
      
      
        $data->delete();
         }                      
                                        
          
            
          return redirect()->back()->with('success','Child category deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }
}
