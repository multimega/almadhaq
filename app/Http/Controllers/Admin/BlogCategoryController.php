<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = BlogCategory::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('action', function(BlogCategory $data) {
                                return '<div class="action-list-radius"><a data-href="' . route('admin-cblog-edit',$data->id) . '" class="edit main-bg-dark me-2" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-cblog-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger text-white"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->toJson();//--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.cblog.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.cblog.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'name'                 => 'unique:blog_categories',
               'name_ar'              => 'unique:blog_categories',
               'slug'                 => 'unique:blog_categories'
                ];
      
        $messages  = [
            
            
              'name.unique'           => trans('nameUnique'),
              'name_ar.unique'        => trans('namearUnique'),
              'slug.unique'           => trans('Cat Slug'),
          
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
        $data = new BlogCategory;
        $input = $request->all();
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
        $data = BlogCategory::findOrFail($id);
        return view('admin.cblog.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'name'                      => 'unique:blog_categories,name,'.$id,
               'name_ar'                   => 'unique:blog_categories,name,'.$id,
               'slug'                      => 'unique:blog_categories,slug,'.$id
                ];
        $messages  = [
            
            
              'name.unique'                => trans('nameUnique'),
              'name_ar.unique'             => trans('namearUnique'),
              'slug.unique'                => trans('Cat Slug'),
          
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
        $data = BlogCategory::findOrFail($id);
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

    //*** GET Request
    public function destroy($id)
    {
        $data = BlogCategory::findOrFail($id);

        //--- Check If there any blogs available, If Available Then Delete it 
        if($data->blogs->count() > 0)
        {
            foreach ($data->blogs as $element) {
                $element->delete();
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
}
