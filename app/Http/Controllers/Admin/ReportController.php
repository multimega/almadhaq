<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	public function __construct()
	    {
	        $this->middleware('auth:admin');
	    }

	    //*** JSON Request
	    public function datatables()
	    {
	         $datas = Report::orderBy('id')->get();
	         //--- Integrating This Collection Into Datatables
	         return Datatables::of($datas)
	                            ->addColumn('product', function(Report $data) {
	                                if(!empty($data->product->name)) {
	                                $name = strlen(strip_tags($data->product->name)) > 50 ? substr(strip_tags($data->product->name),0,50).'...' : strip_tags($data->product->name);
	                                $product = '<a href="'.route('front.product', $data->product->slug).'" target="_blank">'.$name.'</a>';
	                                return $product;
	                                }
	                            })
	                            ->addColumn('reporter', function(Report $data) {
	                                
	                                if(!empty($data->user->name)) {
	                                $name = $data->user->name;
	                                return $name;
	                               }
	                               
	                            })
	                            ->addColumn('title', function(Report $data) {
	                                $text = strlen(strip_tags($data->title)) > 250 ? substr(strip_tags($data->title),0,250).'...' : strip_tags($data->title);
	                                return $text;
	                            })
	                            ->addColumn('action', function(Report $data) {
	                                return '<div class="action-list-radius"><a data-href="' . route('admin-report-show',$data->id) . '" class="main-bg-dark me-2" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-eye me-1"></i>Details</a><a href="javascript:;" data-href="' . route('admin-report-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger text-white"><i class="fas fa-trash-alt"></i></a></div>';
	                            }) 
	                            ->rawColumns(['product','action'])
	                            ->toJson(); //--- Returning Json Data To Client Side
	    }
	    //*** GET Request
	    public function index()
	    {
	        return view('admin.report.index');
	    }

	    //*** GET Request
	    public function show($id)
	    {
	        $data = Report::findOrFail($id);
	        return view('admin.report.show',compact('data'));
	    }


	    //*** GET Request Delete
		public function destroy($id)
		{
		    $data = Report::findOrFail($id);
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
