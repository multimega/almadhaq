<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Blog::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Blog $data) {
                                $photo = $data->photo ? url('assets/images/blogs/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->addColumn('action', function(Blog $data) {
                                return '<div class="action-list-radius"><a  href="' . route('admin-blog-edit',$data->id) . '" class="main-bg-dark me-2 text-white"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-blog-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger text-white"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.blog.index');
    }

    //*** GET Request
    public function create()
    {
        $cats = BlogCategory::all();
        return view('admin.blog.create',compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
               'category_id'                    =>'required',
               'photo'                          =>'required|mimes:jpeg,jpg,png,svg',
               'title'                          =>'required',
               'title_ar'                       =>'required',
               'alt'                            =>'required',
               'alt_ar'                         =>'required',
               'author'                         =>'required',
               'source'                         =>'required',
               
               
               
            ];

        $messages = [
            
           'category_id.required'              => trans('Category') . '  '. trans('required'),              
           'photo.mimes'                       => trans('ImgMimes'),
           'title.required'                    => trans('Title') . '  '. trans('required'),   
           'title_ar.required'                 => trans('Arabic Title') . '  '. trans('required'), 
           'alt.required'                      => trans('Blog ALt') . '  '. trans('required'), 
           'alt_ar.required'                   => trans('Blog ALt') . '  '. trans('required'), 
           'Author.required'                   => trans('Author') . '  '. trans('required'), 
           'source.required'                   => trans('Source') . '  '. trans('required'),
           
            
            
            
        
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
        $data = new Blog();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/blogs',$name);           
            $input['photo'] = $name;
        } 
        if (!empty($request->meta_tag)) 
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);       
         }  
        if (!empty($request->tags)) 
         {
            $input['tags'] = implode(',', $request->tags);       
         }
        if ($request->secheck == "") 
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;         
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
        $cats = BlogCategory::all();
        $data = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('data','cats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
         $rules = [
            
               'category_id'                    =>'required',
               'photo'                          =>'mimes:jpeg,jpg,png,svg',
               'title'                          =>'required',
               'title_ar'                       =>'required',
               'alt'                            =>'required',
               'alt_ar'                         =>'required',
               'author'                         =>'required',
               'source'                         =>'required',
               
               
               
            ];

        $messages = [
            
           'category_id.required'              => trans('Category') . '  '. trans('required'),              
           'photo.mimes'                       => trans('ImgMimes'),
           'title.required'                    => trans('Title') . '  '. trans('required'),   
           'title_ar.required'                 => trans('Arabic Title') . '  '. trans('required'), 
           'alt.required'                      => trans('Blog ALt') . '  '. trans('required'), 
           'alt_ar.required'                   => trans('Blog ALt') . '  '. trans('required'), 
           'Author.required'                   => trans('Author') . '  '. trans('required'), 
           'source.required'                   => trans('Source') . '  '. trans('required'),
           
            
            
            
        
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
        $data = Blog::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/blogs',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/blogs/'.$data->photo)) {
                        unlink(public_path().'/assets/images/blogs/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            } 
        if (!empty($request->meta_tag)) 
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);       
         } 
        else {
            $input['meta_tag'] = null;
         }
        if (!empty($request->tags)) 
         {
            $input['tags'] = implode(',', $request->tags);       
         }
        else {
            $input['tags'] = null;
         } 
        if ($request->secheck == "") 
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;         
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
        $data = Blog::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            $msg = 'Data Deleted Successfully.';
            return response()->json($msg);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/blogs/'.$data->photo)) {
            unlink(public_path().'/assets/images/blogs/'.$data->photo);
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
}
