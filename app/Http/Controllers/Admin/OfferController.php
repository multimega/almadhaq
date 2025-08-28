<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Page;
use App\Models\Offer;
use App\Models\Product;
use App\Models\OfferProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class OfferController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Offer::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('header', function(Offer $data) {
                                $class = $data->header == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->header == 1 ? 'selected' : '';
                                $ns = $data->header == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-offer-header2',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Showed</option><option data-val="0" value="'. route('admin-offer-header2',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Not Showed</option></select></div>';
                            }) 
                            ->addColumn('content', function(Offer $data) {
                                $class = $data->content == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->content == 1 ? 'selected' : '';
                                $ns = $data->content == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-offer-footer',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Showed</option><<option data-val="0" value="'. route('admin-offer-footer',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Not Showed</option>/select></div>';
                            }) 
                            ->addColumn('action', function(Offer $data) {
                                return '<div class="action-list">
                                <a data-href="' . route('admin-offer-products',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Products</a><a data-href="' . route('admin-offer-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-offer-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['header','content','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.offer.index');
    }

    //*** GET Request
    public function create()
    {
        $pro = Product::where('status',1)->get();
        return view('admin.offer.create',compact('pro'));
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
           
            'slug'                                      => 'required|unique:offers',
            'slug_ar'                                   => 'required|unique:offers',
            'name'                                      => 'required',
            'name_ar'                                   => 'required',
            'product_id.*'                              => 'required'
            
            
        ];
        $messages  = [
          
            
            'slug.required'                             => trans('Slug') . '    ' . trans('required'),
            'slug.unique'                               => trans('Cat Slug'),
            'slug_ar.unique'                            => trans('Slug') .'     '.'Arabic'. '    ' . trans('unique'),
            'slug_ar.required'                          => trans('Slug') .'     '.'Arabic'. '    ' . trans('required'),
            'name.required'                             => trans('Name') . '    ' . trans('required'),
            'name_ar.required'                          => trans('Arabic Name') .'    ' . trans('required'),
            'name_ar.required'                          => trans('Arabic Name') .'    ' . trans('required'),
            'product_id.*.required'                     => trans('Products') .'    ' . trans('required'),
          
          
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
        
        $data = new Offer();
        $input = $request->all();
 
       
        $data->fill($input)->save();
        if($request->product_id){
                               $interest_array = $request->product_id;
                               
                                    $array_len = count($interest_array);
                                    for ($i = 0; $i < $array_len; $i++) {
                                       
                                        $related = new OfferProduct();
                                        $related->product_id = $interest_array[$i];
                                        $related->offer_id = $data->id;
                                        
                                        $related->save();
                                    
                                    } 
            
        }
        
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
        $data = Offer::findOrFail($id);
        $pro = Product::where('status',1)->get();
        return view('admin.offer.edit',compact('data','pro'));
    }

    //*** POST Request
    // public function update(Request $request, $id)
    // {
    //     //--- Validation Section
    //     $slug = $request->slug;
    //     $main = array('home','faq','contact','blog','cart','checkout');
    //     if (in_array($slug, $main)) {
    //     return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
    //     }
    //     $rules = ['slug' => 'unique:offers,slug,'.$id];
    //   $rules = [
           
    //         'slug'                                      => 'required|' . 'unique:offers,slug'   .$id,
    //         'slug_ar'                                   => 'required|' . 'unique:offers,slug_ar' .$id,
    //         'name'                                      => 'required',
    //         'name_ar'                                   => 'required',
    //         'product_id.*'                              => 'required'
            
            
    //     ];
    //     $messages  = [
          
            
    //         'slug.required'                             => trans('Slug') . '    ' . trans('required'),
    //         'slug.unique'                               => trans('Cat Slug'),
    //         'slug_ar.unique'                            => trans('Slug') .'     '.'Arabic'. '    ' . trans('unique'),
    //         'slug_ar.required'                          => trans('Slug') .'     '.'Arabic'. '    ' . trans('required'),
    //         'name.required'                             => trans('Name') . '    ' . trans('required'),
    //         'name_ar.required'                          => trans('Arabic Name') .'    ' . trans('required'),
    //         'name_ar.required'                          => trans('Arabic Name') .'    ' . trans('required'),
    //         'product_id.*.required'                     => trans('Products') .'    ' . trans('required'),
          
          
    //         ];
    //     $validator = Validator::make($request->all(), $rules, $messages);

    //     if ($validator->fails()) {
    //       return response()->json([
    //           'status' =>false,
    //           'errors' => $validator->messages(),
              
    //           ],200);
    //     }    
    //     //--- Validation Section Ends

    //     //--- Logic Section
    //     $data = Offer::findOrFail($id);
    //     $input = $request->all();
      
       
    //     $data->update($input);
    //     //--- Logic Section Ends
    //              if($request->product_id){
    //                      OfferProduct::where('offer_id',$id)->delete();
    //                           $interest_array = $request->product_id;
                               
    //                                 $array_len = count($interest_array);
    //                                 for ($i = 0; $i < $array_len; $i++) {
                                       
    //                                     $related = new OfferProduct();
    //                                     $related->product_id = $interest_array[$i];
    //                                     $related->offer_id = $id;
                                        
    //                                     $related->save();
                                    
    //                                 } 
            
    //     }
    //     //--- Redirect Section     
    //   $msg = trans('Update Success');
        
        
    //     return response()->json([
            
    //         'status'  => true,
    //         'msg'   =>   $msg
            
    //     ],200);    
    //     //--- Redirect Section Ends           
    // }
    
    
     public function update(Request $request, $id)
    {
        //--- Validation Section
        $slug = $request->slug;
        $main = array('home','faq','contact','blog','cart','checkout');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }
        $rules = ['slug' => 'unique:offers,slug,'.$id];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $data = Offer::findOrFail($id);
        $input = $request->all();
      
       
        $data->update($input);
        //--- Logic Section Ends
                 if($request->product_id){
                         OfferProduct::where('offer_id',$id)->delete();
                               $interest_array = $request->product_id;
                               
                                    $array_len = count($interest_array);
                                    for ($i = 0; $i < $array_len; $i++) {
                                       
                                        $related = new OfferProduct();
                                        $related->product_id = $interest_array[$i];
                                        $related->offer_id = $id;
                                        
                                        $related->save();
                                    
                                    } 
            
        }
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
            $data = Offer::findOrFail($id1);
            $data->header = $id2;
            $data->update();
        }
      //*** GET Request Footer
      public function footer($id1,$id2)
        {
            $data = Offer::findOrFail($id1);
            $data->content = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Offer::findOrFail($id);
        OfferProduct::where('offer_id',$id)->delete();
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);      
        //--- Redirect Section Ends   
    }
    
   

    //*** GET Request
    public function products($id)
    {
        $data = OfferProduct::where('offer_id',$id)->get();
        return view('admin.offer.products',compact('data'));
    }
    
        public function productdestroy($id)
    {
        $data = OfferProduct::findOrFail($id);
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