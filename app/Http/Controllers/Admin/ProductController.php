<?php

namespace App\Http\Controllers\Admin;

use App\Models\Childcategory;
use App\Models\Subcategory;
use DataTables;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Related;
use App\Models\Category;
use App\Userdetails;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\ProductCurrency;
use App\Models\Color;
use App\Models\ProductNotify;
use App\Models\Zone;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Image;
use DB;
use App;
use Excel;
use App\Exports\ExportAllProducts;
use App\Models\User;
use App\Models\AffilateUsers;
use App\Models\AffiliateSetting;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = Product::where('product_type', '=', 'normal')->orderBy('id', 'desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('name', function (Product $data) {
                $name = mb_strlen(strip_tags($data->name), 'utf-8') > 50 ? mb_substr(strip_tags($data->name), 0, 50, 'utf-8') . '...' : strip_tags($data->name);
                $id = '<small>ID: <a href="' . route('front.product', ['slug' => $data->slug, 'lang' => 'en']) . '" target="_blank">' . sprintf("%'.08d", $data->id) . '</a></small>';
                $id2 = $data->user_id != 0 && !empty($data->user->products) ? (count($data->user->products) > 0 ? '<small class="ml-2"> VENDOR: <a href="' . route('admin-vendor-show', $data->user_id) . '" target="_blank">' . $data->user->shop_name . '</a></small>' : '') : '';

                $id3 = $data->type == 'Physical' ? '<small class="ml-2"> SKU: <a href="' . route('front.product', ['slug' => $data->slug, 'lang' => 'en']) . '" target="_blank">' . $data->sku . '</a>' : '';

                return  $name . '<br>' . $id . $id3 . $id2;
            })
            ->editColumn('price', function (Product $data) {
                $sign = Currency::where('is_default', '=', 1)->first();
                $price = round($data->price * $sign->value, 2);
                $price = $sign->sign . $price;
                return  $price;
            })->editColumn('thumbnail', function (Product $data) {

                $photo = $data->photo ?: 'https://erp2.vowalaaerp.com/img/default.png';
                if (filter_var($photo, FILTER_VALIDATE_URL)) {
                    $link =   $photo;
                } else {
                    $link =   url('assets/images/products', $photo);
                }

                $photo = '<div class=""><img style="width: 85px;" src="' . $link . '"  ></div>';
                return  $photo;
            })
            ->editColumn('stock', function (Product $data) {
                $stck = (string)$data->stock;
                if ($stck == "0")
                    return "Out Of Stock";
                elseif ($stck == null)
                    return "Unlimited";
                else
                    return $data->stock;
            })
            ->addColumn('status', function (Product $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })->addColumn('checkbox', function (Product $data) {

                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id[' . $data->id . '][]" value="' . $data->id . '" class="all row-select">
                                 <span class="checkmark" style="top: -27px;"></span>
                               </label>
                                </div>';
            })
            ->addColumn('action', function (Product $data) {

                if (!empty($data->affiliate_setting_id) || $data->affiliate_setting_id != "NUll") {



                    $catalog = $data->type == 'Physical' ? ($data->is_catalog == 1 ? '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 0]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a>' : '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 1]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal"> <i class="fas fa-plus"></i> Add To Catalog</a>') : '';
                    return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list">
                                      <a href="' . route('admin-prod-edit', $data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-bs-toggle="modal" data-bs-target="#setgallery"><input type="hidden" value="' . $data->id . '"><i class="fas fa-eye"></i> View Gallery</a>' . $catalog . '<a data-href="' . route('admin-prod-feature', $data->id) . '" class="feature" data-bs-toggle="modal" data-bs-target="#modal2"> <i class="fas fa-star"></i> Highlight</a>
                                      <a data-href="' . route('admin-photo-edit', $data->id) . '" class="feature" data-bs-toggle="modal" data-bs-target="#modal2"> <i class="fas fa-star"></i> update photo</a><a href="javascript:;" data-href="' . route('admin-prod-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i>    Delete</a>
                                        <a href="' . route('admin-prod-aff-users', $data->id) . '"> <i class="fas fa-edit"></i> Add Aff Users </a>
                                      
                                         <a href="' . route('admin-prod-all-aff-users', $data->id) . '"> <i class="fas fa-edit"></i> Show Aff Users </a>
                                         
                                         </div></div>';
                } else {



                    $catalog = $data->type == 'Physical' ? ($data->is_catalog == 1 ? '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 0]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a>' : '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 1]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal"> <i class="fas fa-plus"></i> Add To Catalog</a>') : '';
                    return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-prod-edit', $data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-bs-toggle="modal" data-bs-target="#setgallery"><input type="hidden" value="' . $data->id . '"><i class="fas fa-eye"></i> View Gallery</a>' . $catalog . '<a data-href="' . route('admin-prod-feature', $data->id) . '" class="feature" data-bs-toggle="modal" data-bs-target="#modal2"> <i class="fas fa-star"></i> Highlight</a><a href="javascript:;" data-href="' . route('admin-prod-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                }
            })
            ->rawColumns(['name', 'thumbnail', 'checkbox', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function mobiledatatables()
    {
        $datas = Product::where('product_type', '=', 'normal')->orderBy('id', 'desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('name', function (Product $data) {
                $name = mb_strlen(strip_tags($data->name), 'utf-8') > 50 ? mb_substr(strip_tags($data->name), 0, 50, 'utf-8') . '...' : strip_tags($data->name);
                $id = '<small>ID: <a href="' . route('front.product', $data->slug) . '" target="_blank">' . sprintf("%'.08d", $data->id) . '</a></small>';
                $id2 = $data->user_id != 0 ? (count($data->user->products) > 0 ? '<small class="ml-2"> VENDOR: <a href="' . route('admin-vendor-show', $data->user_id) . '" target="_blank">' . $data->user->shop_name . '</a></small>' : '') : '';

                $id3 = $data->type == 'Physical' ? '<small class="ml-2"> SKU: <a href="' . route('front.product', $data->slug) . '" target="_blank">' . $data->sku . '</a>' : '';

                return  $name . '<br>' . $id . $id3 . $id2;
            })
            ->editColumn('price', function (Product $data) {
                $sign = Currency::where('is_default', '=', 1)->first();
                $price = round($data->price * $sign->value, 2);
                $price = $sign->sign . $price;
                return  $price;
            })
            ->editColumn('stock', function (Product $data) {
                $stck = (string)$data->stock;
                if ($stck == "0")
                    return "Out Of Stock";
                elseif ($stck == null)
                    return "Unlimited";
                else
                    return $data->stock;
            })
            ->addColumn('status', function (Product $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function (Product $data) {
                $catalog = $data->type == 'Physical' ? ($data->is_catalog == 1 ? '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 0]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a>' : '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 1]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal"> <i class="fas fa-plus"></i> Add To Catalog</a>') : '';
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-prod-mobile-edit', $data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-bs-toggle="modal" data-bs-target="#setgallery"><input type="hidden" value="' . $data->id . '"><i class="fas fa-eye"></i> View Gallery</a>' . $catalog . '<a data-href="' . route('admin-prod-feature', $data->id) . '" class="feature" data-bs-toggle="modal" data-bs-target="#modal2"> <i class="fas fa-star"></i> Highlight</a><a href="javascript:;" data-href="' . route('admin-prod-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** JSON Request
    public function deactivedatatables()
    {
        $datas = Product::where('status', '=', 0)->orderBy('id', 'desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('name', function (Product $data) {
                $name = mb_strlen(strip_tags($data->name), 'utf-8') > 50 ? mb_substr(strip_tags($data->name), 0, 50, 'utf-8') . '...' : strip_tags($data->name);
                $id = '<small>ID: <a href="' . route('front.product', $data->slug) . '" target="_blank">' . sprintf("%'.08d", $data->id) . '</a></small>';
                $id2 = $data->user_id != 0 ? (count($data->user->products) > 0 ? '<small class="ml-2"> VENDOR: <a href="' . route('admin-vendor-show', $data->user_id) . '" target="_blank">' . $data->user->shop_name . '</a></small>' : '') : '';

                $id3 = $data->type == 'Physical' ? '<small class="ml-2"> SKU: <a href="' . route('front.product', $data->slug) . '" target="_blank">' . $data->sku . '</a>' : '';

                return  $name . '<br>' . $id . $id3 . $id2;
            })
            ->editColumn('price', function (Product $data) {
                $sign = Currency::where('is_default', '=', 1)->first();
                $price = round($data->price * $sign->value, 2);
                $price = $sign->sign . $price;
                return  $price;
            })
            ->editColumn('stock', function (Product $data) {
                $stck = (string)$data->stock;
                if ($stck == "0")
                    return "Out Of Stock";
                elseif ($stck == null)
                    return "Unlimited";
                else
                    return $data->stock;
            })
            ->addColumn('status', function (Product $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function (Product $data) {
                $catalog = $data->type == 'Physical' ? ($data->is_catalog == 1 ? '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 0]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a>' : '<a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 1]) . '" data-bs-toggle="modal" data-bs-target="#catalog-modal"> <i class="fas fa-plus"></i> Add To Catalog</a>') : '';
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-prod-edit', $data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-bs-toggle="modal" data-bs-target="#setgallery"><input type="hidden" value="' . $data->id . '"><i class="fas fa-eye"></i> View Gallery</a>' . $catalog . '<a data-href="' . route('admin-prod-feature', $data->id) . '" class="feature" data-bs-toggle="modal" data-bs-target="#modal2"> <i class="fas fa-star"></i> Highlight</a><a href="javascript:;" data-href="' . route('admin-prod-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** JSON Request
    public function catalogdatatables()
    {
        $datas = Product::where('is_catalog', '=', 1)->orderBy('id', 'desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('name', function (Product $data) {
                $name = mb_strlen(strip_tags($data->name), 'utf-8') > 50 ? mb_substr(strip_tags($data->name), 0, 50, 'utf-8') . '...' : strip_tags($data->name);
                $id = '<small>ID: <a href="' . route('front.product', $data->slug) . '" target="_blank">' . sprintf("%'.08d", $data->id) . '</a></small>';

                $id3 = $data->type == 'Physical' ? '<small class="ml-2"> SKU: <a href="' . route('front.product', $data->slug) . '" target="_blank">' . $data->sku . '</a>' : '';

                return  $name . '<br>' . $id . $id3;
            })
            ->editColumn('price', function (Product $data) {
                $sign = Currency::where('is_default', '=', 1)->first();
                $price = round($data->price * $sign->value, 2);
                $price = $sign->sign . $price;
                return  $price;
            })
            ->editColumn('stock', function (Product $data) {
                $stck = (string)$data->stock;
                if ($stck == "0")
                    return "Out Of Stock";
                elseif ($stck == null)
                    return "Unlimited";
                else
                    return $data->stock;
            })
            ->addColumn('status', function (Product $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks ' . $class . '"><option data-val="1" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 1]) . '" ' . $s . '>Activated</option><<option data-val="0" value="' . route('admin-prod-status', ['id1' => $data->id, 'id2' => 0]) . '" ' . $ns . '>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function (Product $data) {
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-prod-edit', $data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-bs-toggle="modal" data-bs-target="#setgallery"><input type="hidden" value="' . $data->id . '"><i class="fas fa-eye"></i> View Gallery</a><a data-href="' . route('admin-prod-feature', $data->id) . '" class="feature" data-bs-toggle="modal" data-bs-target="#modal2"> <i class="fas fa-star"></i> Highlight</a><a href="javascript:;" data-href="' . route('admin-prod-catalog', ['id1' => $data->id, 'id2' => 0]) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a></div></div>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.product.index');
    }
    public function mobileindex()
    {
        return view('admin.mobilesetting.product.index');
    }

    //*** GET Request
    public function deactive()
    {
        return view('admin.product.deactive');
    }

    //*** GET Request
    public function catalogs()
    {
        return view('admin.product.catalog');
    }

    //*** GET Request
    public function types()
    {
        return view('admin.product.types');
    }

    //*** GET Request
    public function createPhysical()
    {
        $pro = Product::where('status', '=', 1)->orderBy('id', 'desc')->get();
        $brands = Brand::where('status', 1)->get();
        $cats = Category::all();
        $sign = Currency::where('is_default', '=', 1)->first();
        $affilates = AffiliateSetting::all();
        return view('admin.product.create.physical', compact('cats', 'sign', 'pro', 'brands', 'affilates'));
    }
    /*   public function mobilecreate()
    {
        $pro = Product::where('status','=',1)->orderBy('id','desc')->get();
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.mobilesetting.product.create',compact('cats','sign','pro'));
    }*/

    //*** GET Request
    public function createDigital()
    {
        $pro = Product::where('status', '=', 1)->orderBy('id', 'desc')->get();
        $cats = Category::all();
        $sign = Currency::where('is_default', '=', 1)->first();
        return view('admin.product.create.digital', compact('cats', 'sign', 'pro'));
    }

    //*** GET Request
    public function createLicense()
    {
        $pro = Product::where('status', '=', 1)->orderBy('id', 'desc')->get();
        $cats = Category::all();
        $sign = Currency::where('is_default', '=', 1)->first();
        return view('admin.product.create.license', compact('cats', 'sign', 'pro'));
    }

    //*** GET Request
    public function status($id1, $id2)
    {
        $data = Product::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request
    public function catalog($id1, $id2)
    {
        $data = Product::findOrFail($id1);
        $data->is_catalog = $id2;
        $data->update();
        if ($id2 == 1) {
            $msg = trans('Catalog Add Msg');
        } else {
            $msg =  trans('Catalog Remove Msg');
        }

        return response()->json([
            'status' =>  true,
            'msg' => $msg
        ], 200);
    }

    //*** POST Request
    public function uploadUpdate(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Product::findOrFail($id);

        //--- Validation Section Ends
       $image = $request->image;
    //    $image = $request->file('image');
       // $image_ext = $image->getClientOriginalExtension();
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
      //    $extension = explode('/', mime_content_type($image))[1];
       
        $image = base64_decode($image); 
        
        $extension = explode('/', finfo_buffer(finfo_open(), $image, FILEINFO_MIME_TYPE))[1];
        
        $image_name = time() . str_random(8) .'.'. $extension;
        $path = 'assets/images/products/' . $image_name;
        file_put_contents($path, $image);
        if ($data->photo != null) {
            if (file_exists(public_path() . '/assets/images/products/' . $data->photo)) {
                unlink(public_path() . '/assets/images/products/' . $data->photo);
            }
        }
        $input['photo'] = $image_name;
        $input['mobile_photo'] = $image_name;
        $data->update($input);
        if ($data->thumbnail != null) {
            if (file_exists(public_path() . '/assets/images/thumbnails/' . $data->thumbnail)) {
                unlink(public_path() . '/assets/images/thumbnails/' . $data->thumbnail);
            }
        }

        $img = Image::make(public_path() . '/assets/images/products/' . $data->photo)->resize(285, 285);
        $thumbnail = time() . str_random(8) . '.jpg';
        $img->save(public_path() . '/assets/images/thumbnails/' . $thumbnail);
        $data->thumbnail  = $thumbnail;
        $data->update();
        return response()->json(['status' => true, 'file_name' => $extension]);
    }
    
    public function uploadUpdatemobile(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Product::findOrFail($id);

        //--- Validation Section Ends
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time() . str_random(8) . '.png';
        $path = 'assets/images/products/' . $image_name;
        file_put_contents($path, $image);
        if ($data->mobile_photo != null) {
            if (file_exists(public_path() . '/assets/images/products/' . $data->mobile_photo)) {
                unlink(public_path() . '/assets/images/products/' . $data->mobile_photo);
            }
        }
        $input['mobile_photo'] = $image_name;
        $data->update($input);

        return response()->json(['status' => true, 'file_name' => $image_name]);
    }

    //*** POST Request
    //*** POST Request
    /*  public function store(Request $request)
    {
        
        
          $prods = Product::orderBy('id','desc')->get()->count();
             $code = env('Code');
	       $details =  Userdetails::Userdetail($code);  
            $package = end($details['subscribes'])  ;  
          
       if(!empty($package)){
        if($prods < $package['allowed_products'] || $package['allowed_products'] == 0) {
        
        
        
        //--- Validation Section
        $rules = [
            
            'name'                     => 'required',
            'name_ar'                  =>'required',
            'alt'                      =>'required',
            'alt_ar'                   =>'required',
            'category_id'              =>'required',
            'photo'                    => 'required',
            'file'                     => 'mimes:zip',
            'price'                    =>  'required|numeric|min:0',
            'previous_price'           =>  'numeric|min:0',
          
        ];

        
        
       $messages =[
          
          'name.required'                       => trans('ProdName Required'),
          'name_ar.required'                    => trans('ProdArabicName Required'),
          'alt.required'                        => trans('ProdAlt Required'),
          'alt_ar.required'                     => trans('ProdArabicAlt Required'),
          'price.required'                      => trans('ProdPrice Required'),
          'price.min'                           => trans('PriceMin'),
          'price.numeric'                       => trans('ProdPrice Numeric'),
          'previous_price.numeric'              => trans('ProdPrice Numeric'),
          'previous_price.min'                 => trans('PriceMin'),
          'photo.required'                      => trans('Photo Required'),
          'mimes'                               => trans('ImgMimes'),
          'file.mimes'                          => trans('FILE'),
          'category_id.required'                =>trans('ProdCat Required'),
        
        ];
  
    
    
    
  
        
         $validator  = Validator::make($request->all(),$rules,$messages);
        
        
          if ($validator->fails()) {
            return response()->json([
                "status" =>  false,
                "errors" =>  $validator->messages(),
                ],200);
        }
        
        // //--- Validation Section Ends

        //--- Logic Section
        $data = new Product;
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();
        $input['feature'] = $request->feature ? $request->feature : 0 ;
        if(empty($request->feature)){
            $input['subscription_period'] = 0 ;
            $input['trial_period'] = 0 ;
            
        }
        // Check File
        if ($file = $request->file('file')) {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/files',$name);
            $input['file'] = $name;
        }
       
        
        if ($request->hasFile('hover_photo')) {
          
            $imagem2 = $request->file('hover_photo');
            $image_ext2 = $imagem2->getClientOriginalExtension();
            $new_image_name2 = rand(123456, 999999) . "." . $image_ext2;
            $destination_path2 = public_path('assets/images/products/');
            $imagem2->move($destination_path2, $new_image_name2);
           $input['hover_photo'] = $new_image_name2;
        }
        
        
        $image = $request->photo;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time().str_random(8).'.png';
        $path = 'assets/images/products/'.$image_name;
        file_put_contents($path, $image);
        $input['photo'] = $image_name;
        
        
      
         if ($request->hasFile('mobile_photo')) {
          
            $imagem = $request->file('mobile_photo');
            $image_ext = $imagem->getClientOriginalExtension();
            $new_image_name = rand(123456, 999999) . "." . $image_ext;
            $destination_path = public_path('assets/images/products/');
            $imagem->move($destination_path, $new_image_name);
           $input['mobile_photo'] = $new_image_name;
        }else{
            
            $input['mobile_photo'] = $image_name;
        }
        
     

        // Check Physical
        if($request->type == "Physical")
        {

            //--- Validation Section
            $rules = [
                     'sku'                                               =>  'min:8|unique:products',
                     'stock'                                             =>  'numeric|min:0',
                     'size_qty.*'                                        =>  'numeric|min:1',
                     'size_price.*'                                      =>  'numeric|min:0',
                     'color_qty.*'                                       =>  'numeric|min:0',
                     'color_price.*'                                     =>  'numeric|min:0',  
                     'mobile_price'                                    =>  'numeric|min:0', 
                     'scale'                                           =>  'numeric|min:0', 
               
                     
                     
                ];
         
            $messages =[
          
              'sku.min'                                                  => trans('ProdSku Min'),
              'sku.unique'                                               => trans('ProdSku Unique'),
              'stock.numeric'                                            => trans('ProdStock'),
              'stock.min'                                                => trans('StockMin'),
              'size_qty.*.numeric'                                       => trans('SizeQty'),
              'size_qty.*.min'                                           => trans('SizeMin'),
              'size_price.*.numeric'                                     => trans('SizePrice'),
              'size_price.*.min'                                         => trans('SizePriceMin'),
              'color_qty.*.numeric'                                      => trans('ColorQty'),
              'color_qty.*.min'                                          => trans('ColorMin'),
              'color_price.*.numeric'                                    => trans('ColorPrice'),
              'color_price.*.min'                                        => trans('ColorPriceMin'),
              'mobile_price.numeric'                                     => trans('MobilePrice'),
              'mobile_price.min'                                         => trans('MobilePriceMin'),
              'scale.*.numeric'                                          => trans('Scale'),
              'scale.*.min'                                              => trans('ScaleMin'),
             
               
            
            ];
  
         if(!empty($request->whole_check ))
            {
                $rules = [
                     
                     'whole_sell_qty.*'                                  =>  'numeric|min:0', 
                     'whole_sell_discount.*'                                  =>  'numeric|min:0', 
                     
                     
                ];
                
                
                $messages =[
          
             
              'whole_sell_qty.*.numeric'                                 => trans('WholeSell'), 
              'whole_sell_qty.*.min'                                     => trans('WholeSell Min'), 
              'whole_sell_discount.*.numeric'                            => trans('WholeSellDiscount'), 
              'whole_sell_discount.*.min'                                => trans('WholeSellDiscount Min'), 
               
            
            ];
            }
  
    
    
    
  
        
         $validator  = Validator::make($request->all(),$rules,$messages);
        
        
          if ($validator->fails()) {
            return response()->json([
                "status" =>  false,
                "errors" =>  $validator->messages(),
                ],200);
        }
            //--- Validation Section Ends


            // Check Condition
            if ($request->product_condition_check == ""){
                $input['product_condition'] = 0;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == ""){
                $input['ship'] = null;
            }

            // Check Size
            if(empty($request->size_check ))
            {
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
            }
            else{
                if(in_array(null, $request->size) || in_array(null, $request->size_qty))
                {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                }
                else
                {
                    $input['size'] = implode(',', str_replace(' ', '-', $request->size));
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $input['size_price'] = implode(',', $request->size_price);
                }
            }
    

            // Check Whole Sale
            if(empty($request->whole_check ))
            {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            }
            else{
                if(in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount))
                {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
                }
                else
                {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if(empty($request->color_check))
            {
                $input['color'] = null;
            }
            else{
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "")
            {
                $input['measure'] = null;
            }

        }

        // Check Seo
        if (empty($request->seo_check))
        {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
            $input['meta_description_ar'] = null;
        }
        else {
            if (!empty($request->meta_tag))
            {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License

        if($request->type == "License")
        {

            if(in_array(null, $request->license) || in_array(null, $request->license_qty))
            {
                $input['license'] = null;
                $input['license_qty'] = null;
            }
            else
            {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }

        }

        // Check Features
        if(in_array(null, $request->features) || in_array(null, $request->colors))
        {
            $input['features'] = null;
            $input['colors'] = null;
        }
        else
        {
            $input['features'] = implode(',', str_replace(',',' ',$request->features));
            $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
        }

        //tags
        if (!empty($request->tags))
        {
            $input['tags'] = implode(',', $request->tags);
        }

       if (!empty($request->tags_ar))
        {
            $input['tags_ar'] = implode(',', $request->tags_ar);
        } 

        // Conert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        if(!empty($input['mobile_price'])) {
         $input['mobile_price'] = $input['mobile_price'] > 0 ? $input['mobile_price'] : $input['price'] ;
        }else {
             $input['mobile_price']  = $input['price'];
        }
        
        $input['previous_price'] = ($input['previous_price'] / $sign->value);



        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
          $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
          if (!empty($catAttrs)) {
            foreach ($catAttrs as $key => $catAttr) {
              $in_name = $catAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($catAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }

        if (!empty($request->subcategory_id)) {
          $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
          if (!empty($subAttrs)) {
            foreach ($subAttrs as $key => $subAttr) {
              $in_name = $subAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($subAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }
        if (!empty($request->childcategory_id)) {
          $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
          if (!empty($childAttrs)) {
            foreach ($childAttrs as $key => $childAttr) {
              $in_name = $childAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($childAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }



        if (empty($attrArr)) {
          $input['attributes'] = NULL;
        } else {
          $jsonAttr = json_encode($attrArr);
          $input['attributes'] = $jsonAttr;
        }



        // Save Data
        $data->fill($input)->save();

 // Check Color By Sizes

                        if(!empty($request->size_color_check ))
                        {

                              if($request->size_color) {

                                    $interest_array = $request->size_color;
                                    $interest_color = $request->color_size;
                                    $interest_qty = $request->color_qty;
                                    $interest_price = $request->color_price;
                                    $array_len = count($interest_array);
                                    for ($i = 0; $i < $array_len; $i++) {
                                        $interest_ext = $interest_array[$i];
                                        $related = new Color();
                                        $related->size = str_replace(' ', '-', $interest_array[$i]);
                                        $related->colors = $interest_color[$i];
                                        $related->size_qty = $interest_qty[$i];
                                        $related->size_price = $interest_price[$i];
                                        $related->product_id = $data->id;
                                        
                                        $related->save();
                                    
                                    }
                        
                                }
                           
                               
                               
                               
                        }


        // Related
        if($request->related) {

            $interest_array = $request->related;
            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {
                $interest_ext = $interest_array[$i];
                $related = new Related();
                $related->related_id = $interest_ext;
                $related->product_id = $data->id;
                $related->save();
            }

        }

        // Set SLug
        $prod = Product::find($data->id);
        if($prod->type != 'Physical'){
            $prod->slug = str_slug($data->name,'-').'-'.strtolower(str_random(3).$data->id.str_random(3));
          //  $prod->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower(str_random(3).$data->id.str_random(3));
            $prod->slug_ar = preg_replace('/\s+/', '-', $data->name_ar).'-'.strtolower(str_random(3).$data->id.str_random(3));
        }
        else {
            $prod->slug = str_slug($data->name,'-').'-'.strtolower($data->sku);
          //  $prod->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower($data->sku);
            $prod->slug_ar = preg_replace('/\s+/', '-', $data->name_ar).'-'.strtolower($data->sku);
        }

        // Set Thumbnail
        $img = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(285, 285);
        $thumbnail = time().str_random(8).'.jpg';
        $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
        $prod->thumbnail  = $thumbnail;
        $prod->update();
        
        
        
       
        
        
        

        // Add To Gallery If any
        $lastid = $data->id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                if(in_array($key, $request->galval))
                {
                    $gallery = new Gallery;
                    $name = time().$file->getClientOriginalName();
                    $file->move('assets/images/galleries',$name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery->save();
                }
            }
        } 
        
        if ($files = $request->file('gallerymobile')){
            foreach ($files as  $key => $file){
                if(in_array($key, $request->galvalm))
                {
                    $gallery = new Gallery;
                    $name = time().$file->getClientOriginalName();
                    $file->move('assets/images/galleries',$name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery['web'] = 0;
                    $gallery->save();
                }
            }
        }
        //logic Section Ends

        //--- Redirect Section
        
    
        

      
     $msg = trans('Add Success');
      
   
    
     return response()->json([
                "status" =>  true,
                "msg" => $msg
                ],200);
        //--- Redirect Section Ends
        
     } 
     else
        {
            $msg = trans('You Can\'t Add More Products.');
            //--- Redirect Section
            return response()->json(array('errors' => [ 0 => $msg]));

            //--- Redirect Section Ends
        }   
    } else
        {
              $msg = trans('select package please');
            //--- Redirect Section
            return response()->json(array('errors' => [ 0 => $msg]));

            //--- Redirect Section Ends
        }   
        
        
        
    }*/

    public function store(Request $request)
    {


        /*    $prods = Product::orderBy('id', 'desc')->get()->count();
        $code = env('Code');
        $details =  Userdetails::Userdetail($code);
        $package = end($details['subscribes']);*/






        //--- Validation Section
        $rules = [

            'name'                     => 'required',
            'name_ar'                  => 'required',
            'alt'                      => 'required',
            'alt_ar'                   => 'required',
            'category_id'              => 'required',
            'photo'                    => 'required|image',
            'file'                     => 'mimes:zip',
            'price'                    =>  'required|numeric|min:0',
            'previous_price'           =>  'numeric|min:0',

        ];



        $messages = [

            'name.required'                       => trans('ProdName Required'),
            'name_ar.required'                    => trans('ProdArabicName Required'),
            'alt.required'                        => trans('ProdAlt Required'),
            'alt_ar.required'                     => trans('ProdArabicAlt Required'),
            'price.required'                      => trans('ProdPrice Required'),
            'price.min'                           => trans('PriceMin'),
            'price.numeric'                       => trans('ProdPrice Numeric'),
            'previous_price.numeric'              => trans('ProdPrice Numeric'),
            'previous_price.min'                 => trans('PriceMin'),
            'photo.required'                      => trans('Photo Required'),
            'mimes'                               => trans('ImgMimes'),
            'file.mimes'                          => trans('FILE'),
            'category_id.required'                => trans('ProdCat Required'),

        ];






        $validator  = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return response()->json([
                "status" =>  false,
                "errors" =>  $validator->messages(),
            ], 200);
        }

        // //--- Validation Section Ends

        //--- Logic Section
        $data = new Product;
        $sign = Currency::where('is_default', '=', 1)->first();
        $input = $request->all();
        $input['feature'] = $request->feature ? $request->feature : 0;
        if (empty($request->feature)) {
            $input['subscription_period'] = 0;
            $input['trial_period'] = 0;
        }
        // Check File
        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('assets/files', $name);
            $input['file'] = $name;
        }


        if ($request->hasFile('hover_photo')) {

            $imagem2 = $request->file('hover_photo');
            $image_ext2 = $imagem2->getClientOriginalExtension();
            $new_image_name2 = rand(123456, 999999) . "." . $image_ext2;
            $destination_path2 = public_path('assets/images/products/');
            $imagem2->move($destination_path2, $new_image_name2);
            $input['hover_photo'] = $new_image_name2;
        }

  if ($request->hasFile('photo')) {

            $imagem3 = $request->file('photo');
            $image_ext3 = $imagem3->getClientOriginalExtension();
            $new_image_name3 = rand(123456, 999999) . "." . $image_ext3;
            $destination_path3 = public_path('assets/images/products/');
            $imagem3->move($destination_path3, $new_image_name3);
            $input['photo'] = $new_image_name3;
        }



        if ($request->hasFile('mobile_photo')) {

            $imagem = $request->file('mobile_photo');
            $image_ext = $imagem->getClientOriginalExtension();
            $new_image_name = rand(123456, 999999) . "." . $image_ext;
            $destination_path = public_path('assets/images/products/');
            $imagem->move($destination_path, $new_image_name);
            $input['mobile_photo'] = $new_image_name;
        } else {

            // $input['mobile_photo'] = $image_name;
            $input['mobile_photo'] = null;
        }



        // Check Physical
        if ($request->type == "Physical") {

            //--- Validation Section
            $rules = [
                'sku'                                               =>  'min:8|unique:products',

                'size_qty.*'                                        =>  'numeric|min:1',
                'size_price.*'                                      =>  'numeric|min:0',
                'color_qty.*'                                       =>  'numeric|min:0',
                'color_price.*'                                     =>  'numeric|min:0',
                'mobile_price'                                    =>  'numeric|min:0',
                'scale'                                           =>  'numeric|min:0',
                'featured_price'                              =>  'nullable|numeric|min:0',


            ];

            $messages = [

                'sku.min'                                                  => trans('ProdSku Min'),
                'sku.unique'                                               => trans('ProdSku Unique'),

                'size_qty.*.numeric'                                       => trans('SizeQty'),
                'size_qty.*.min'                                           => trans('SizeMin'),
                'size_price.*.numeric'                                     => trans('SizePrice'),
                'size_price.*.min'                                         => trans('SizePriceMin'),
                'color_qty.*.numeric'                                      => trans('ColorQty'),
                'color_qty.*.min'                                          => trans('ColorMin'),
                'color_price.*.numeric'                                    => trans('ColorPrice'),
                'color_price.*.min'                                        => trans('ColorPriceMin'),
                'mobile_price.numeric'                                     => trans('MobilePrice'),
                'mobile_price.min'                                         => trans('MobilePriceMin'),
                'scale.*.numeric'                                          => trans('Scale'),
                'scale.*.min'                                              => trans('ScaleMin'),



            ];

            if (!empty($request->whole_check)) {
                $rules = [

                    'whole_sell_qty.*'                                  =>  'numeric|min:0',
                    'whole_sell_discount.*'                                  =>  'numeric|min:0',


                ];


                $messages = [


                    'whole_sell_qty.*.numeric'                                 => trans('WholeSell'),
                    'whole_sell_qty.*.min'                                     => trans('WholeSell Min'),
                    'whole_sell_discount.*.numeric'                            => trans('WholeSellDiscount'),
                    'whole_sell_discount.*.min'                                => trans('WholeSellDiscount Min'),


                ];
            }






            $validator  = Validator::make($request->all(), $rules, $messages);


            if ($validator->fails()) {
                return response()->json([
                    "status" =>  false,
                    "errors" =>  $validator->messages(),
                ], 200);
            }
            //--- Validation Section Ends

            // Check featured price
            if (isset($input['featured_price_check'])) {
                $input['featured_price'] = $input['featured_price'] / $sign->value;
            } else {
                $input['featured_price'] = null;
            }

            // Check Condition
            if ($request->product_condition_check == "") {
                $input['product_condition'] = 0;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == "") {
                $input['ship'] = null;
            }

            // Check Size
            if (empty($request->size_check)) {
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
            } else {
                if (in_array(null, $request->size) || in_array(null, $request->size_qty)) {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                } else {
                    $input['size'] = implode(',', str_replace(' ', '-', $request->size));
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $input['size_price'] = implode(',', $request->size_price);
                }
            }


            // Check Whole Sale
            if (empty($request->whole_check)) {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            } else {
                if (in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount)) {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                } else {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color'] = null;
            } else {
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "") {
                $input['measure'] = null;
            }
        }

        // Check Seo
        if (empty($request->seo_check)) {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
            $input['meta_description_ar'] = null;
        } else {
            if (!empty($request->meta_tag)) {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License

        if ($request->type == "License") {

            if (in_array(null, $request->license) || in_array(null, $request->license_qty)) {
                $input['license'] = null;
                $input['license_qty'] = null;
            } else {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }
        }

        // Check Features
        if (in_array(null, $request->features) || in_array(null, $request->colors)) {
            $input['features'] = null;
            $input['colors'] = null;
        } else {
            $input['features'] = implode(',', str_replace(',', ' ', $request->features));
            $input['colors'] = implode(',', str_replace(',', ' ', $request->colors));
        }

        //tags
        if (!empty($request->tags)) {
            $input['tags'] = implode(',', $request->tags);
        }

        if (!empty($request->tags_ar)) {
            $input['tags_ar'] = implode(',', $request->tags_ar);
        }

        // Conert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        if (!empty($input['mobile_price'])) {
            $input['mobile_price'] = $input['mobile_price'] > 0 ? $input['mobile_price'] : $input['price'];
        } else {
            $input['mobile_price']  = $input['price'];
        }

        $input['previous_price'] = ($input['previous_price'] / $sign->value);



        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }
        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }



        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }



        // Save Data
        $data->fill($input)->save();

        // Check Color By Sizes

        if (!empty($request->size_color_check)) {

            if ($request->size_color) {

                $interest_array = $request->size_color;
                $interest_color = $request->color_size;
                $interest_qty = $request->color_qty;
                $interest_price = $request->color_price;
                $array_len = count($interest_array);
                for ($i = 0; $i < $array_len; $i++) {
                    $interest_ext = $interest_array[$i];
                    $related = new Color();
                    $related->size = str_replace(' ', '-', $interest_array[$i]);
                    $related->colors = $interest_color[$i];
                    $related->size_qty = $interest_qty[$i];
                    $related->size_price = $interest_price[$i];
                    $related->product_id = $data->id;

                    $related->save();
                }
            }
        }

   if (!empty($request->country_price_check)) {

            if ($request->country_price) {

                $interest_array = $request->country_price;
                $interest_country = $request->country;
            
                $array_len = count($interest_array);
                for ($i = 0; $i < $array_len; $i++) {
                    $interest_ext = $interest_array[$i];
                    $ProductCurrency = new ProductCurrency();
                    $ProductCurrency->price =  $interest_array[$i];
                    $ProductCurrency->country = $interest_country[$i];
                    $ProductCurrency->product_id = $data->id;

                    $ProductCurrency->save();
                }
            }
        }


        // Related
        if ($request->related) {

            $interest_array = $request->related;
            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {
                $interest_ext = $interest_array[$i];
                $related = new Related();
                $related->related_id = $interest_ext;
                $related->product_id = $data->id;
                $related->save();
            }
        }

        // Set SLug
        $prod = Product::find($data->id);
        if ($prod->type != 'Physical') {
            $prod->slug = str_slug($data->name, '-') . '-' . strtolower(str_random(3) . $data->id . str_random(3));
            //  $prod->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower(str_random(3).$data->id.str_random(3));
            $prod->slug_ar = preg_replace('/\s+/', '-', $data->name_ar) . '-' . strtolower(str_random(3) . $data->id . str_random(3));
        } else {
            $prod->slug = str_slug($data->name, '-') . '-' . strtolower($data->sku);
            //  $prod->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower($data->sku);
            $prod->slug_ar = preg_replace('/\s+/', '-', $data->name_ar) . '-' . strtolower($data->sku);
        }

        // Set Thumbnail
        $img = Image::make(public_path() . '/assets/images/products/' . $prod->photo)->resize(285, 285);
        $thumbnail = time() . str_random(8) . '.jpg';
        $img->save(public_path() . '/assets/images/thumbnails/' . $thumbnail);
        $prod->thumbnail  = $thumbnail;
        $prod->update();








        // Add To Gallery If any
        $lastid = $data->id;
        if ($files = $request->file('gallery')) {
            foreach ($files as  $key => $file) {
                if (in_array($key, $request->galval)) {
                    $gallery = new Gallery;
                    $name = time() . $file->getClientOriginalName();
                    $file->move('assets/images/galleries', $name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery->save();
                }
            }
        }

        if ($files = $request->file('gallerymobile')) {
            foreach ($files as  $key => $file) {
                if (in_array($key, $request->galvalm)) {
                    $gallery = new Gallery;
                    $name = time() . $file->getClientOriginalName();
                    $file->move('assets/images/galleries', $name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery['web'] = 0;
                    $gallery->save();
                }
            }
        }
        //logic Section Ends

        //--- Redirect Section





        $msg = trans('Add Success');



        return response()->json([
            "status" =>  true,
            "msg" => $msg
        ], 200);
        //--- Redirect Section Ends

        /*         if ($prods < $package['allowed_products'] || $package['allowed_products'] == 0) {   } else {
                $msg = trans('You Can\'t Add More Products.');
                //--- Redirect Section
                return response()->json(array('errors' => [0 => $msg]));

                //--- Redirect Section Ends
            }
   if ($package) {     } else {
            $msg = trans('select package please');
            //--- Redirect Section
            return response()->json(array('errors' => [0 => $msg]));

            //--- Redirect Section Ends
        }*/
    }

    //*** POST Request
    public function import()
    {

        $cats = Category::all();
        $sign = Currency::where('is_default', '=', 1)->first();
        return view('admin.product.productcsv', compact('cats', 'sign'));
    }

    public function importSubmit(Request $request)
    {

        $prods = Product::orderBy('id', 'desc')->get()->count();
        /*       $code = env('Code');
        $details =  Userdetails::Userdetail($code);
        $package = end($details['subscribes']);
*/



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
        if ($file = $request->file('csvfile')) {
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move('assets/temp_files', $filename);
        }

        //$filename = $request->file('csvfile')->getClientOriginalName();
        //return response()->json($filename);
        $datas = "";

        $file = fopen(public_path('assets/temp_files/' . $filename), "r");
        $i = 1;
        while (($line = fgetcsv($file)) !== FALSE) {

            if ($i != 1) {

                if (!Product::where('sku', $line[0])->exists()) {

                    //--- Validation Section Ends

                    //--- Logic Section
                    $data = new Product;

                    $sign = Currency::where('is_default', '=', 1)->first();

                    $input['type'] = 'Physical';
                    $input['sku'] = !empty($line[0])  ? $line[0] : $this->randsku();

                    $input['category_id'] = null;
                    $input['subcategory_id'] = null;
                    $input['childcategory_id'] = null;

                    $mcat = Category::where(DB::raw('lower(name)'), strtolower($line[1]));
                    //$mcat = Category::where("name", $line[1]);

                    if ($mcat->exists()) {
                        $input['category_id'] = $mcat->first()->id;

                        if ($line[2] != "") {
                            $scat = Subcategory::where(DB::raw('lower(name)'), strtolower($line[2]));

                            if ($scat->exists()) {
                                $input['subcategory_id'] = $scat->first()->id;
                            }
                        }
                        if ($line[3] != "") {
                            $chcat = Childcategory::where(DB::raw('lower(name)'), strtolower($line[3]));

                            if ($chcat->exists()) {
                                $input['childcategory_id'] = $chcat->first()->id;
                            }
                        }




                        $input['photo'] = !empty($line[5]) ? $line[5] : null;
                        $input['name'] = $line[4];
                        $input['details'] = !empty($line[6]) ? $line[6] : null;
                        //                $input['category_id'] = $request->category_id;
                        //                $input['subcategory_id'] = $request->subcategory_id;
                        //                $input['childcategory_id'] = $request->childcategory_id;
                        $input['color'] = !empty($line[13]) ? $line[13] : null;
                        $input['price'] = $line[7];
                        $input['previous_price'] = !empty($line[8]) ? $line[8] : null;
                        $input['stock'] = !empty($line[9]) ? $line[9] : null;
                        $input['size'] = !empty($line[10]) ? str_replace(' ', '-', $line[10]) : null;
                        $input['size_qty'] = !empty($line[11]) ? $line[11] : null;
                        $input['size_price'] = !empty($line[12]) ? $line[12] : null;
                        $input['youtube'] = !empty($line[15]) ? $line[15] : null;
                        $input['policy'] = !empty($line[16]) ? $line[16] : null;
                        $input['meta_tag'] = $line[17];
                        $input['meta_description'] = $line[18];
                        $input['tags'] = $line[14];
                        $input['product_type'] = !empty($line[20]) ? $line[20] : 'normal';
                        $input['affiliate_link'] = !empty($line[20]) ? $line[20] : null;
                        $input['details_ar'] = $line[21];
                        $input['name_ar'] = $line[22];
                        $input['policy_ar'] = !empty($line[23]) ? $line[23] : null;
                        $input['meta_description_ar'] = !empty($line[24]) ? $line[24] : null;



                        // Conert Price According to Currency
                        $input['price'] = ($input['price'] / $sign->value);
                        $input['mobile_price'] = $input['price'];
                        if (!empty($line[8])) {
                            $input['previous_price'] = ($input['previous_price'] / $sign->value);
                        }
                        // Save Data
                        $data->fill($input)->save();

                        // Set SLug
                        $prod = Product::find($data->id);

                        $prod->slug = str_slug($data->name, '-') . '-' . strtolower($data->sku);
                        //   $prod->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower($data->sku);
                        $prod->slug_ar = preg_replace('/\s+/', '-', $data->name_ar) . '-' . strtolower($data->sku);

                        // Set Thumbnail

                        if (!empty($line[5])) {
                            //  $img = Image::make($line[5])->resize(285, 285);

                            //   $thumbnail = $line[5];
                            //  $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
                            $prod->thumbnail  = $line[5];
                            $prod->mobile_photo  = $line[5];
                        }
                        $prod->update();
                    } else {
                        $log .= "<br>Row No: " . $i . " - No Category Found!<br>";
                    }
                } else {
                    $log .= "<br>Row No: " . $i . " - Duplicate Product Code!<br>";
                }
            }

            $i++;
        }
        fclose($file);


        //--- Redirect Section
        $msg = 'Bulk Product File Imported Successfully.<a href="' . route('admin-prod-index') . '">View Product Lists.</a>' . $log;
        //  return response()->json($msg);

        return response()->json([
            "status" =>  true,
            "msg" => $msg
        ], 200);
        /*   if ($prods < $package['allowed_products'] || $package['allowed_products'] == 0) {  } else {
                $msg = trans('You Can\'t Add More Products.');
                //--- Redirect Section
                return response()->json(array('errors' => [0 => $msg]));

                //--- Redirect Section Ends
            }
    if (!empty($package)) {     } else {
            $msg = trans('select package please');
            //--- Redirect Section
            return response()->json(array('errors' => [0 => $msg]));

            //--- Redirect Section Ends
        }*/
    }



    //*** GET Request
    public function edit($id)
    {
        
        $colors = Color::where('product_id', $id)->get();
        $brands = Brand::where('status', 1)->get();
        $pro = Product::where('status', '=', 1)->orderBy('id', 'desc')->get();
        $Related = Related::where('product_id', '=', $id)->orderBy('id', 'desc')->get();
        $ProductCurrencies = ProductCurrency::where('product_id', '=', $id)->orderBy('id', 'desc')->get();
        $cats = Category::all();
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default', '=', 1)->first();

        $affilates = AffiliateSetting::all();

        if ($data->type == 'Digital')

            return view('admin.product.edit.digital', compact('cats', 'data', 'sign', 'pro', 'Related', 'colors', 'brands', 'affilates', 'ProductCurrencies'));
        elseif ($data->type == 'License')
            return view('admin.product.edit.license', compact('cats', 'data', 'sign', 'pro', 'Related', 'colors', 'brands', 'affilates', 'ProductCurrencies'));
        else

            return view('admin.product.edit.physical', compact('cats', 'data', 'sign', 'pro', 'Related', 'colors', 'brands', 'affilates', 'ProductCurrencies'));
    }
    public function mobileedit($id)
    {
        $colors = Color::where('product_id', $id)->get();
        $pro = Product::where('status', '=', 1)->orderBy('id', 'desc')->get();
        $Related = Related::where('product_id', '=', $id)->orderBy('id', 'desc')->get();
        $cats = Category::all();
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default', '=', 1)->first();



        return view('admin.mobilesetting.product.edit', compact('cats', 'data', 'sign', 'pro', 'Related', 'colors'));
    }

    //*** POST Request
    public function mobileupdate(Request $request, $id)
    {
        // return $request;


        //-- Logic Section
        $data = Product::findOrFail($id);

        $input = $request->all();


        /* $data->update($input);*/
        //-- Logic Section Ends




        //--- Redirect Section
        $msg = 'Product Updated Successfully.<a href="' . route('admin-prod-index') . '">View Product Lists.</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    
    public function update(Request $request, $id)
    {
        //--- Validation Section

        $rules = [

            'name'                     => 'required',
            'name_ar'                  => 'required',
            'alt'                      => 'required',
            'alt_ar'                   => 'required',
            'file'                     => 'mimes:zip',
            'price'                    =>  'required|numeric|min:0',
            'previous_price'           =>  'numeric|min:0',

        ];



        $messages = [

            'name.required'                       => trans('ProdName Required'),
            'name_ar.required'                    => trans('ProdArabicName Required'),
            'alt.required'                        => trans('ProdAlt Required'),
            'alt_ar.required'                     => trans('ProdArabicAlt Required'),
            'price.required'                      => trans('ProdPrice Required'),
            'price.min'                           => trans('PriceMin'),
            'price.numeric'                       => trans('ProdPrice Numeric'),
            'previous_price.numeric'              => trans('ProdPrice Numeric'),
            'previous_price.min'                 => trans('PriceMin'),
            'file.mimes'                          => trans('FILE'),


        ];
        
        

        $validator  = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return response()->json([
                "status" =>  false,
                "errors" =>  $validator->messages(),
            ], 200);
        }


        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //   return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        // }
        //--- Validation Section Ends

        $gs = DB::table('generalsettings')->find(1);
        //-- Logic Section
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default', '=', 1)->first();
        $input = $request->all();
        $input['feature'] = $request->feature ? $request->feature : 0;
        if ($request->feature == 1) {
            $input['subscription_period'] = $request->subscription_period;
            $input['trial_period'] = $request->trial_period;
        } else {
            $input['subscription_period'] = 0;
            $input['trial_period'] = 0;
        }
        //Check Types
        if ($request->type_check == 1) {
            $input['link'] = null;
        } else {
            if ($data->file != null) {
                if (file_exists(public_path() . '/assets/files/' . $data->file)) {
                    unlink(public_path() . '/assets/files/' . $data->file);
                }
            }
            $input['file'] = null;
        }


        // Check Physical
        if ($data->type == "Physical") {

            //--- Validation Section
            $rules = [
                'sku'                                               =>  'min:4',
             //   'stock'                                             =>  'numeric|min:0',
                'size_qty.*'                                        =>  'numeric|min:1',
                'size_price.*'                                      =>  'numeric|min:0',
                'color_qty.*'                                       =>  'numeric|min:1',
                'color_price.*'                                     =>  'numeric|min:0',
                'color_image.*'                                     =>  'image',
                'mobile_price'                                    =>  'numeric|min:0',
                'scale'                                           =>  'numeric|min:0',
                'featured_price'                                     =>  'nullable|numeric|min:0',
            ];

            $messages = [

                'sku.min'                                                  => trans('ProdSku Min'),

           //     'stock.numeric'                                            => trans('ProdStock'),
           //     'stock.min'                                                => trans('StockMin'),
                'size_qty.*.numeric'                                       => trans('SizeQty'),
                'size_qty.*.min'                                           => trans('SizeMin'),
                'size_price.*.numeric'                                     => trans('SizePrice'),
                'size_price.*.min'                                         => trans('SizePriceMin'),
                'color_qty.*.numeric'                                      => trans('ColorQty'),
                'color_qty.*.min'                                          => trans('ColorMin'),
                'color_price.*.numeric'                                    => trans('ColorPrice'),
                'color_price.*.min'                                        => trans('ColorPriceMin'),
                'mobile_price.numeric'                                     => trans('MobilePrice'),
                'mobile_price.min'                                         => trans('MobilePriceMin'),
                'scale.*.numeric'                                          => trans('Scale'),
                'scale.*.min'                                              => trans('ScaleMin'),



            ];

            if (!empty($request->whole_check)) {
                $rules = [
                    'whole_sell_qty.*'                                  =>  'numeric|min:0',
                    'whole_sell_discount.*'                                  =>  'numeric|min:0',
                ];


                $messages = [
                    'whole_sell_qty.*.numeric'                                 => trans('WholeSell'),
                    'whole_sell_qty.*.min'                                     => trans('WholeSell Min'),
                    'whole_sell_discount.*.numeric'                            => trans('WholeSellDiscount'),
                    'whole_sell_discount.*.min'                                => trans('WholeSellDiscount Min'),
                ];
            }


            $validator  = Validator::make($request->all(), $rules, $messages);


            if ($validator->fails()) {
                return response()->json([
                    "status" =>  false,
                    "errors" =>  $validator->messages(),
                ], 200);
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == "") {
                $input['product_condition'] = 0;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == "") {
                $input['ship'] = null;
            }

            if ($request->free_ship == "") {
                $input['free_ship'] = 0;
            }

            // Check Size

            if (empty($request->size_check)) {
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
            } else {
                if (in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price)) {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                } else {
                    $input['size'] = implode(',', str_replace(' ', '-', $request->size));
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $input['size_price'] = implode(',', $request->size_price);
                }
            }

            // Check Color By Sizes
            if (empty($gs->is_erp) || $gs->is_erp == 0) {

                if (empty($request->size_color_check)) {
                    $color =  Color::where('product_id', $id)->delete();
                } else {
                    $color =  Color::where('product_id', $id)->delete();

                    if ($request->size_color) {

                        $interest_array = $request->size_color;
                        $interest_color = $request->color_size;
                        $interest_qty = $request->color_qty;
                        $interest_price = $request->color_price;
                        // $interest_image = $request->color_image;
                        $array_len = count($interest_array);
                        for ($i = 0; $i < $array_len; $i++) {
                            $interest_ext = $interest_array[$i];
                            $related = new Color();
                            $related->size = str_replace(' ', '-', $interest_array[$i]);
                            $related->colors = $interest_color[$i];
                            $related->size_qty = $interest_qty[$i];
                            $related->size_price = $interest_price[$i];
                            // $related->image = $interest_image[$i]->getClientOriginalName();
                            $related->product_id = $id;
                            $related->save();
                        }
                    }
                }
            } else {
                $colors =  Color::where('product_id', $id)->get();

                if ($request->size_color) {

                    $interest_array = $request->size_color;
                    $interest_color = $request->color_size;
                    $interest_qty = $request->color_qty;
                    $interest_price = $request->color_price;
                    $interest_image = $request->color_image;
                    $array_len = count($interest_array);
                    for ($i = 0; $i < $array_len; $i++) {
                        $interest_ext = $interest_array[$i];
                        $color = $colors[$i];
                        $color->size = str_replace(' ', '-', $interest_array[$i]);
                        $color->colors = $interest_color[$i];
                        $color->size_qty = $interest_qty[$i];
                        $color->size_price = $interest_price[$i];

                        if (isset($interest_image[$i])) {
                            $oldImagePath = public_path('assets/images/product-colors/') . $color->image;

                            if (is_file($oldImagePath)) {
                                unlink($oldImagePath);
                            }


                            $image = $interest_image[$i];
                            $fileName = $image->hashName();
                            $destinationPath = public_path('assets/images/product-colors');
                            $imgFile = Image::make($image->getRealPath());
                            $imgFile->save($destinationPath . '/' . $fileName);

                            $color->image = $fileName;
                            $color->product_id = $id;
                        }

                        $color->save();
                    }
                }
            }

            /* */
 if (!empty($request->country_price_check)) {

            if ($request->country_price) {

                $interest_array = $request->country_price;
                $interest_country = $request->country;
            
                $array_len = count($interest_array);
                for ($i = 0; $i < $array_len; $i++) {
                    $interest_ext = $interest_array[$i];
                    $ProductCurrency = new ProductCurrency();
                    $ProductCurrency->price =  $interest_array[$i];
                    $ProductCurrency->country = $interest_country[$i];
                    $ProductCurrency->product_id = $id;

                    $ProductCurrency->save();
                }
            }
        }
            // Check Whole Sale
            if (empty($request->whole_check)) {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            } else {
                if (in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount)) {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                } else {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            if (true) { // empty($gs->is_erp) || $gs->is_erp == 0
                // Check Color
                if (empty($request->color_check)) {
                    $input['color'] = null;
                } else {
                    if (!empty($request->color)) {
                        $input['color'] = implode(',', $request->color);
                    }
                    if (empty($request->color)) {
                        $input['color'] = null;
                    }
                }
            } else {

                $input['color'] = null;
            }
            /* */
            // Check Measure
            if ($request->measure_check == "") {
                $input['measure'] = null;
            }
        }




        if ($request->hasFile('mobile_photo')) {

            $image = $request->file('mobile_photo');
            $image_ext = $image->getClientOriginalExtension();
            $new_image_name = rand(123456, 999999) . "." . $image_ext;
            $destination_path = public_path('assets/images/products/');
            $image->move($destination_path, $new_image_name);
            $input['mobile_photo'] = $new_image_name;
        }

        if ($request->hasFile('hover_photo')) {

            $imagem2 = $request->file('hover_photo');
            $image_ext2 = $imagem2->getClientOriginalExtension();
            $new_image_name2 = rand(123456, 999999) . "." . $image_ext2;
            $destination_path2 = public_path('assets/images/products/');
            $imagem2->move($destination_path2, $new_image_name2);
            $input['hover_photo'] = $new_image_name2;
        }

  if ($request->hasFile('photo')) {

            $imagem3 = $request->file('photo');
            $image_ext3 = $imagem3->getClientOriginalExtension();
            $new_image_name3 = rand(123456, 999999) . "." . $image_ext3;
            $destination_path3 = public_path('assets/images/products/');
            $imagem3->move($destination_path3, $new_image_name3);
            $input['photo'] = $new_image_name3;
        }



        // Check Seo
        if (empty($request->seo_check)) {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        } else {
            if (!empty($request->meta_tag)) {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }



        // Check License
        if ($data->type == "License") {

            if (!in_array(null, $request->license) && !in_array(null, $request->license_qty)) {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            } else {
                if (in_array(null, $request->license) || in_array(null, $request->license_qty)) {
                    $input['license'] = null;
                    $input['license_qty'] = null;
                } else {
                    $license = explode(',,', $prod->license);
                    $license_qty = explode(',', $prod->license_qty);
                    $input['license'] = implode(',,', $license);
                    $input['license_qty'] = implode(',', $license_qty);
                }
            }
        }

        // Check Features
        if (!in_array(null, $request->features) && !in_array(null, $request->colors)) {
            $input['features'] = implode(',', str_replace(',', ' ', $request->features));
            $input['colors'] = implode(',', str_replace(',', ' ', $request->colors));
        } else {
            if (in_array(null, $request->features) || in_array(null, $request->colors)) {
                $input['features'] = null;
                $input['colors'] = null;
            } else {
                $features = explode(',', $data->features);
                $colors = explode(',', $data->colors);
                $input['features'] = implode(',', $features);
                $input['colors'] = implode(',', $colors);
            }
        }

        //Product Tags
        if (!empty($request->tags)) {
            $input['tags'] = implode(',', $request->tags);
        }
        if (empty($request->tags)) {
            $input['tags'] = null;
        }


        if (!empty($request->tags_ar)) {
            $input['tags_ar'] = implode(',', $request->tags_ar);
        }

        if (empty($request->tags_ar)) {
            $input['tags_ar'] = null;
        }

        $input['price'] = $input['price'] / $sign->value;
        // $input['mobile_price'] = $input['mobile_price'] > 0 ? $input['mobile_price'] : $input['price'] ;
        if (!empty($input['mobile_price'])) {
            $input['mobile_price'] = $input['mobile_price'] > 0 ? $input['mobile_price'] : $input['price'];
        } else {
            $input['mobile_price']  = $input['price'];
        }

        $input['previous_price'] = $input['previous_price'] / $sign->value;

        if (isset($input['featured_price_check'])) {
            $input['featured_price'] = $input['featured_price'] / $sign->value;
        } else {
            $input['featured_price'] = null;
        }

        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }
        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }



        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }


        if ($data->type != 'Physical') {
            $data->slug = str_slug($data->name, '-') . '-' . strtolower(str_random(3) . $data->id . str_random(3));
            // $data->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower(str_random(3).$data->id.str_random(3));
            $data->slug_ar = preg_replace('/\s+/', '-', $data->name_ar) . '-' . strtolower(str_random(3) . $data->id . str_random(3));
        } else {
            $data->slug = str_slug($data->name, '-') . '-' . strtolower($data->sku);
            // $data->slug_ar = str_slug($data->name_ar,'-').'-'.strtolower($data->sku);
            $data->slug_ar = preg_replace('/\s+/', '-', $data->name_ar) . '-' . strtolower($data->sku);
        }

        $data->update($input);
        //-- Logic Section Ends

        if ($request->related) {

            $interest_array = $request->related;
            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {
                $interest_ext = $interest_array[$i];
                $related = new Related();
                $related->related_id = $interest_ext;
                $related->product_id = $id;
                $related->save();
            }
        }


        //--- Redirect Section
        $msg = trans('Update Success');
        return response()->json([
            "status" =>  true,
            "msg" => $msg
        ], 200);


        /*  $msg = 'Product Updated Successfully.<a href="'.route('admin-prod-index').'">View Product Lists.</a>';
        return response()->json($msg);*/


        //--- Redirect Section Ends
    }


    //*** GET Request
    public function feature($id)
    {
        $data = Product::findOrFail($id);
        return view('admin.product.highlight', compact('data'));
    }

    //*** POST Request
    public function featuresubmit(Request $request, $id)
    {
        //-- Logic Section
        $data = Product::findOrFail($id);
        $input = $request->all();
        if ($request->featured == "") {
            $input['featured'] = 0;
        }
        if ($request->hot == "") {
            $input['hot'] = 0;
        }
        if ($request->best == "") {
            $input['best'] = 0;
        }
        if ($request->top == "") {
            $input['top'] = 0;
        }
        if ($request->latest == "") {
            $input['latest'] = 0;
        }
        if ($request->big == "") {
            $input['big'] = 0;
        }
        if ($request->trending == "") {
            $input['trending'] = 0;
        }
        if ($request->sale == "") {
            $input['sale'] = 0;
        }
        if ($request->is_discount == "") {
            $input['is_discount'] = 0;
            $input['discount_date'] = null;
        }

        $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section

        $msg = trans('highlight');

        return response()->json([
            "status" =>  true,
            "msg" => $msg
        ], 200);

        // return response()->json($msg);
        //--- Redirect Section Ends

    }

    //*** GET Request
    public function relateddelete($id)
    {
        $related = Related::find($id);
        $related->delete();

        return redirect()->back();
    }
 


    public function destroy($id)
    {

        $data = Product::findOrFail($id);
        if ($data->galleries->count() > 0) {
            foreach ($data->galleries as $gal) {

                if (!empty($gal->photo)) {
                    if (file_exists(public_path() . '/assets/images/galleries/' . $gal->photo)) {
                        unlink(public_path() . '/assets/images/galleries/' . $gal->photo);
                    }
                }
                $gal->delete();
            }
        }

        if ($data->reports->count() > 0) {
            foreach ($data->reports as $gal) {
                $gal->delete();
            }
        }

        if ($data->ratings->count() > 0) {
            foreach ($data->ratings  as $gal) {
                $gal->delete();
            }
        }
        if ($data->wishlists->count() > 0) {
            foreach ($data->wishlists as $gal) {
                $gal->delete();
            }
        }
        if ($data->clicks->count() > 0) {
            foreach ($data->clicks as $gal) {
                $gal->delete();
            }
        }
        if ($data->comments->count() > 0) {
            foreach ($data->comments as $gal) {
                if ($gal->replies->count() > 0) {
                    foreach ($gal->replies as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }



        if (!empty($data->photo)) {
            if (!filter_var($data->photo, FILTER_VALIDATE_URL)) {
                if (file_exists(public_path() . '/assets/images/products/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/products/' . $data->photo);
                }
            }
        }


        if (!empty($data->thumbnail)) {
            if (file_exists(public_path() . '/assets/images/thumbnails/' . $data->thumbnail) && $data->thumbnail != "") {
                unlink(public_path() . '/assets/images/thumbnails/' . $data->thumbnail);
            }
        }

        if ($data->file != null) {
            if (file_exists(public_path() . '/assets/files/' . $data->file)) {
                unlink(public_path() . '/assets/files/' . $data->file);
            }
        }
        $data->delete();
        //--- Redirect Section
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends

        // PRODUCT DELETE ENDS
    }

    public function getAttributes(Request $request)
    {
        $model = '';
        if ($request->type == 'category') {
            $model = 'App\Models\Category';
        } elseif ($request->type == 'subcategory') {
            $model = 'App\Models\Subcategory';
        } elseif ($request->type == 'childcategory') {
            $model = 'App\Models\Childcategory';
        }

        $attributes = Attribute::where('attributable_id', $request->id)->where('attributable_type', $model)->get();
        $attrOptions = [];
        foreach ($attributes as $key => $attribute) {
            $options = AttributeOption::where('attribute_id', $attribute->id)->get();
            $attrOptions[] = ['attribute' => $attribute, 'options' => $options];
        }
        return response()->json($attrOptions);
    }

    public function ckeckall(Request $request)
    {

        if (!empty($request->input('selected_products'))) {


            $selected_products = explode(',', $request->input('selected_products'));



            $products = Product::whereIn('id', $selected_products)
                ->update(['status' => 0]);

            $msg = 'Products Deactivate Successfully.';
            //  return redirect()->back()->with('success',$msg);


            return response()->json([
                "status" =>  true,
                "msg" => $msg
            ], 200);
        } else {
            return redirect()->back();
        }
    }
    public function ckeckactivate(Request $request)
    {

        if (!empty($request->input('selected_products_activate'))) {


            $selected_products = explode(',', $request->input('selected_products_activate'));



            $products = Product::whereIn('id', $selected_products)
                ->update(['status' => 1]);

            $msg = 'Products activate Successfully.';
            return redirect()->back()->with('success', $msg);
        } else {
            return redirect()->back();
        }
    }
    public function ckeckcatalog(Request $request)
    {

        if (!empty($request->input('selected_products_catalog'))) {


            $selected_products = explode(',', $request->input('selected_products_catalog'));



            $products = Product::whereIn('id', $selected_products)
                ->update(['is_catalog' => 1]);

            $msg = 'Products add to Catalog Successfully.';
            return redirect()->back()->with('success', $msg);
        } else {
            return redirect()->back();
        }
    }
    public function ckeckdelete(Request $request)
    {

        if (!empty($request->input('selected_products_delete'))) {


            $selected_products = explode(',', $request->input('selected_products_delete'));



            $products = Product::whereIn('id', $selected_products)
                ->get();

            foreach ($products as $data) {
                if ($data->galleries->count() > 0) {
                    foreach ($data->galleries as $gal) {
                        if (!empty($gal->photo)) {
                            if (file_exists(public_path() . '/assets/images/galleries/' . $gal->photo)) {
                                unlink(public_path() . '/assets/images/galleries/' . $gal->photo);
                            }
                        }
                        $gal->delete();
                    }
                }

                if ($data->reports->count() > 0) {
                    foreach ($data->reports as $gal) {
                        $gal->delete();
                    }
                }

                if ($data->ratings->count() > 0) {
                    foreach ($data->ratings  as $gal) {
                        $gal->delete();
                    }
                }
                if ($data->wishlists->count() > 0) {
                    foreach ($data->wishlists as $gal) {
                        $gal->delete();
                    }
                }
                if ($data->clicks->count() > 0) {
                    foreach ($data->clicks as $gal) {
                        $gal->delete();
                    }
                }
                if ($data->comments->count() > 0) {
                    foreach ($data->comments as $gal) {
                        if ($gal->replies->count() > 0) {
                            foreach ($gal->replies as $key) {
                                $key->delete();
                            }
                        }
                        $gal->delete();
                    }
                }



                if (!empty($data->photo)) {
                    if (!filter_var($data->photo, FILTER_VALIDATE_URL)) {
                        if (file_exists(public_path() . '/assets/images/products/' . $data->photo)) {
                            unlink(public_path() . '/assets/images/products/' . $data->photo);
                        }
                    }
                }


                if (!empty($data->thumbnail)) {
                    if (file_exists(public_path() . '/assets/images/thumbnails/' . $data->thumbnail) && $data->thumbnail != "") {
                        unlink(public_path() . '/assets/images/thumbnails/' . $data->thumbnail);
                    }
                }

                if ($data->file != null) {
                    if (file_exists(public_path() . '/assets/files/' . $data->file)) {
                        unlink(public_path() . '/assets/files/' . $data->file);
                    }
                }

                $data->delete();
            }


            $msg = 'Products deleted Successfully.';
            return redirect()->back()->with('success', $msg);
        } else {
            return redirect()->back();
        }
    }


    //*** GET Request
    public function ckeckfeature()
    {

        return view('admin.product.highlight2');
    }


    public function ckeckfeatures(Request $request)
    {

        if (!empty($request->input('selected_products_feature'))) {


            $selected_products = explode(',', $request->input('selected_products_feature'));



            $products = Product::whereIn('id', $selected_products)
                ->get();

            foreach ($products as $data) {
                $input = $request->all();
                if ($request->featured == "") {
                    $input['featured'] = 0;
                }
                if ($request->hot == "") {
                    $input['hot'] = 0;
                }
                if ($request->best == "") {
                    $input['best'] = 0;
                }
                if ($request->top == "") {
                    $input['top'] = 0;
                }
                if ($request->latest == "") {
                    $input['latest'] = 0;
                }
                if ($request->big == "") {
                    $input['big'] = 0;
                }
                if ($request->trending == "") {
                    $input['trending'] = 0;
                }
                if ($request->sale == "") {
                    $input['sale'] = 0;
                }
                if ($request->is_discount == "") {
                    $input['is_discount'] = 0;
                    $input['discount_date'] = null;
                }

                $data->update($input);
            }


            $msg = 'Products HightLight Successfully.';
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function randsku()
    {
        $sku = str_random(3) . substr(time(), 6, 8) . str_random(3);
        return $sku;
    }



    public function AddNotifyTOUsers()
    {

        $pro      = Product::where('status', 1)->get();
        $cities   = Zone::orderBy('id', 'desc')->get();
        return view('admin.ProductNotify.create', compact('pro', 'cities'));
    }


    public function StoreNotifyTOUsers(Request $request)
    {

        if ($request->product_id  && $request->zone_id) {

            $interest_array1 = $request->product_id;

            $interest_array2 = $request->zone_id;

            $array_len1 = count($interest_array1);
            $array_len2 = count($interest_array2);


            if ($array_len1 == $array_len2) {

                $prodsnotify = ProductNotify::all();

                if (!empty($prodsnotify)) {

                    foreach ($prodsnotify  as $notfiy) {
                        $notfiy->delete();
                    }
                }

                for ($i = 0; $i < $array_len1; $i++) {

                    $related = new ProductNotify();
                    $related->product_id = $interest_array1[$i];
                    $related->zone_id = $interest_array2[$i];


                    $related->save();
                }


                $msg = trans('data Save Successfully');
                return response()->json([
                    'status' => true,
                    'msg'   =>  $msg
                ], 200);
            } else {


                $msg = trans('The num of products must be equal to num of citites');
                return response()->json([
                    'status' => false,
                    'msg'   =>  $msg
                ], 200);
            }
        } // endif



    }


    public function exportProducts()
    {
        return Excel::download(new ExportAllProducts, 'products.xlsx');
    }


    public function addaffUser($prod_id)
    {

        $id = $prod_id;
        $users = User::select('id', 'name')->get();
        $userName = request()->input('searchKey');

        if (request()->ajax() && $userName != '') {

            $users =  User::where('name', 'like', "{$userName}%")->select('id', 'name')->get();
            return view('admin.product.search_users', compact('users', 'id'));
        } elseif (request()->ajax() && $userName == '') {

            $users = User::select('id', 'name')->get();
            return view('admin.product.search_users', compact('users', 'id'));
        }
        return view('admin.product.all_users', compact('users', 'id'));
    }


    public function storeaffUser(Request $request)
    {
        if ($request->all_users) {

            $interest_array = $request->all_users;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $user = AffilateUsers::where('user_id', $interest_array[$i])->first();
                $userHasProductBefore = AffilateUsers::where([
                    ['user_id', $interest_array[$i]],
                    ['product_id', $request->id]
                ])->first();

                if (empty($userHasProductBefore)) {

                    $related = new AffilateUsers();
                    $related->user_id = $interest_array[$i];
                    $related->product_id = $request->id;
                    $related->save();
                }
            }
        }

        $msg = "users added successfully";
        return response()->json(['status' =>  true, 'msg' => $msg], 200);
    }


    public function getallaffUser($id)
    {
        $users = AffilateUsers::where('product_id', $id)->get();

        return view('admin.product.prod_aff_users', compact('users'));
    }

    public function removeaffUser($id)
    {
        $data = AffilateUsers::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends   
    }




    public function photo($id)
    {
        $data = Product::findOrFail($id);
        return view('admin.product.photo', compact('data'));
    }

    //*** POST Request
    public function photoupdate(Request $request, $id)
    {
        //-- Logic Section
        $data = Product::findOrFail($id);
        $input = $request->all();



        $imagem2 = $request->file('photo');
        $image_ext2 = $imagem2->getClientOriginalExtension();
        $new_image_name2 = rand(123456, 999999) . "." . $image_ext2;
        $destination_path2 = public_path('assets/images/products/');
        $imagem2->move($destination_path2, $new_image_name2);
        $input['photo'] = $new_image_name2;
        $input['thumbnail'] = $new_image_name2;



        $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section

        $msg = trans('updated');

        return response()->json([
            "status" =>  true,
            "msg" => $msg
        ], 200);

        // return response()->json($msg);
        //--- Redirect Section Ends

    }
    
   public function countrypricedelete($id)
    {
        $related = ProductCurrency::find($id);
        $related->delete();

        return redirect()->back();
    }
 
   public function countrypriceedit($id)
    {
        
        $data = ProductCurrency::findOrFail($id);
        return view('admin.product.countrypriceedit',compact('data'));
    }  
    
    
   public function countrypriceupdate(Request $request, $id)
    {
        //-- Logic Section
        $data = ProductCurrency::findOrFail($id);
        $input = $request->all();

 

        $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section

        $msg = trans('updated');

        return response()->json([
            "status" =>  true,
            "msg" => $msg
        ], 200);

        // return response()->json($msg);
        //--- Redirect Section Ends

    } 
}
