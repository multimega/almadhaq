<?php

namespace App\Http\Controllers\Admin;
use DataTables;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class FaqController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Faq::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('details', function(Faq $data) {
                                $details = strlen(strip_tags($data->details)) > 250 ? substr(strip_tags($data->details),0,250).'...' : strip_tags($data->details);
                                return  $details;
                            })
                            ->addColumn('action', function(Faq $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-faq-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-faq-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.faq.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.faq.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section


          $rules = [
            
            'title'                                         => 'required',
            'title_ar'                                      => 'required',
           
            
        ];
        
        $messages = [
            
             'title.required'                               => trans('Title') . '  '. trans('required'),   
             'title_ar.required'                            => trans('Arabic Title') . '  '. trans('required'), 
            
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
        $data = new Faq();
        $input = $request->all();
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
        $data = Faq::findOrFail($id);
        return view('admin.faq.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

          $rules = [
            
            'title'                                         => 'required',
            'title_ar'                                      => 'required',
           
            
        ];
        
        $messages = [
            
             'title.required'                               => trans('Title') . '  '. trans('required'),   
             'title_ar.required'                            => trans('Arabic Title') . '  '. trans('required'), 
            
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
        $data = Faq::findOrFail($id);
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

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Faq::findOrFail($id);
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
