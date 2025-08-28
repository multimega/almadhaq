<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Feature;
use App\Models\Piece;
use App\Models\Product;
use App\Models\Propiece;
use App\Models\Procoupon;

use App\Models\Catcoupon;
use App\Models\Subcatcoupon;
use App\Models\Childcatcoupon;
use App\Models\Brandcoupon;

use App\Models\Free;
use App\Models\Profree;
use App\Models\Currency;
use App\Models\User;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {


        $datas = Coupon::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('type', function (Coupon $data) {
                $type = $data->type == 0 ? "Discount By Percentage" : "Discount By Amount";
                return $type;
            })
            ->editColumn('price', function (Coupon $data) {
                $sign = Currency::where('is_default', 1)->first();
                $price = $data->type == 0 ? $data->price . ' %' : $data->price . ' ' . $sign->sign;
                return $price;
            })->editColumn('limited', function (Coupon $data) {
                $sign = Currency::where('is_default', 1)->first();
                $limit = $data->limited < 0 ? $data->limited . ' %' : $data->limited . ' ' . $sign->sign;
                return $limit;
            })->editColumn('user_id', function (Coupon $data) {
                $name = User::select('name')->where('id', $data->user_id)->first();
                $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
                return $user;
            })
            ->addColumn('status', function (Coupon $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-coupon-status', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-coupon-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function (Coupon $data) {


                if ($data->what == 'product') {
                    return '<div class="action-list"><a data-href="' . route('admin-coupon-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a> <a href="' . route('admin-coupon-pro', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>Products</a><a href="javascript:;" data-href="' . route('admin-coupon-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                } elseif ($data->what == 'cat') {
                    return '<div class="action-list"><a data-href="' . route('admin-coupon-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a> <a href="' . route('admin-coupon-cat', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>Cats</a><a href="javascript:;" data-href="' . route('admin-coupon-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                } elseif ($data->what == 'subcat') {
                    return '<div class="action-list"><a data-href="' . route('admin-coupon-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a> <a href="' . route('admin-coupon-subcat', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>SubCats</a><a href="javascript:;" data-href="' . route('admin-coupon-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                } elseif ($data->what == 'childcat') {
                    return '<div class="action-list"><a data-href="' . route('admin-coupon-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a> <a href="' . route('admin-coupon-childcat', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>ChildCats</a><a href="javascript:;" data-href="' . route('admin-coupon-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                } elseif ($data->what == 'free_shipping') {
                    return '<div class="action-list"><a data-href="' . route('admin-coupon-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-coupon-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                } else {

                    return '<div class="action-list"><a data-href="' . route('admin-coupon-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a> <a href="' . route('admin-coupon-brand', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>Brands</a><a href="javascript:;" data-href="' . route('admin-coupon-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                }
            })
            ->rawColumns(['status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function indexpro($id)
    {
        $pro = Procoupon::where('code_id', $id)->get();

        return view('admin.coupon.pro', compact('pro'));
    }




    public function destroypro($id)
    {
        $data = Procoupon::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }






    public function indexcat($id)
    {
        $cats = Catcoupon::where('code_id', $id)->get();

        return view('admin.coupon.cat', compact('cats'));
    }




    public function destroycat($id)
    {
        $data = Catcoupon::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }



    public function indexsubcat($id)
    {
        $subcats = Subcatcoupon::where('code_id', $id)->get();

        return view('admin.coupon.subcat', compact('subcats'));
    }




    public function destroysubcat($id)
    {
        $data = Subcatcoupon::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }


    public function indexchildcat($id)
    {
        $childcats = Childcatcoupon::where('code_id', $id)->get();

        return view('admin.coupon.childcat', compact('childcats'));
    }




    public function destroychildcat($id)
    {
        $data = Childcatcoupon::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }


    public function indexbrand($id)
    {
        $brands = Brandcoupon::where('code_id', $id)->get();

        return view('admin.coupon.brand', compact('brands'));
    }




    public function destroybrand($id)
    {
        $data = Brandcoupon::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }




    //*** GET Request
    public function index()
    {

        return view('admin.coupon.index');
    }

    //*** GET Request
    public function create()
    {
        $users = User::get();
        $pro = Product::where('status', 1)->get();
        $cats =    Category::get();
        $subcats = Subcategory::get();
        $childcats = Childcategory::get();
        $brands = Brand::get();
        return view('admin.coupon.create', compact('users', 'pro', 'cats', 'subcats', 'childcats', 'brands'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [

            'code'                                 => 'required|unique:coupons',
            'limited'                              => 'required',
            'start_date'                           => 'required',
            'end_date'                             => 'required',
            'photo'                                => 'mimes:jpeg,jpg,png,svg',

        ];
        $messages = [

            'code.required'                         => trans('Code') . '    ' . trans('required'),
            'code.unique'                           => trans('codeUnique'),
            'user_id.required'                      => trans('Users') . '    ' . trans('required'),
            'type.required'                         => trans('Type') . '    ' . trans('required'),
            'price.required'                        => trans('Price') . '    ' . trans('required'),
            'price.numeric'                         => trans('Price') . '    ' . trans('numeric'),
            'price.min'                             => trans('Price') . '    ' . trans('min'),
            'limited.required'                      => trans('Limited') . '    ' . trans('required'),
            'start_date.required'                   => trans('Start Date') . '    ' . trans('required'),
            'end_date.required'                     => trans('End Date') . '    ' . trans('required'),
            'photo.mimes'                           => trans('ImgMimes'),






        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),

            ], 200);
        }
        //--- Validation Section Ends


        if ($request->what != 'free_shipping') {
            /*if(empty($request->type)) {
              
              
               $msg = "Discount Type is Required";
               return response()->json([
            
                        'status'  => true,
                        'msg'   =>   $msg
                        
                    ],200); 
            }
            */
            if (empty($request->price) || $request->price < 0) {

                $msg = "Price is Required And Cant Not Be Less Than Zero";
                return response()->json([

                    'status'  => true,
                    'msg'   =>   $msg

                ], 200);
            }



            /*if(empty($request->times)) {
               
                 $msg = "Times Required Limited Or Not Limited";
                 return response()->json([
            
                        'status'  => true,
                        'msg'   =>   $msg
                        
                    ],200); 
            }*/
        }


        //--- Logic Section
        $data = new Coupon();
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $data->upload($name, $file, $data->photo);
            $input['photo'] = $name;
        }
        $input['rand'] = rand(123, 999999);
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');


        $data->fill($input)->save();
        //--- Logic Section Ends
        if ($request->product) {

            $interest_array = $request->product;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $related = new Procoupon();
                $related->product_id = $interest_array[$i];
                $related->code_id = $data->id;

                $related->save();
            }
        }

        if ($request->category_id) {

            $interest_array = $request->category_id;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $related = new Catcoupon();
                $related->cat_id = $interest_array[$i];
                $related->code_id = $data->id;

                $related->save();
            }
        }


        if ($request->subcategory_id) {

            $interest_array = $request->subcategory_id;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $related = new Subcatcoupon();
                $related->subcat_id = $interest_array[$i];
                $related->code_id = $data->id;

                $related->save();
            }
        }


        if ($request->childcategory_id) {

            $interest_array = $request->childcategory_id;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $related = new Childcatcoupon();
                $related->childcat_id = $interest_array[$i];
                $related->code_id = $data->id;

                $related->save();
            }
        }

        if ($request->brand_id) {

            $interest_array = $request->brand_id;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $related = new Brandcoupon();
                $related->brand_id = $interest_array[$i];
                $related->code_id = $data->id;

                $related->save();
            }
        }


        //--- Redirect Section        
        $msg = trans('Add Success');


        return response()->json([
            'status' => true,
            'msg'   => $msg

        ], 200);
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {
        $cats = Category::get();
        $pro = Product::where('status', 1)->get();
        $subcats = Subcategory::get();
        $childcats = Childcategory::get();
        $brands = Brand::get();
        $users = User::get();
        $data = Coupon::findOrFail($id);

        $couponCategories = $data->categories()->select('cat_id')->get()->pluck('cat_id')->toArray();
        $couponProducts = $data->products()->select('product_id')->get()->pluck('product_id')->toArray();

        $couponSubcategories = $data->subCategories()->select('subcat_id')->get()->pluck('childcat_id')->toArray();
        $couponChildCategories = $data->childCategories()->select('childcat_id')->get()->pluck('childcat_id')->toArray();
        $couponBrands = $data->brands()->select('brand_id')->get()->pluck('brand_id')->toArray();

        return view('admin.coupon.edit', compact('data', 'users', 'cats', 'subcats', 'childcats', 'brands', 'pro', 'couponCategories', 'couponProducts', 'couponSubcategories', 'couponChildCategories', 'couponBrands'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        //   dd($request->all());

        $rules = [

            'code'                                 =>  'unique:coupons,code,' . $id .  '|required',
            'limited'                              => 'required',
            'start_date'                           => 'required',
            'end_date'                             => 'required',
            'photo'                                => 'mimes:jpeg,jpg,png,svg',

        ];
        $messages = [

            'code.required'                         => trans('Code') . '    ' . trans('required'),
            'code.unique'                           => trans('codeUnique'),
            'user_id.required'                      => trans('Users') . '    ' . trans('required'),
            'type.required'                         => trans('Type') . '    ' . trans('required'),
            'price.required'                        => trans('Price') . '    ' . trans('required'),
            'price.numeric'                         => trans('Price') . '    ' . trans('numeric'),
            'price.min'                             => trans('Price') . '    ' . trans('min'),
            'limited.required'                      => trans('Limited') . '    ' . trans('required'),
            'start_date.required'                   => trans('Start Date') . '    ' . trans('required'),
            'end_date.required'                     => trans('End Date') . '    ' . trans('required'),
            'photo.mimes'                           => trans('ImgMimes'),

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),

            ], 200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Coupon::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $data->upload($name, $file, $data->photo);
            $input['photo'] = $name;
        }
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');


        if ($request->what != 'free_shipping') {

            if (empty($request->price) || $request->price < 0) {

                $msg = "Price is Required And Cant Not Be Less Than Zero";
                return response()->json([

                    'status'  => true,
                    'msg'   =>   $msg

                ], 200);
            }
        }

        $data->update($input);

        //--- Logic Section Ends
        // if ($request->product) {

        //     $interest_array = $request->product;

        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //         $related = new Procoupon();
        //         $related->product_id = $interest_array[$i];
        //         $related->code_id = $data->id;

        //         $related->save();
        //     }
        // }

        if ($request->product) {
            $data->products()->sync($request->product);
           
        }

        // if ($request->category_id) {

        //     $interest_array = $request->category_id;

        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //         $related = new Catcoupon();
        //         $related->cat_id = $interest_array[$i];
        //         $related->code_id = $data->id;

        //         $related->save();
        //     }
        // }

        if ($request->category_id) {

            $data->categories()->sync($request->category_id);
        }

        // if ($request->subcategory_id) {

        //     $interest_array = $request->subcategory_id;

        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //         $related = new Subcatcoupon();
        //         $related->subcat_id = $interest_array[$i];
        //         $related->code_id = $data->id;

        //         $related->save();
        //     }
        // }

         if ($request->subcategory_id) {
            $data->subCategories()->sync($request->subcategory_id);
        }


        // if ($request->childcategory_id) {

        //     $interest_array = $request->childcategory_id;

        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //         $related = new Childcatcoupon();
        //         $related->childcat_id = $interest_array[$i];
        //         $related->code_id = $data->id;

        //         $related->save();
        //     }
        // }

        if ($request->childcategory_id) {

            $data->childCategories()->sync($request->childcategory_id);
        }


        // if ($request->brand_id) {

        //     $interest_array = $request->brand_id;

        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //         $related = new Brandcoupon();
        //         $related->brand_id = $interest_array[$i];
        //         $related->code_id = $data->id;

        //         $related->save();
        //     }
        // }

        if ($request->brand_id) {

            $data->brands()->sync($request->brand_id);
           
        }

        //--- Redirect Section     
        $msg = trans('Update Success');

        return response()->json([

            'status'  => true,
            'msg'   =>   $msg

        ], 200);
        //--- Redirect Section Ends           
    }

    //*** GET Request Status
    public function status($id1, $id2)
    {
        $data = Coupon::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Coupon::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }


    /*=================================================== Buy One Take One Free ===============================================================*/


    //*** JSON Request
    public function datatablesPiece()
    {
        $datas = Piece::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)->editColumn('user_id', function (Piece $data) {
            $name = User::select('name')->where('id', $data->user_id)->first();
            $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
            return $user;
        })->editColumn('times', function (Piece $data) {

            $user = $data->times != null ? $data->times  : 'unlimited';
            return $user;
        })
            ->addColumn('status', function (Piece $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-coupon-status-piece', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-coupon-status-piece', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function (Piece $data) {
                return '<div class="action-list">
                                <a data-href="' . route('admin-coupon-edit-piece', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                                <a href="' . route('admin-coupon-pro-piece', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>Products</a>
                                <a href="javascript:;" data-href="' . route('admin-coupon-delete-piece', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>
                                
                                
                                </div>';
            })
            ->rawColumns(['status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function indexPiece()
    {

        return view('admin.piece.index');
    }

    //*** GET Request
    public function createPiece()
    {
        $users = User::get();
        $pro = Product::where('status', 1)->get();
        return view('admin.piece.create', compact('users', 'pro'));
    }

    //*** POST Request
    public function storePiece(Request $request)
    {
        //--- Validation Section
        $rules = ['code' => 'unique:pieces'];
        $messages = ['code.unique' => trans('codeUnique')];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),

            ], 200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Piece();
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $data->upload($name, $file, $data->photo);
            $input['photo'] = $name;
        }
        $input['rand'] = rand(123, 999999);
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');
        $data->fill($input)->save();
        //--- Logic Section Ends

        $pro = new Propiece();
        $pro->code_id = $data->id;
        $pro->product_id = $request->product;
        $pro->save();

        //--- Redirect Section        
        $msg = trans('Add Success');


        return response()->json([
            'status' => true,
            'msg'   => $msg

        ], 200);
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function editPiece($id)
    {
        $users = User::get();
        $data = Piece::findOrFail($id);
        return view('admin.piece.edit', compact('data', 'users'));
    }

    //*** POST Request
    public function updatePiece(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:pieces,code,' . $id];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Piece::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $data->upload($name, $file, $data->photo);
            $input['photo'] = $name;
        }
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = trans('Update Success');


        return response()->json([

            'status'  => true,
            'msg'   =>   $msg

        ], 200);
        //--- Redirect Section Ends           
    }
    //*** GET Request Status
    public function statusPiece($id1, $id2)
    {
        $data = Piece::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }


    //*** GET Request Delete
    public function destroyPiece($id)
    {
        $data = Piece::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }



    //*** GET Request
    public function indexPiecepro($id)
    {
        $pro = Propiece::where('code_id', $id)->get();

        return view('admin.piece.pro', compact('pro'));
    }

    public function destroyPiecepro($id)
    {
        $data = Propiece::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }

    /*=================================================== Take One Free ===============================================================*/


    //*** JSON Request
    public function datatablesfree()
    {
        $datas = Free::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)->editColumn('user_id', function (Free $data) {
            $name = User::select('name')->where('id', $data->user_id)->first();
            $user = $data->user_id == null ? 'For All' : (!empty($name) ? $name->name : "User Deleted");
            return $user;
        })->editColumn('times', function (Free $data) {

            $user = $data->times != null ? $data->times  : 'unlimited';
            return $user;
        })
            ->addColumn('status', function (Free $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-coupon-status-free', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-coupon-status-free', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function (Free $data) {
                return '<div class="action-list">
                                <a data-href="' . route('admin-coupon-edit-free', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                                <a href="' . route('admin-coupon-pro-free', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>Products</a>
                                <a href="javascript:;" data-href="' . route('admin-coupon-delete-free', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>
                                
                                
                                </div>';
            })
            ->rawColumns(['status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function indexfree()
    {

        return view('admin.free.index');
    }

    //*** GET Request
    public function createfree()
    {
        $users = User::get();
        $pro = Product::where('status', 1)->get();
        return view('admin.free.create', compact('users', 'pro'));
    }

    //*** POST Request
    public function storefree(Request $request)
    {
        //--- Validation Section
        $rules = ['code' => 'unique:free'];
        $messages = ['code.unique' => trans('codeUnique')];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),

            ], 200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Free();
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $data->upload($name, $file, $data->photo);
            $input['photo'] = $name;
        }
        $input['rand'] = rand(123, 999999);
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');
        $data->fill($input)->save();
        //--- Logic Section Ends
        if ($request->product) {

            $interest_array = $request->product;
            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {
                $interest_ext = $interest_array[$i];
                $product = new Profree();
                $product->product_id = $interest_ext;
                $product->code_id = $data->id;
                $product->save();
            }
        }
        //--- Redirect Section        
        $msg = trans('Add Success');


        return response()->json([
            'status' => true,
            'msg'   => $msg

        ], 200);
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function editfree($id)
    {
        $users = User::get();
        $data = Free::findOrFail($id);
        return view('admin.free.edit', compact('data', 'users'));
    }

    //*** POST Request
    public function updatefree(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:pieces,code,' . $id];
        $messages = ['code.unique' => trans('codeUnique')];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),

            ], 200);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Free::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $data->upload($name, $file, $data->photo);
            $input['photo'] = $name;
        }
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d');
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = trans('Update Success');


        return response()->json([

            'status'  => true,
            'msg'   =>   $msg

        ], 200);
        //--- Redirect Section Ends           
    }
    //*** GET Request Status
    public function statusfree($id1, $id2)
    {
        $data = Free::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }


    //*** GET Request Delete
    public function destroyfree($id)
    {
        $data = Free::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }



    //*** GET Request
    public function indexfreepro($id)
    {
        $pro = Profree::where('code_id', $id)->get();

        return view('admin.free.pro', compact('pro'));
    }

    public function destroyfreepro($id)
    {
        $data = Profree::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }




    /*=================================================== Features ===============================================================*/


    //*** JSON Request
    public function datatablesfeatures()
    {
        $datas = Feature::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('status', function (Feature $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                if ($data->active == 1) {
                    return '<div class="action-list">
                                <select class="process select droplinks ' . $class . '">
                                 <option data-val="1" value="' . route('admin-features-status', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option>
                                 <option data-val="0" value="' . route('admin-features-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>
                                </select></div>';
                } else {
                    return '<div class="action-list">
                                <select class="process select droplinks  ' . $class . '">
                               
                                 <option data-val="0" value="' . route('admin-features-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>
                                </select></div>';
                }
            })

            ->rawColumns(['status'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function features()
    {

        return view('admin.coupon.features');
    }


    //*** GET Request Status
    public function statusfeatures($id1, $id2)
    {
        $data = Feature::findOrFail($id1);
        if ($data->active == 1) {
            $data->status = $id2;
            $data->update();
        }
    }



    /*=================================================== Wallet ===============================================================*/


    //*** JSON Request
    public function datatableswallet()
    {
        $datas = User::orderBy('id', 'desc')->where('refunds', '>', 0)->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('action', function (User $data) {
                return '<div class="action-list"><a data-href="' . route('admin-user-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a></div>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function wallet()
    {

        return view('admin.wallet.index');
    }


    //*** GET Request
    public function createwallet()
    {
        $users = User::get();

        return view('admin.wallet.create', compact('users'));
    }

    //*** POST Request
    public function storewallet(Request $request)
    {
        //--- Validation Section
        $rules = ['refunds' => 'required'];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $user = $request->user_id;
        //--- Logic Section
        $data = User::find($user);
        $data->refunds += $request->refunds;

        $data->update();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'Refunds Added Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends   
    }
}
