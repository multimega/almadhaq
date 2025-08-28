<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class PageController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Page::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('header', function(Page $data) {
                                $class = $data->header == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->header == 1 ? 'selected' : '';
                                $ns = $data->header == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-page-header',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Showed</option><option data-val="0" value="'. route('admin-page-header',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Not Showed</option></select></div>';
                            }) 
                            ->addColumn('footer', function(Page $data) {
                                $class = $data->footer == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->footer == 1 ? 'selected' : '';
                                $ns = $data->footer == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-page-footer',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Showed</option><<option data-val="0" value="'. route('admin-page-footer',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Not Showed</option>/select></div>';
                            }) 
                            ->addColumn('action', function(Page $data) {
                                return '<div class="action-list"><a  href="' . route('admin-page-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-page-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['header','footer','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.page.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.page.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $slug = $request->slug;
        $main = array('home','faq','contact','blog','cart','checkout');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }
        $rules = [
            
            'title'                                    =>'required',
            'title_ar'                                 =>'required',
            'slug'                                     => 'required|unique:pages',
            'slug_ar'                                  => 'required|unique:pages'
            
        ];
        $messages  = [
           
            'title.required'                           => trans('Title') . '  '. trans('required'),   
            'title_ar.required'                        => trans('Arabic Title') . '  '. trans('required'), 
            'slug.unique'                              => trans('Cat Slug'),
            'slug.required'                            => trans('Slug'). '  '. trans('required'), 
            'slug_ar.unique'                           => trans('ArabicSlug Unique'),
            'slug_ar.required'                         => trans('Arabic Slug'). '  '. trans('required'), 
          
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
        $data = new Page();
        $input = $request->all();
 
        if (!empty($request->meta_tag)) 
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);       
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
        $data = Page::findOrFail($id);
        return view('admin.page.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $slug = $request->slug;
        $main = array('home','faq','contact','blog','cart','checkout');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }
       
       
     
          $rules = [
            
            'title'                                    =>'required',
            'title_ar'                                 =>'required',
            'slug'                                     => 'unique:pages,slug,'.$id . '|required' ,
            'slug_ar'                                  => 'unique:pages,slug_ar,'.$id . '|required'
            
        ];
        $messages  = [
           
            'title.required'                           => trans('Title') . '  '. trans('required'),   
            'title_ar.required'                        => trans('Arabic Title') . '  '. trans('required'), 
            'slug.unique'                              => trans('Cat Slug'),
            'slug.required'                            => trans('Slug'). '  '. trans('required'), 
            'slug_ar.unique'                           => trans('ArabicSlug Unique'),
            'slug_ar.required'                         => trans('Arabic Slug'). '  '. trans('required'), 
          
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
        $data = Page::findOrFail($id);
        $input = $request->all();
        if (!empty($request->meta_tag)) 
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);       
         } 
         else {
            $input['meta_tag'] = null;
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
      //*** GET Request Header
      public function header($id1,$id2)
        {
            $data = Page::findOrFail($id1);
            $data->header = $id2;
            $data->update();
        }
      //*** GET Request Footer
      public function footer($id1,$id2)
        {
            $data = Page::findOrFail($id1);
            $data->footer = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Page::findOrFail($id);
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