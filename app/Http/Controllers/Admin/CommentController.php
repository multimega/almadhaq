<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;


class CommentController extends Controller
{
	public function __construct()
	    {
	        $this->middleware('auth:admin');
	    }

	    //*** JSON Request
	    public function datatables()
	    {
	         $datas = Comment::orderBy('id')->get();
	         //--- Integrating This Collection Into Datatables
	         return Datatables::of($datas)
	                            ->addColumn('product', function(Comment $data) {
	                                $name = strlen(strip_tags($data->product->name)) > 50 ? substr(strip_tags($data->product->name),0,50).'...' : strip_tags($data->product->name);
	                                $product = '<a href="'.route('front.product',$data->product->slug).'" target="_blank">'.$name.'</a>';
	                                return $product;
	                            })
	                            ->addColumn('commenter', function(Comment $data) {
	                               if(!empty($data->user->name)){
	                                $name = $data->user->name;
	                                return $name;
	                            }
	                            })
	                            ->addColumn('text', function(Comment $data) {
	                                $text = strlen(strip_tags($data->text)) > 250 ? substr(strip_tags($data->text),0,250).'...' : strip_tags($data->text);
	                                return $text;
	                            })
	                            ->addColumn('action', function(Comment $data) {
	                                return '<div class="action-list-radius"><a data-href="' . route('admin-comment-show',$data->id) . '" class="main-bg-dark me-2" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-eye me-1"></i>Details</a><a href="javascript:;" data-href="' . route('admin-comment-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete bg-danger text-white"><i class="fas fa-trash-alt"></i></a></div>';
	                            }) 
	                            ->rawColumns(['product','action'])
	                            ->toJson(); //--- Returning Json Data To Client Side
	    }
	    //*** GET Request
	    public function index()
	    {
	        return view('admin.comment.index');
	    }

	    //*** GET Request
	    public function show($id)
	    {
	        $data = Comment::findOrFail($id);
	        return view('admin.comment.show',compact('data'));
	    }


	    //*** GET Request Delete
		public function destroy($id)
		{
		    $comment = Comment::findOrFail($id);
		    if($comment->replies->count() > 0)
		    {
		        foreach ($comment->replies as $reply) {
		            $reply->delete();
		        }
		    }
		    $comment->delete();
		    //--- Redirect Section     
		   $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);  
		    //--- Redirect Section Ends    
		}
}