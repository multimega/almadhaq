<?php

namespace App\Http\Controllers\Api;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Currency;
use App\Models\Offer;
use App\Models\Brand;
use App\Models\OfferProduct;
use App\Models\Country;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Counter;
use App\Models\Slider;
use App\Models\Generalsetting;
use App\Models\Pagesetting;
use App\Models\Order;
use App\Models\Colike;
use App\Models\Attribute;
use App\Models\Notifications;
use App\Models\AttributeOption;
use App\Models\Color;
use App\Models\AdminUserConversation;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Like;
use App\Models\Zone;
use App\Models\Gallery;

use App\Models\ads;
use App\Models\Comment;
use App\Models\productFavorite;
use App\Models\Address;
use App\Models\ratings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use InvalidArgumentException;
use Markury\MarkuryPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class FrontendController extends Controller
{


  public function __construct() {}



  public function Product($id)
  {
    // dd(Auth::guard('api')->user());
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('created_at', 'review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('id', '=', $id)->first();

    // dd($products);
    $p = new product();
    // $products['currency'] = $p->setCurrency();
    $products['showTags'] = $p->showTags();
    // dd($products);

    $offer = OfferProduct::where('product_id', '=',  $id)->first();
    if ($offer) {
      $products['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
    } else {
      $products['Offer'] = '';
    }

    $products['link'] = url('item/' . $products->slug);
    $products['Gallery'] = Gallery::where('product_id', '=', $id)->get();
    $products['attributes'] = json_decode($products->attributes, true);
    $products['details_ar'] = str_replace('&nbsp;', ' ', strip_tags($products->details_ar));
    $products['details'] = str_replace('&nbsp;', ' ', strip_tags($products->details));
    $products['mobile_details'] = str_replace('&nbsp;', ' ', strip_tags($products->details));
    $products['mobile_details_ar'] = str_replace('&nbsp;', ' ', strip_tags($products->details_ar));
    $products['policy'] = str_replace('&nbsp;', ' ', strip_tags($products->policy));
    $products['policy_ar'] = str_replace('&nbsp;', ' ', strip_tags($products->policy_ar));
    $products['mobile_policy'] = str_replace('&nbsp;', ' ', strip_tags($products->policy));
    $products['mobile_policy_ar'] = str_replace('&nbsp;', ' ', strip_tags($products->policy_ar));

    //   $products['attributes_ar'] = json_decode($products->attributes , true);


    $color = Color::where('product_id', $id)->get();

    if (!empty($products['size'])) {

      $products['sizes'] =  array_values(array_unique($products['size']));
      $products['size_qtys'] =    !empty($products['size_qty']) ? $products['size_qty'] : [0];
      $products['size_prices'] = $products['size_price'];
      if (!empty($products['color'])) {
        $products['colorss'] = array_values(array_unique($products['color']));
      } else {
        $products['colorss'] = [];
      }
    } else {

      $products['sizes'] =   [];
      $products['size_qtys'] =   [];
      $products['size_prices'] = [];
      $products['colorss'] = !empty($products['color']) ? array_values(array_unique($products['color'])) : [];
    }




    if (count($color) > 0) {
      $sizes = [];
      $size_qty = [];
      $size_price = [];
      $colorss = [];
      foreach ($color as $colors) {
        $sizes[] = $colors->size;
        $size_qty[] = $colors->size_qty;
        $size_price[] = $colors->size_price;
        $colorss[] = $colors->colors;
      }
      $products['sizes'] =   array_values(array_unique($sizes));
      $products['size_qtys'] = $size_qty;
      $products['size_prices'] = $size_price;
      $products['colorss'] = array_values(array_unique($colorss));
    }

    if (Auth::guard('api')->user()) {

      $currency = Currency::find(Auth::guard('api')->user()->currency);
      $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $products->id)->first();
      if ($favorite_status) {
        // $favorite_status = "true";
        $products['favorite_status'] = "true";
      } else {
        $products['favorite_status']  = 'false';
      }

      $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $id)->first();
      if ($like) {
        $products['like_status'] = "true";
      } else {
        $products['like_status'] = "false";
      }
    } else {


      $currency = Currency::where('is_default', 1)->first();
      $products['like_status'] = "false";
      $products['favorite_status']  = 'false';
    }

    $products['likes'] = Like::where('product_id', '=', $id)->count();
    $products['comments_replay']  = Comment::with('replies')->where('product_id', '=', $id)->get();


    $products['currency_ar'] = $currency['name_ar'];

    $products['currency_en'] = $currency['name'];
    $products['mobile_price'] =  number_format($products['mobile_price'] * $currency['value'], 2);
    $products['price'] =  $products['price'] * $currency['value'];
    if ($products->previous_price) {
      $products['previous_price']  = number_format($products->previous_price * $currency['value'], 2);
      $products['discount'] = 0;
    } else {
      $products['discount'] = 0;
    }
    $products['related_product'] =  Product::where('category_id', $products->category_id)->where('status', '=', 1)->take(10)->get();
    foreach ($products['related_product'] as $k => $v) {
      $products['related_product'][$k]['currency_ar'] = $currency['name_ar'];
      $products['related_product'][$k]['currency_en'] = $currency['name'];
      $products['related_product'][$k]['currency_value'] = $currency['value'];
      $products['related_product'][$k]['mobile_price'] =  number_format($products['related_product'][$k]['mobile_price'] *  $currency['value'], 2);
      $products['related_product'][$k]['price'] =  $products['related_product'][$k]['price'] *  $currency['value'];

      if (!empty($products['related_product'][$k]['previous_price'])) {
        $products['related_product'][$k]['previous_price'] = number_format($products['related_product'][$k]['previous_price'] * $currency['value'], 2);
        $products['related_product'][$k]['discount'] = 0;
      } else {
        $products['related_product'][$k]['discount'] = 0;
      }
    }

    //   $comments = Comment::select("users.name","users.photo","comments.*")
    //   ->where('product_id', '=', $products->id)
    //   ->join("users","users.id","=","comments.user_id")
    //   ->get();  
    //   $products['comments_count'] = count($comments);
    //   $products['comments'] = $comments;


    $rates = ratings::select("ratings.*", "users.photo", "users.name")
      ->join("users", "ratings.user_id", "=", "users.id")
      ->where('product_id', '=', $id)
      ->get();

    $products['comments_count'] = count($rates);
    $products['comments'] = $rates;






    $ratings =    ratings::where('product_id', '=', $id)->pluck('rating');
    $ratings =  json_decode($ratings, true);
    $rate =  array_count_values($ratings);
    $total_rating = ratings::where('product_id', $id)->selectRaw('SUM(rating)/COUNT(user_id) AS avg_rating')->first()->avg_rating;


    return response()->json(array('status' => 'Ok', 'products' => $products, "review_rate" => $total_rating));
  }


  public function colors($id, $size)
  {

    $color = Color::where('product_id', $id)->where('colors', '#' . $size)->where('size_qty', '>', 0)->get();




    return response()->json(array('status' => 'Ok', 'colors' => $color));
  }


  public function sizes($id, $size)
  {

    $color = Color::where('product_id', $id)->where('size', $size)->where('size_qty', '>', 0)->get();




    return response()->json(array('status' => 'Ok', 'sizes' => $color));
  }


  public function ProductByBrand($id)
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('brand_id', '=', $id)->orderBy('id', 'desc')->get();


    $brand = Brand::find($id)->photo;


    foreach ($products as $k => $product) {
      //     $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();  
      //   if($favorite_status){
      //   // $favorite_status = "true";
      //   $products[$k]['favorite_status'] = "true";
      //   }else{
      //     $products[$k]['favorite_status']  = 'false';
      //   }

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $products[$k]['currency_ar'] = $currency['name_ar'];
      $products[$k]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    //   $products = Product::where('brand_id','=',$id)->where('status','=',1)->get();

    return response()->json(array('status' => 'Ok', 'products' => $products, 'photo' => $brand));
  }


  public function ProductHot()
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();



    //   $products = Product::where('hot','=',1)->where('status','=',1)->get();
    foreach ($products as $k => $product) {


      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $product['currency_en'] = $currency->name;
      $product['currency_ar'] = $currency->name_ar;
      $product['currency_value'] = $currency->value;
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $products));
  }


  public function ProductBest()
  {

    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();




    //   $products = Product::where('best','=',1)->where('status','=',1)->get();
    foreach ($products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();
      $product['currency_en'] = $currency->name;
      $product['currency_ar'] = $currency->name_ar;
      $product['currency_value'] = $currency->value;
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $products));
  }


  public function auth()
  {
    $user = Auth::guard('api')->user();

    return Auth::guard('api')->user();
  }

  public function LatestProduct(Request $request)
  {

    $latest_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {
      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    $adds = ads::take(3)->get();
    foreach ($adds as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products, 'ads' => $adds));
  }


  public function TrendingProduct()
  {

    // $trending_products =  Product::where('trending','=',1)->where('status','=',1)->orderBy('id','desc')->take(9)->get();

    $trending_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();




    foreach ($trending_products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();
      $product['currency_en'] = $currency->name;
      $product['currency_ar'] = $currency->name_ar;
      $product['currency_value'] = $currency->value;
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $trending_products));
  }



  public function SaleProduct()
  {

    $latest_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {
      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();


      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];

      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products));
  }



  public function ProductByCategory($id)
  {
    $latest_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('category_id', '=', $id)->where('status', '=', 1)->orderBy('id', 'desc')->get();

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {


      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();



      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';

      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products));
  }


  public function offerpage($id)
  {

    $pro = OfferProduct::with('products')->where('offer_id', $id)->pluck('product_id');



    $latest_products =   Product::whereIn('id', $pro)->get();
    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();



      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';

      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products));
  }
  public function offers()
  {




    $offer = Offer::get();

    foreach ($offer as $o) {
      $pro = OfferProduct::with('products')->where('offer_id', $o->id)->pluck('product_id');


      $o['products'] =  Product::whereIn('id', $pro)->get();
      foreach ($o['products'] as $k => $product) {


        if (Auth::guard('api')->user()) {

          $currency = Currency::find(Auth::guard('api')->user()->currency);
          $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
          if ($favorite_status) {
            // $favorite_status = "true";
            $product['favorite_status'] = "true";
          } else {
            $product['favorite_status']  = 'false';
          }
          $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
          if ($like) {
            $product['like_status'] = "true";
          } else {
            $product['like_status'] = "false";
          }
        } else {

          $currency = Currency::where('is_default', 1)->first();
          $product['like_status'] = "false";
          $product['favorite_status']  = 'false';
        }

        $product['price'] = round($product->price / $currency->value);
        $product['mobile_photo'] = !empty($product['mobile_photo']) ? $product['mobile_photo'] : $product['photo'];
        $category = category::where('id', $product->category_id)->first();
        $brand = Brand::where('id', $product->brand_id)->first();
        $photo = Gallery::where('product_id', $product->id)->where('web', 0)->get();
        $size = Color::where('product_id', $product->id)->get();

        $product['brand'] = !empty($brand->name) ? $brand->name : null;
        $product['category'] = $category->name;
        $product['gallery'] = $photo;
        if (empty($product->size)) {
          $product['sizes'] = Color::where('product_id', $product->id)->get();
        } else {
          $product['sizes'] = $product->size;
        }
        $product['link'] = url('api/product/' . $product->id);
        $product['currency'] = $currency->name;
        $product['currency_ar'] = $currency->name_ar;
        $product['currency_value'] = $currency->value;
        $product['mobile_price']  = round($product->mobile_price * $currency['value'], 2);
        if ($product->previous_price) {
          $product['previous_price']  = round($product->previous_price * $currency['value'], 2);

          $product['discount'] = 0;
        } else {
          $product['discount'] = 0;
        }
      }
    }

    return response()->json(array('status' => 'Ok', 'offers' => $offer));
  }



  public function ProductBySubcategory($id)
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('subcategory_id', '=', $id)->where('status', 1)->orderBy('id', 'desc')->get();
    foreach ($products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }

      $products[$k]['currency_ar'] = $currency['name_ar'];
      $products[$k]['currency_en'] = $currency['name'];


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $product['mobile_price']  = round($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = round($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }
    return response()->json(array('status' => 'Ok', 'products' => $products));
  }

  public function ProductByChildcategory($id)
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['subcategory' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('childcategory_id', '=', $id)->where('status', 1)->orderBy('id', 'desc')->get();
    foreach ($products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $products[$k]['currency_ar'] = $currency['name_ar'];
      $products[$k]['currency_en'] = $currency['name'];


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();
      $product['mobile_price']  = round($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = round($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }
    return response()->json(array('status' => 'Ok', 'products' => $products));
  }


  public function ProductSearch($slug = null)
  {
    if (strlen($slug) >= 1) {
      $search = ' ' . $slug;
      $prods = Product::where('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->orWhere('name_ar', 'like', $slug . '%')->where('status', '=', 1)->take(10)->get();
      // return view('load.suggest',compact('prods','slug'));



      if (count($prods) > 0) {


        foreach ($prods as $product) {
          if (Auth::guard('api')->user()) {

            $currency = Currency::find(Auth::guard('api')->user()->currency);
            $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
            if ($favorite_status) {
              // $favorite_status = "true";
              $product['favorite_status'] = "true";
            } else {
              $product['favorite_status']  = 'false';
            }
            $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
            if ($like) {
              $product['like_status'] = "true";
            } else {
              $product['like_status'] = "false";
            }
          } else {

            $currency = Currency::where('is_default', 1)->first();
            $product['like_status'] = "false";
            $product['favorite_status']  = 'false';
          }




          $product['price'] = round($product->price / $currency->value);
          $category = category::where('id', $product->category_id)->first();
          $brand = Brand::where('id', $product->brand_id)->first();
          $photo = Gallery::where('product_id', $product->id)->where('web', 0)->get();
          $size = Color::where('product_id', $product->id)->get();

          $product['brand'] = !empty($brand) ? $brand->name : '';
          $product['category'] = $category->name;
          $product['gallery'] = $photo;
          if (empty($product->size)) {
            $product['sizes'] = Color::where('product_id', $product->id)->get();
          } else {
            $product['sizes'] = $product->size;
          }
          $product['link'] = url('api/product/' . $product->id);
          $product['currency_en'] = $currency->name;
          $product['currency_ar'] = $currency->name_ar;
          $product['currency_value'] = $currency->value;

          $product['mobile_price']  = round($product->mobile_price * $currency['value'], 2);
          if ($product->previous_price) {
            $product['previous_price']  = round($product->previous_price * $currency['value'], 2);

            $product['discount'] = 0;
          } else {
            $product['discount'] = 0;
          }

          $product['likes'] = Like::where('product_id', '=', $product->id)->count();
        }


        return response()->json(array('status' => 'Ok', 'products' => $prods, 'slug' => $slug));
      } else {

        return response()->json(array('status' => 'Ok', 'products' => [], 'slug' => $slug));
      }
    }
    return response()->json(array('status' => 'Ok', 'products' => [], 'slug' => ' '));
  }

  public function filter(Request $data)
  {


    if (Auth::guard('api')->user()) {

      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }

    $cat = null;
    $subcat = null;
    $childcat = null;
    $minprice = $data['min'] / $currency->value;
    $maxprice = $data['max'] / $currency->value;
    $brands = $data['brands'];
    $cats = $data['cats'];
    $atrr = $data['atrr'];
    if ($brands) {
      $brands = array_map(
        function ($value) {
          return (int)$value;
        },
        $brands
      );
    }

    if ($cats) {
      $cats = array_map(
        function ($cat) {
          return (int)$cat;
        },
        $cats
      );
    }

    if ($atrr) {
      $atrr = array_map(
        function ($catt) {
          return (int)$catt;
        },
        $atrr
      );
    }
    $sort = $data->sort;


    $products = Product::with(['category' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name', 'name_ar');
    }])->with(['size' => function ($query) {
      $query->select('id', 'size', 'colors', 'size_qty', 'size_price');
    }])->select('id', 'name', 'name_ar', 'sku', 'mobile_photo', 'photo', 'price', 'mobile_price', 'previous_price', 'stock', 'views', 'size', 'category_id', 'user_id', 'brand_id')

      ->when($minprice, function ($query, $minprice) {
        return $query->where('mobile_price', '>=', $minprice);
      })
      ->when($maxprice, function ($query, $maxprice) {
        return $query->where('mobile_price', '<=', $maxprice);
      })

      ->when($brands, function ($query, $brands) {
        return $query->whereIn('brand_id',  $brands);
      })
      ->when($cats, function ($query, $cats) {
        return $query->whereIn('category_id',  $cats);
      })

      ->when($sort, function ($query, $sort) {
        if ($sort == 'date_desc') {
          return $query->orderBy('id', 'DESC');
        } elseif ($sort == 'date_asc') {
          return $query->orderBy('id', 'ASC');
        } elseif ($sort == 'price_desc') {
          return $query->orderBy('mobile_price', 'DESC');
        } elseif ($sort == 'price_asc') {
          return $query->orderBy('mobile_price', 'ASC');
        } elseif ($sort == 'popular') {
          return $query->orderBy('views', 'desc');
        }
      })
      ->when(empty($sort), function ($query, $sort) {
        return $query->orderBy('id', 'DESC');
      });

    $products = $products->where(function ($query) use ($cats, $data) {
      $flag = 0;





      $chFilters = $data["attr"];
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
    });



    $products = $products->where('status', 1)->get();


    foreach ($products as $product) {



      if (Auth::guard('api')->user()) {


        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {


        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['price'] = round($product->price / $currency->value);
      // $category = category::where('id', $product->category_id)->first();
      // $brand = Brand::where('id',$category->brand_id)->first();
      $photo = Gallery::where('product_id', $product->id)->where('web', 0)->get();
      $size = Color::where('product_id', $product->id)->get();

      // $product['brand'] = $brand->name;
      $product['gallery'] = $photo;
      $product['mobile_photo'] = !empty($product['mobile_photo']) ? $product['mobile_photo'] : $product['photo'];
      if (empty($product->size)) {
        $product['sizes'] = Color::where('product_id', $product->id)->get();
      } else {
        $product['sizes'] = $product->size;
      }
      $product['link'] = url('api/product/' . $product->id);
      $product['currency'] = $currency->name;
      $product['currency_value'] = $currency->value;

      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }
    $prices = number_format(DB::table('products')->max('mobile_price')  * $currency->value, 2);

    return response()->json(array('status' => 'Ok', 'products' => $products, 'maxprice' => $prices));
  }

  public function atrabuites($cat)
  {

    $atr = Attribute::with('attribute_options')->where('attributable_id', $cat)->get();

    return response()->json(array('status' => 'Ok', 'atrabuites' => $atr));
  }

  public function atrabuitescats(Request $data)
  {
    $cats = $data['cats'];



    if ($cats) {
      $cats = array_map(
        function ($cat) {
          return (int)$cat;
        },
        $cats
      );
    }

    $atr = Attribute::with('attribute_options')->whereIn('attributable_id', $cats)->get();

    return response()->json(array('status' => 'Ok', 'atrabuites' => $atr));
  }
  // public function addfavorite(Request $data){

  //   $fav =  productFavorite::where('product_id',$data->product_id)->where('user_id',Auth::guard('api')->user()->id)->first();
  //   if($fav){



  //       $productFavorite = productFavorite::find($fav->id);
  //     //   dd($productFavorite);
  //         if($productFavorite->status == 0){
  //                         $productFavorite->status = 1;

  //                     //   return response()->json(array('status' =>'true', 'message'=> "add to favorite"));
  //         $message = "add to favorite";
  //         }elseif($productFavorite->status == 1){
  //                         $productFavorite->status = 0;
  //                     //   return response()->json(array('status' =>'true', 'message'=> "remove form my favorite"));
  //             $message = "remove form my favorite";


  //         }

  //         $productFavorite->save();

  //               return response()->json(array('status' =>'true', 'message'=> $message));

  //   }else{

  //         $productFavorite = new productFavorite;
  //         $productFavorite->user_id = Auth::guard('api')->user()->id;
  //         $productFavorite->product_id = $data->product_id;
  //         $productFavorite->status = 1;
  //         $productFavorite->save();
  //                  return response()->json(array('status' =>'true', 'message'=> "add to favorite"));

  //   }
  // }
  // Wishlist



  public function addfavorite($product_id)
  {

    $fav =  Wishlist::where('product_id', $product_id)->where('user_id', Auth::guard('api')->user()->id)->first();
    if ($fav) {



      $productFavorite = Wishlist::find($fav->id);

      $productFavorite->delete();

      return response()->json(array('status' => 'true', 'message' => "delete favorit"));
    } else {

      $productFavorite = new Wishlist;
      $productFavorite->user_id = Auth::guard('api')->user()->id;
      $productFavorite->product_id = $product_id;
      $productFavorite->save();
      return response()->json(array('status' => 'true', 'message' => "add to favorite"));
    }
  }



  //  public function addfavorite($product_id){

  //   $fav =  productFavorite::where('product_id',$product_id)->where('user_id',Auth::guard('api')->user()->id)->first();
  //   if($fav){



  //       $productFavorite = productFavorite::find($fav->id);
  //     //   dd($productFavorite);
  //         if($productFavorite->status == 0){
  //                         $productFavorite->status = 1;

  //                     //   return response()->json(array('status' =>'true', 'message'=> "add to favorite"));
  //         $message = "add to favorite";
  //         }elseif($productFavorite->status == 1){
  //                         $productFavorite->status = 0;
  //                     //   return response()->json(array('status' =>'true', 'message'=> "remove form my favorite"));
  //             $message = "remove form my favorite";


  //         }

  //         $productFavorite->save();

  //               return response()->json(array('status' =>'true', 'message'=> $message));

  //   }else{

  //         $productFavorite = new productFavorite;
  //         $productFavorite->user_id = Auth::guard('api')->user()->id;
  //         $productFavorite->product_id = $product_id;
  //         $productFavorite->status = 1;
  //         $productFavorite->save();
  //                  return response()->json(array('status' =>'true', 'message'=> "add to favorite"));

  //   }
  // }


  public function filterColor($color, Request $data)
  {

    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }
    if (isset($data['brands']) && is_array($data['brands'])) {
      $cat_log = category::where('brand_id', $data['brands'])->first();
      $products = Product::with(['category' => function ($query) {
        $query->select('id', 'photo');
      }])->with(['user' => function ($query) {
        $query->select('id', 'name');
      }])->with(['brand' => function ($query) {
        $query->select('id', 'name');
      }])->select('id', 'name', 'name_ar', 'sku', 'price', 'stock', 'category_id', 'user_id', 'brand_id')->whereIn($cat_log->brand_id, $data['brands'])->where('color', '=', $color)->where('status', 1)->get();
    } else {
      $products = Product::with(['category' => function ($query) {
        $query->select('id', 'photo');
      }])->with(['user' => function ($query) {
        $query->select('id', 'name');
      }])->with(['brand' => function ($query) {
        $query->select('id', 'name');
      }])->select('id', 'name', 'name_ar', 'sku', 'price', 'stock', 'category_id', 'user_id', 'brand_id')->where('color', '=', $color)->where('status', 1)->get();
    }

    foreach ($products as $product) {
      $product['price'] = round($product->price / $currency->value);

      // $category = category::where('id', $product->category_id)->first();
      // $brand = Brand::where('id',$category->brand_id)->first();
      $photo = Gallery::where('product_id', $product->id)->get();

      // $product['brand'] = $brand->name;
      $product['photo'] = $photo;
      // $product['link']= 'http://vowalaa.com/demo/product/'.$product->custom_url;
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
      $price = number_format(DB::table('products')->max('price') * $currency->value, 2);
      return response()->json(array('status' => 'Ok', 'products' => $products, 'maxprice' => $price));
    }
  }


  public function filterBrand($brand, Request $data)
  {


    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }

    if (isset($data['brands']) && is_array($data['brands'])) {
      $cat_log = category::where('brand_id', $data['brands'])->first();
      $products = Product::with(['category' => function ($query) {
        $query->select('id', 'photo');
      }])->with(['user' => function ($query) {
        $query->select('id', 'name');
      }])->with(['brand' => function ($query) {
        $query->select('id', 'name');
      }])->select('id', 'name', 'name_ar', 'sku', 'price', 'stock', 'category_id', 'user_id', 'brand_id')->whereIn($cat_log->brand_id, $data['brands'])->where('brand_id', '=', $brand)->where('status', 1)->get();
    } else {
      $products = Product::with(['category' => function ($query) {
        $query->select('id', 'photo');
      }])->with(['user' => function ($query) {
        $query->select('id', 'name');
      }])->with(['brand' => function ($query) {
        $query->select('id', 'name');
      }])->select('id', 'name', 'name_ar', 'sku', 'price', 'stock', 'category_id', 'user_id', 'brand_id')->where('brand_id', '=', $brand)->where('status', 1)->get();
    }

    foreach ($products as $product) {


      $product['price'] = round($product->price / $currency->value);
      // $category = category::where('id', $product->category_id)->first();
      // $brand = Brand::where('id',$category->brand_id)->first();
      $photo = Gallery::where('product_id', $product->id)->get();

      // $product['brand'] = $brand->name;
      $product['photo'] = $photo;
      // $product['link']= 'http://vowalaa.com/demo/product/'.$product->custom_url;
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
      $price = number_format(DB::table('products')->max('price') * $currency->value, 2);
      return response()->json(array('status' => 'Ok', 'products' => $products, 'maxprice' => $price));
    }
  }

  public function Slider()
  {

    $sliders = Slider::where('mobile_setting', '=', 1)->get();
    foreach ($sliders as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->link_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->link_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->link_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->link_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->link_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->link_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->link_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->link_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->link_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->link_id);
      }
    }

    return response()->json(array('status' => 'Ok', 'sliders' => $sliders));
  }


  public function paymentsinfo()
  {

    $data = Generalsetting::findOrFail(1);
    return response()->json(array('status' => 'Ok', 'data' => $data));
  }

  public function ProductReveiw()
  {
    $reviews =  DB::table('reviews')->get();

    return response()->json(array('status' => 'Ok', 'reviews' => $reviews));
  }
  public function addProductReveiw(Request $request)
  {



    $user = Auth::guard('api')->user();
    $reviews =  Review::where('user_id', Auth::guard('api')->user()->id)->first();
    if ($reviews) {
      $reviews->details = $request->text;
      $reviews->details_ar = $request->text;
      $reviews->update();
      return response()->json(array('status' => 'Ok', 'reviews' => "review updated"));
    } else {
      $reviews = new Review;
      $reviews->user_id = Auth::guard('api')->user()->id;
      $reviews->title = Auth::guard('api')->user()->name;
      $reviews->details_ar = $request->text;
      $reviews->details = $request->text;
      $reviews->title_ar = Auth::guard('api')->user()->name;
      $reviews->subtitle = "Client";
      $reviews->subtitle_ar = "عميل";
      $reviews->save();
      return response()->json(array('status' => 'Ok', 'reviews' => "review added"));
    }
  }


  public function autosearch(Request $request)
  {
    $slug = $request->search;

    if (strlen($slug) > 1) {
      $search = ' ' . $slug;


      $prods = Product::where('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->orWhere('name_ar', 'like', $slug . '%')->where('status', '=', 1)->take(10)->get();
      return response()->json(array('status' => 'Ok', 'products' => $prods));
    }
  }


  public function categoryy(Request $request, $slug = null, $slug1 = null, $slug2 = null)
  {

    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
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
    }

    $prods = Product::when($cat, function ($query, $cat) {
      return $query->where('category_id', $cat->id);
    })
      ->when($subcat, function ($query, $subcat) {
        return $query->where('subcategory_id', $subcat->id);
      })
      ->when($childcat, function ($query, $childcat) {
        return $query->where('childcategory_id', $childcat->id);
      })
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
    $prods = (new Collection(Product::filterProducts($prods)))->get();

    $data['prods'] = $prods;

    if ($request->ajax()) {

      $data['ajax_check'] = 1;

      return response()->json(array('status' => 'Ok', 'data' => $data));
    }
    return response()->json(array('status' => 'Ok', 'data' => $data));
  }

  public function category(Request $request)
  {
    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }
    $cats = Category::where('status', 1)->get();
    $price = number_format(DB::table('products')->max('mobile_price') * $currency->value, 2);

    return response()->json(array('status' => 'Ok', 'category' => $cats, 'maxprice' => $price));
  }
  public function subcategory($id)
  {
    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }
    $subcategories = Subcategory::where('category_id',  $id)->where('status', 1)->get();

    $price = number_format(DB::table('products')->max('mobile_price') * $currency->value, 2);

    return response()->json(array('status' => 'Ok', 'subcategory' => $subcategories, 'maxprice' => $price));
  }
  public function childcategory($id)
  {

    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }
    $subcategories = Childcategory::where('subcategory_id',  $id)->where('status', 1)->get();

    $price = number_format(DB::table('products')->max('mobile_price') * $currency->value, 2);

    return response()->json(array('status' => 'Ok', 'childcategory' => $subcategories, 'maxprice' => $price));
  }

  public function brandss(Request $request)
  {

    $brands = Brand::where('status', 1)->select('id', 'name', 'name_ar', 'status', 'photo')->get();
    $price = number_format(DB::table('products')->max('mobile_price'), 2);

    return response()->json(array('status' => 'Ok', 'brands' => $brands, 'maxprice' => $price));
  }


  public function getsubs(Request $request)
  {
    $subcategories = Subcategory::where('category_id',  $request->category_id)->get();
    if (Auth::guard('api')->user()) {
      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }



    foreach ($subcategories as $k => $sub) {


      $subcategories[$k]['product'] =  Product::with(['category' => function ($query) {
        $query->select('id', 'photo');
      }])->with(['user' => function ($query) {
        $query->select('id', 'name');
      }])->with(['brand' => function ($query) {
        $query->select('id', 'name');
      }])->with(['ratings' => function ($query) {
        $query->select('review', 'rating');
      }])->with(['mobilegalleries' => function ($query) {
        $query->select('id', 'photo');
      }])->where('subcategory_id', '=', $sub->id)->orderBy('id', 'desc')->get();
      $count = count($subcategories[$k]['product']);
      foreach ($subcategories[$k]['product']  as $kp => $product) {



        $subcategories[$k]['product'][$kp]['currency_ar']  = $currency['name_ar'];
        $subcategories[$k]['product'][$kp]['currency_en'] = $currency['name'];
        $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
        if ($product->previous_price) {
          $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
          $product['discount'] = 0;
        } else {
          $product['discount'] = 0;
        }
        if ($product['products']['like_status'] == 0) {
          $products[$kp]['like_status'] = "false";
        } else {
          $products[$kp]['like_status'] = "true";
        }
      }
    }

    return response()->json(array('status' => 'Ok', 'subcategory' => $subcategories));
  }




  public function getProductBysubCategory(Request $request)
  {
    $subcategories = Subcategory::where('id',  $request->subcategory_id)->first();



    $productsall =  $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('subcategory_id', '=', $subcategories->id)->where('status', 1)->orderBy('id', 'desc')->get();
    $count = count($productsall);
    foreach ($productsall as $kp => $product) {
      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $products[$kp]['currency_ar'] = $currency['name_ar'];
      $products[$kp]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
      // if($product['products']['like_status'] == 0){
      //       $products[$kp]['like_status'] = "false";

      //   }else{
      //       $products[$kp]['like_status'] = "true";

      //   }

    }


    return response()->json(array('status' => 'Ok', 'subcategory' => $subcategories, 'product' => $products, "product_count" => $count));
  }


  public function allProducts()
  {


    $productsall =  $products =  Product::select('id', 'name', 'name_ar')->where('status', '=', 1)->orderBy('id', 'desc')->get();




    return response()->json($productsall);
  }

  public function myFavoriteProduct()
  {

    $wishes = Wishlist::select("products.*")->where('wishlists.user_id', '=', Auth::guard('api')->user()->id)
      ->join('products', "wishlists.product_id", "=", "products.id")
      ->get();

    $currency = Currency::find(Auth::guard('api')->user()->currency);

    // $wishes= json_decode($wishes,true);

    foreach ($wishes as $k => $v) {
      $v['price'] =  $v['price'] * $currency['value'];
      $v['mobile_price']  = number_format($v['mobile_price'] * $currency['value'], 2);
      if ($v['previous_price']) {
        $v['previous_price']  = number_format($v['previous_price'] * $currency['value'], 2);
        $v['discount'] = 0;
      } else {
        $v['discount'] = 0;
      }
      $v['currency_ar'] = $currency['name_ar'];
      $v['currency_en'] = $currency['name'];
      $v['currency_sign'] = $currency['sign'];
    }

    return response()->json(array('status' => 'Ok', 'product' => $wishes));
  }


  public function getcategory(Request $request)
  {
    $category = Category::where('id', $request->id)->where('status', 1)->get();
    //   $subcategories = Subcategory::where('category_id',  $request->category)->get();
    return $category;
  }


  public function faq()
  {
    // $this->code_image();
    if (DB::table('generalsettings')->find(1)->is_faq == 0) {
      // return redirect()->back();
      return response()->json(array('status' => 'Ok', 'faqs' => 'not found'));
    }
    $faq =  DB::table('faqs')->where('status', 1)->orderBy('id', 'desc')->get();
    // $faq=	json_decode($faq, true);
    foreach ($faq as $k => $f) {
      $faqs[$k]['id'] = $f->id;
      $faqs[$k]['title'] = $f->title;
      $faqs[$k]['title_ar'] = $f->title_ar;
      $faqs[$k]['details'] = str_replace('&nbsp;', ' ', strip_tags($f->details));
      $faqs[$k]['details_ar'] = str_replace('&nbsp;', ' ', strip_tags($f->details_ar));
      $faqs[$k]['status'] = $f->status;
    }
    return response()->json(array('status' => 'Ok', 'faqs' => $faqs));
  }

  public function brands()
  {
    $brands =  DB::table('brands')->where('status', 1)->get();
    return response()->json(array('status' => 'Ok', 'brands' => $brands));
  }


  public function Useraddress($userid)
  {
    $address =  DB::table('addresses')->where('user_id', '=', $userid)->get();
    return response()->json(array('status' => 'Ok', 'address' => $address));
  }

  public function AddUseraddress(Request $request)
  {

    $address = new Address;
    $user_id = Auth::guard('api')->user()->id;
    $address->user_id = $user_id;
    $address->country = $request->country;
    $address->city = $request->city;
    $address->address = $request->address;
    $address->phone = $request->phone;
    $address->street_name = $request->street_name;
    $address->floor_number = $request->floor_number;
    $address->flat_num = $request->flat_num;
    $address->defaultt = $request->defaultt;
    $address->building_number = $request->building_number;
    $address->area = $request->area;
    $address->code  = $request->code;
    $address->title = $request->title;
    $address->mobile = $request->mobile;
    $address->location_by_gps = $request->location_by_gps;

    $address->save();
    if ($address->defaultt == 1) {
      Address::where('id', '!=', $address->id)->where('user_id', Auth::guard('api')->user()->id)->update(['defaultt' => 0]);
    }


    return response()->json(array('status' => 'Ok', 'message' => "add success"));
  }
  public function UpdateUseraddress(Request $request)
  {
    $address =  Address::findOrFail($request->id);
    $address->country = $request->country;
    $address->city = $request->city;
    $address->address = $request->address;
    $address->phone = $request->phone;
    $address->street_name = $request->street_name;
    $address->floor_number = $request->floor_number;
    $address->flat_num = $request->flat_num;
    $address->defaultt = $request->defaultt;
    $address->building_number = $request->building_number;
    $address->area = $request->area;
    $address->code  = $request->code;
    $address->title = $request->title;
    $address->mobile = $request->mobile;
    $address->location_by_gps = $request->location_by_gps;

    $address->update();
    if ($request->defaultt == 1) {
      Address::where('id', '!=', $request->id)->where('user_id', Auth::guard('api')->user()->id)->update(['defaultt' => 0]);
    }


    return response()->json(array('status' => 'Ok', 'message' => "update success"));
  }
  public function DeleteUseraddress($addressid)
  {
    $address =  Address::findOrFail($addressid);
    $address->delete();

    return response()->json(array('status' => 'Ok', 'message' => "deleted success"));
  }


  public function comment(Request $request)
  {
    $comment = new Comment;
    $input = $request->all();
    $comment->fill($input)->save();
    // $comments = Comment::where('product_id','=',$request->product_id)->get()->count();
    // $data[0] = $comment->user->photo ? url('assets/images/users/'.$comment->user->photo):url('assets/images/noimage.png');
    // $data[1] = $comment->user->name;
    // $data[2] = $comment->created_at->diffForHumans();
    // $data[3] = $comment->text;
    // $data[4] = $comments;
    // $data[5] = route('product.comment.delete',$comment->id);
    // $data[6] = route('product.comment.edit',$comment->id);
    // $data[7] = route('product.reply',$comment->id);
    // $data[8] = $comment->user->id;
    if ($comment) {
      return response()->json(array('status' => 'Ok', 'success' => "comment success"));
    } else {
      return response()->json(array('status' => 'Ok', 'error' => "comment error"));
    }
  }

  public function commentedit(Request $request)
  {
    $comment = Comment::findOrFail($request->id);
    $comment->text = $request->text;
    $comment->update();
    return response()->json($comment->text);
  }

  public function commentdelete($id)
  {
    $comment = Comment::findOrFail($id);
    if ($comment->replies->count() > 0) {
      foreach ($comment->replies as $reply) {
        $reply->delete();
      }
    }
    $comment->delete();
  }

  public function testimonial()
  {
    $review = Review::get();
    return response()->json(array('status' => 'Ok', 'Review' => $review));
  }
  public function Country()
  {
    $review = Country::where('status', 1)->get();
    return response()->json(array('status' => 'Ok', 'Country' => $review));
  }
  public function city($id)
  {
    $review = Zone::where('status', 1)->where('country_id', $id)->get();
    return response()->json(array('status' => 'Ok', 'City' => $review));
  }


  public function currencies()
  {
    $currencies = Currency::get();
    return response()->json(array('status' => 'Ok', 'currencies' => $currencies));
  }
  public function setcurrencies($id)
  {

    $c = Currency::find($id);
    if ($c) {
      $user = User::find(Auth::guard('api')->user()->id);
      $user->currency = $id;
      $user->save();

      $currencies = Currency::find($user->currency);


      return response()->json(array('status' => 'Ok',  'currencies' => $currencies));
    } else {

      return response()->json(array('status' => 'false',  'currencies' => "caurrency not availiable"));
    }
  }

  public function ads()
  {
    $ads = ads::get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';

        $slide['link'] = url('api/ProductBySubcategory/' . $slide->link_id);
      } else {
        $slide['type'] = 'offer_page';
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'ads' => $ads));
  }

  public function banners()
  {
    $ads = ads::take(3)->get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'ads' => $ads));
  }

  public function banner1()
  {
    $ads = ads::skip(3)->take(1)->get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'banner1' => $ads));
  }
  public function banner2()
  {
    $ads = ads::skip(4)->take(1)->get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'banner2' => $ads));
  }
  public function banner3()
  {
    $ads = ads::skip(5)->take(1)->get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'banner3' => $ads));
  }
  public function banner4()
  {
    $ads = ads::skip(6)->take(1)->get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'banner4' => $ads));
  }

  public function banner5()
  {
    $ads = ads::skip(7)->take(1)->get();

    foreach ($ads as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $link = Product::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $link = Category::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $link = Brand::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } elseif ($slide->linked == 4) {
        $slide['type'] = 'subcategory';
        $link = Subcategory::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $link = Offer::find($slide->linked_id);
        $slide['title'] = !empty($link) ? $link->name : " ";
        $slide['title_ar'] = !empty($link) ? $link->name_ar : " ";
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }
    return response()->json(array('status' => 'Ok', 'banner5' => $ads));
  }

  public function notificationsid($id)
  {
    $ads = Notifications::where('user_id', Auth::guard('api')->user()->id)->where('id', $id)->first();
    $ads->read_at = Carbon::now();
    $ads->save();
    if ($ads->save()) {
      return response()->json(array('status' => 'Ok', 'read' => 1));
    } else {
      return response()->json(array('status' => 'Ok', 'read' => 0));
    }
  }


  public function notifications()
  {
    $ads = Notifications::where('user_id', Auth::guard('api')->user()->id)->orwhere('user_id', null)->orderby('id', 'DESC')->take(10)->get();

    foreach ($ads as $slide) {

      $slide['read'] = !empty($slide->read_at) ? 1 : 0;
      if ($slide->linked == 1) {


        //    $link = Product::find($slide->linked_id);
        //     $slide['name'] = !empty($link) ? $link->name : " " ;
        //     $slide['name_ar'] = !empty($link) ? $link->name_ar : " " ;

        if ($slide->type == "link") {
          $slide['type'] = 'product';
          $slide['link'] = url('api/product/' . $slide->linked_id);
        }
      } elseif ($slide->linked == 2) {

        //    $link = Category::find($slide->linked_id);
        //    $slide['name'] = !empty($link) ? $link->name : " " ;
        //      $slide['name_ar'] = !empty($link) ? $link->name_ar : " " ;
        if ($slide->type == "link") {
          $slide['type'] = 'category';
          $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
        }
      } elseif ($slide->linked == 3) {

        //      $link = Brand::find($slide->linked_id);
        //   $slide['name'] = !empty($link) ? $link->name : " " ;
        //    $slide['name_ar'] = !empty($link) ? $link->name_ar : " " ;
        if ($slide->type == "link") {
          $slide['type'] = 'brand';
          $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
        }
      } elseif ($slide->linked == 4) {

        //    $link = Subcategory::find($slide->linked_id);
        //    $slide['name'] = !empty($link) ? $link->name : " " ;
        //      $slide['name_ar'] = !empty($link) ? $link->name_ar : " " ;
        if ($slide->type == "link") {
          $slide['type'] = 'subcategory';
          $slide['link'] = url('api/ProductBySubcategory/' . $slide->linked_id);
        }
      } else {

        //   $link = Offer::find($slide->linked_id);
        //  $slide['name'] = !empty($link) ? $link->name : " " ;
        //    $slide['name_ar'] = !empty($link) ? $link->name_ar : " " ;
        if ($slide->type == "link") {
          $slide['type'] = 'offer_page';
          $slide['link'] = url('api/offerpage/' . $slide->linked_id);
        }
      }
    }
    return response()->json(array('status' => 'Ok', 'notifications' => $ads));
  }
  public function ratingByProduct($product_id)
  {
    $rates = ratings::select("ratings.*", "users.photo", "users.name")
      ->join("users", "ratings.user_id", "=", "users.id")
      ->where('product_id', '=', $product_id)
      ->get();

    $ratings = [];
    //  $ratings["zero"] = ratings::where('product_id', '=', $product_id)->where('rating',0)->count() ;
    $ratings['_num_1'] = ratings::where('product_id', '=', $product_id)->where('rating', 1)->count();
    $ratings['_num_2'] = ratings::where('product_id', '=', $product_id)->where('rating', 2)->count();
    $ratings['_num_3'] = ratings::where('product_id', '=', $product_id)->where('rating', 3)->count();
    $ratings['_num_4'] = ratings::where('product_id', '=', $product_id)->where('rating', 4)->count();
    $ratings['_num_5'] = ratings::where('product_id', '=', $product_id)->where('rating', 5)->count();
    // $rate =  json_decode($ratings, true);
    $rate =  array_count_values($ratings);
    return response()->json(array('status' => 'Ok', 'ratings_stars' => $ratings, 'rate' => $rates));
  }
  public function allrate()
  {
    $rates = ratings::select("ratings.*", "users.photo", "users.name")
      ->join("users", "ratings.user_id", "=", "users.id")
      ->join("products", "ratings.product_id", "=", "products.id")

      ->get();

    foreach ($rates as $rate) {
      $pro = Product::select('id', 'name', 'name_ar', 'mobile_price', 'mobile_photo', 'photo')->where('id', $rate->product_id)->first();
      if ($pro) {
        $rate['product'] = $pro;
        $rate['product']['mobile_photo'] = !empty($pro->mobile_photo) ? $pro->mobile_photo : $pro->photo;

        $count = Colike::where('rate_id', '=', $rate->id)->count();
        $like = Colike::where('rate_id', '=', $rate->id)->first();
        if ($like) {

          $rate['like'] = "true";
        } else {
          $rate['like']  = 'false';
        }

        $rate['count']  = $count;
      }
    }

    return response()->json(array('status' => 'Ok', 'rate' => $rates));
  }




  public function addRating(Request $request)
  {


    $ratings =  new ratings;
    $ratings->user_id = Auth::guard('api')->user()->id;
    $ratings->product_id = $request->product_id;
    $ratings->review = $request->review;
    $ratings->rating = $request->rating;
    // $ratings->review_date = $request->review_date;

    $ratings->save();

    return response()->json(array('status' => 'Ok', 'message' => "add review"));
  }
  public function addcomment($pro_id, Request $request)
  {

    $check = Comment::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $pro_id)->first();
    if (!empty($check)) {

      return response()->json(array('status' => 'true', 'message' => "U already have comment"));
    } else {

      $item = new Comment();
      //  $user = User::find(Auth::guard('api')->user()->id);

      $item->user_id = Auth::guard('api')->user()->id;
      $item->product_id = $pro_id;
      $item->text = $request->text;
      $item->save();

      return response()->json(array('status' => 'true', 'message' => "Liked"));
    }
  }
  public function allcomment()
  {

    $check = Comment::with('replies')->get();


    return response()->json(array('status' => 'true', 'comments' => $check));
  }

  public function policy()
  {

    $check = Generalsetting::select(['policy', 'policy_ar'])->find(1);


    return response()->json(array('status' => 'true', 'policy' => $check));
  }


  public function colikes($rate_id)
  {

    $check = Colike::where('user_id', '=', Auth::guard('api')->user()->id)->where('rate_id', '=', $rate_id)->first();
    if (!empty($check)) {
      $check->delete();
      return response()->json(array('status' => 'true', 'message' => "Unliked"));
    } else {

      $item = new Colike();
      //  $user = User::find(Auth::guard('api')->user()->id);

      $item->user_id = Auth::guard('api')->user()->id;
      $item->rate_id = $rate_id;
      $item->save();

      return response()->json(array('status' => 'true', 'message' => "Liked"));
    }
  }
  public function prolikes($pro_id)
  {

    $check = Like::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $pro_id)->first();
    if (!empty($check)) {
      $check->delete();
      return response()->json(array('status' => 'true', 'message' => "Unliked"));
    } else {

      $item = new Like();
      //  $user = User::find(Auth::guard('api')->user()->id);

      $item->user_id = Auth::guard('api')->user()->id;
      $item->product_id = $pro_id;
      $item->save();

      return response()->json(array('status' => 'true', 'message' => "Liked"));
    }
  }
  public function GetAllCategoryAndSub()
  {
    // $categories = category::select("categories.name as catname","categories.name_ar as catname_ar","categories.photo as carphoto","subcategories.name as subname","subcategories.name_ar as subname_ar","childcategories.name as chhildname","childcategories.name_ar as childname_ar")
    // ->join("subcategories","subcategories.category_id","=","categories.id")
    // ->join("childcategories","subcategories.id","=","childcategories.subcategory_id")
    // ->get();
    $categories = category::where('status', 1)->get();
    foreach ($categories as $k => $cat) {
      $res[$k]['id'] = $cat->id;
      $res[$k]['name'] = $cat->name;
      $res[$k]['name_ar'] = $cat->name_ar;
      $res[$k]['photo'] = $cat->photo;
      $res[$k]['sub'] = subcategory::where("category_id", $cat->id)->where('status', 1)->get();
      $sub =  $res[$k]['sub'];
      $count = count($sub);
      // foreach($sub as $key => $value){

      for ($i = 0; $i < $count; $i++) {
        $prodctbysub = product::where("subcategory_id", $res[$k]['sub'][$i]->id)->where('status', 1)->get();
        $res[$k]['sub'][$i]['total_product'] =  count($prodctbysub);

        // $res[$k]['sub'][$i]['total_product'] = '';

      }
    }

    return response()->json(array('status' => 'Ok', 'categories' => $res));
  }
  public function pages()
  {

    $categories = Page::get();
    foreach ($categories as $k => $f) {
      $faqs[$k]['id'] = $f->id;
      $faqs[$k]['title'] = $f->title;
      $faqs[$k]['title_ar'] = $f->title_ar;
      $faqs[$k]['details'] = str_replace('&nbsp;', ' ', strip_tags($f->details));
      $faqs[$k]['details_ar'] = str_replace('&nbsp;', ' ', strip_tags($f->details_ar));
    }


    return response()->json(array('status' => 'Ok', 'pages' => $faqs));
  }

  public function blogcategories()
  {

    $categories = BlogCategory::get();


    return response()->json(array('status' => 'Ok', 'categories' => $categories));
  }

  public function blogs($id)
  {

    $categories = Blog::where('category_id', $id)->get();


    return response()->json(array('status' => 'Ok', 'blogs' => $categories));
  }
  public function blog($id)
  {

    $categories = Blog::where('id', $id)->first();
    $categories->views +=  1;
    $categories->save();

    $related_blog =  Blog::where('category_id', $categories->category_id)->where('id', '!=', $id)->take(5)->get();

    return response()->json(array('status' => 'Ok', 'blog' => $categories, 'related_blogs' => $related_blog));
  }



  public function contact()
  {

    $categories = Pagesetting::select(['contact_success', 'contact_success_ar', 'contact_email', 'street', 'street_ar', 'phone', 'fax'])->get();


    return response()->json(array('status' => 'Ok', 'contact' => $categories));
  }

  public function contactsave()
  {



    if (Auth::guard('api')->user()) {
      $categories = new AdminUserConversation;
      $categories->user_id = Auth::guard('api')->user()->id;
      $categories->message = $request->text;
      $categories->subject = $request->subject;
      $categories->type = 'Contact';
      $categories->save();
    } else {
      $categories = new AdminUserConversation;
      $categories->phone = $request->phone;
      $categories->email = $request->email;
      $categories->message = $request->text;
      $categories->subject = $request->subject;
      $categories->type = 'Contact';
      $categories->save();
    }

    return response()->json(array('status' => 'Ok', 'contact' => $categories));
  }


  public function contactemail(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'subject' => 'required',
      'message' => 'required',

    ]);


    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }
    $gs = Generalsetting::findOrFail(1);

    $email = $gs->email;
    $to = $request->name;
    $name = $request->name;
    $subject = $request->subject;
    $msg =  'from' . $name . '<br>' . $request->message;

    //Sending Email To Customer
    if ($gs->is_smtp == 1) {
      $data = [
        'to' => $email,
        'subject' => $subject,
        'body' => $msg,
      ];

      $mailer = new GeniusMailer();
      $mailer->sendCustomMail($data);
    } else {
      $headers = "From: " . $name . "<" . $to . ">";
      mail($email, $subject, $msg, $headers);
    }


    return response()->json(array('status' => 'Ok', 'contact' => 'message has been sent'));
  }


  /* Paginate functions */

  public function ProductByBrandp($id)
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('brand_id', '=', $id)->orderBy('id', 'desc')->paginate(10);


    $brand = Brand::find($id)->photo;


    foreach ($products as $k => $product) {
      //     $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();  
      //   if($favorite_status){
      //   // $favorite_status = "true";
      //   $products[$k]['favorite_status'] = "true";
      //   }else{
      //     $products[$k]['favorite_status']  = 'false';
      //   }

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $products[$k]['currency_ar'] = $currency['name_ar'];
      $products[$k]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    //   $products = Product::where('brand_id','=',$id)->where('status','=',1)->get();

    return response()->json(array('status' => 'Ok', 'products' => $products, 'photo' => $brand));
  }



  public function ProductByCategoryp($id)
  {
    $latest_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('category_id', '=', $id)->where('status', '=', 1)->orderBy('id', 'desc')->paginate(10);

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {


      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();



      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';

      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products));
  }


  public function ProductByChildcategoryp($id)
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['subcategory' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('childcategory_id', '=', $id)->orderBy('id', 'desc')->paginate(10);
    foreach ($products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $products[$k]['currency_ar'] = $currency['name_ar'];
      $products[$k]['currency_en'] = $currency['name'];


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();
      $product['mobile_price']  = round($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = round($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }
    return response()->json(array('status' => 'Ok', 'products' => $products));
  }


  public function ProductHotp()
  {
    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->paginate(10);



    //   $products = Product::where('hot','=',1)->where('status','=',1)->get();
    foreach ($products as $k => $product) {


      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $product['currency_en'] = $currency->name;
      $product['currency_ar'] = $currency->name_ar;
      $product['currency_value'] = $currency->value;
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $products));
  }


  public function ProductBestp()
  {

    $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->paginate(10);




    //   $products = Product::where('best','=',1)->where('status','=',1)->get();
    foreach ($products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();
      $product['currency_en'] = $currency->name;
      $product['currency_ar'] = $currency->name_ar;
      $product['currency_value'] = $currency->value;
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $products));
  }




  public function LatestProductp(Request $request)
  {

    $latest_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->paginate(10);

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {
      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();

      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    $adds = ads::take(3)->get();
    foreach ($adds as $slide) {
      if ($slide->linked == 1) {

        $slide['type'] = 'product';
        $slide['link'] = url('api/product/' . $slide->linked_id);
      } elseif ($slide->linked == 2) {
        $slide['type'] = 'category';
        $slide['link'] = url('api/ProductByCategory/' . $slide->linked_id);
      } elseif ($slide->linked == 3) {
        $slide['type'] = 'brand';
        $slide['link'] = url('api/filterBrand/' . $slide->linked_id);
      } else {
        $slide['type'] = 'offer_page';
        $slide['link'] = url('api/offerpage/' . $slide->linked_id);
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products, 'ads' => $adds));
  }


  public function TrendingProductp()
  {

    // $trending_products =  Product::where('trending','=',1)->where('status','=',1)->orderBy('id','desc')->take(9)->get();

    $trending_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->paginate(10);




    foreach ($trending_products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();
      $product['currency_en'] = $currency->name;
      $product['currency_ar'] = $currency->name_ar;
      $product['currency_value'] = $currency->value;
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $trending_products));
  }



  public function SaleProductp()
  {

    $latest_products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->paginate(10);

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {
      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }
      $product['likes'] = Like::where('product_id', '=', $product->id)->count();


      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];

      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products));
  }

  public function getProductBysubCategoryp(Request $request)
  {
    $subcategories = Subcategory::where('id',  $request->subcategory_id)->first();



    $productsall =  $products =  Product::with(['category' => function ($query) {
      $query->select('id', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name');
    }])->with(['ratings' => function ($query) {
      $query->select('review', 'rating');
    }])->with(['mobilegalleries' => function ($query) {
      $query->select('id', 'photo');
    }])->where('subcategory_id', '=', $subcategories->id)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
    $count = count($productsall);
    foreach ($productsall as $kp => $product) {
      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }




      $products[$kp]['currency_ar'] = $currency['name_ar'];
      $products[$kp]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
      // if($product['products']['like_status'] == 0){
      //       $products[$kp]['like_status'] = "false";

      //   }else{
      //       $products[$kp]['like_status'] = "true";

      //   }

    }


    return response()->json(array('status' => 'Ok', 'subcategory' => $subcategories, 'product' => $products, "product_count" => $count));
  }

  public function myFavoriteProductp()
  {

    $wishes = Wishlist::select("products.*")->where('wishlists.user_id', '=', Auth::guard('api')->user()->id)
      ->join('products', "wishlists.product_id", "=", "products.id")
      ->paginate(10);

    $currency = Currency::find(Auth::guard('api')->user()->currency);

    // $wishes= json_decode($wishes,true);

    foreach ($wishes as $k => $v) {
      $v['price'] =  $v['price'] * $currency['value'];
      $v['mobile_price']  = number_format($v['mobile_price'] * $currency['value'], 2);
      if ($v['previous_price']) {
        $v['previous_price']  = number_format($v['previous_price'] * $currency['value'], 2);
        $v['discount'] = 0;
      } else {
        $v['discount'] = 0;
      }
      $v['currency_ar'] = $currency['name_ar'];
      $v['currency_en'] = $currency['name'];
      $v['currency_sign'] = $currency['sign'];
    }

    return response()->json(array('status' => 'Ok', 'product' => $wishes));
  }

  public function ProductSearchp($slug = null)
  {
    if (strlen($slug) >= 1) {
      $search = ' ' . $slug;
      $prods = Product::where('name', 'like', '%' . $search . '%')->orWhere('name_ar', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->orWhere('name_ar', 'like', $slug . '%')->where('status', '=', 1)->paginate(10);
      // return view('load.suggest',compact('prods','slug'));



      if (count($prods) > 0) {


        foreach ($prods as $product) {
          if (Auth::guard('api')->user()) {

            $currency = Currency::find(Auth::guard('api')->user()->currency);
            $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
            if ($favorite_status) {
              // $favorite_status = "true";
              $product['favorite_status'] = "true";
            } else {
              $product['favorite_status']  = 'false';
            }
            $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
            if ($like) {
              $product['like_status'] = "true";
            } else {
              $product['like_status'] = "false";
            }
          } else {

            $currency = Currency::where('is_default', 1)->first();
            $product['like_status'] = "false";
            $product['favorite_status']  = 'false';
          }




          $product['price'] = round($product->price / $currency->value);
          $category = category::where('id', $product->category_id)->first();
          $brand = Brand::where('id', $product->brand_id)->first();
          $photo = Gallery::where('product_id', $product->id)->where('web', 0)->get();
          $size = Color::where('product_id', $product->id)->get();

          $product['brand'] = $brand->name;
          $product['category'] = $category->name;
          $product['gallery'] = $photo;
          if (empty($product->size)) {
            $product['sizes'] = Color::where('product_id', $product->id)->get();
          } else {
            $product['sizes'] = $product->size;
          }
          $product['link'] = url('api/product/' . $product->id);
          $product['currency_en'] = $currency->name;
          $product['currency_ar'] = $currency->name_ar;
          $product['currency_value'] = $currency->value;

          $product['mobile_price']  = round($product->mobile_price * $currency['value'], 2);
          if ($product->previous_price) {
            $product['previous_price']  = round($product->previous_price * $currency['value'], 2);

            $product['discount'] = 0;
          } else {
            $product['discount'] = 0;
          }

          $product['likes'] = Like::where('product_id', '=', $product->id)->count();
        }


        return response()->json(array('status' => 'Ok', 'products' => $prods, 'slug' => $slug));
      } else {

        return response()->json(array('status' => 'Ok', 'products' => [], 'slug' => $slug));
      }
    }
    return response()->json(array('status' => 'Ok', 'products' => [], 'slug' => ' '));
  }


  public function offerpagep($id)
  {

    $pro = OfferProduct::with('products')->where('offer_id', $id)->pluck('product_id');



    $latest_products =   Product::whereIn('id', $pro)->paginate(10);

    //   dd($latest_products);




    foreach ($latest_products as $k => $product) {

      if (Auth::guard('api')->user()) {

        $currency = Currency::find(Auth::guard('api')->user()->currency);
        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {

        $currency = Currency::where('is_default', 1)->first();
        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['likes'] = Like::where('product_id', '=', $product->id)->count();



      $offer = OfferProduct::where('product_id', '=',  $product->id)->first();
      if ($offer) {
        $latest_products[$k]['Offer'] =  Offer::where('id', '=', $offer->offer_id)->first();
      } else {
        $latest_products[$k]['Offer'] = '';
      }




      //   $products[$k]['currency_ar'] = 'hhh';

      $latest_products[$k]['currency_ar'] = $currency['name_ar'];
      $latest_products[$k]['currency_en'] = $currency['name'];
      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);

        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }

    return response()->json(array('status' => 'Ok', 'products' => $latest_products));
  }


  public function filterp(Request $data)
  {


    if (Auth::guard('api')->user()) {

      $currency = Currency::find(Auth::guard('api')->user()->currency);
    } else {

      $currency = Currency::where('is_default', 1)->first();
    }

    $cat = null;
    $subcat = null;
    $childcat = null;
    $minprice = $data['min'] / $currency->value;
    $maxprice = $data['max'] / $currency->value;
    $brands = $data['brands'];
    $cats = $data['cats'];
    $atrr = $data['atrr'];
    if ($brands) {
      $brands = array_map(
        function ($value) {
          return (int)$value;
        },
        $brands
      );
    }

    if ($cats) {
      $cats = array_map(
        function ($cat) {
          return (int)$cat;
        },
        $cats
      );
    }

    if ($atrr) {
      $atrr = array_map(
        function ($catt) {
          return (int)$catt;
        },
        $atrr
      );
    }
    $sort = $data->sort;


    $products = Product::with(['category' => function ($query) {
      $query->select('id', 'name', 'name_ar', 'photo');
    }])->with(['user' => function ($query) {
      $query->select('id', 'name');
    }])->with(['brand' => function ($query) {
      $query->select('id', 'name', 'name_ar');
    }])->with(['size' => function ($query) {
      $query->select('id', 'size', 'colors', 'size_qty', 'size_price');
    }])->select('id', 'name', 'name_ar', 'sku', 'mobile_photo', 'photo', 'price', 'mobile_price', 'previous_price', 'stock', 'views', 'size', 'category_id', 'user_id', 'brand_id')

      ->when($minprice, function ($query, $minprice) {
        return $query->where('mobile_price', '>=', $minprice);
      })
      ->when($maxprice, function ($query, $maxprice) {
        return $query->where('mobile_price', '<=', $maxprice);
      })

      ->when($brands, function ($query, $brands) {
        return $query->whereIn('brand_id',  $brands);
      })
      ->when($cats, function ($query, $cats) {
        return $query->whereIn('category_id',  $cats);
      })

      ->when($sort, function ($query, $sort) {
        if ($sort == 'date_desc') {
          return $query->orderBy('id', 'DESC');
        } elseif ($sort == 'date_asc') {
          return $query->orderBy('id', 'ASC');
        } elseif ($sort == 'price_desc') {
          return $query->orderBy('mobile_price', 'DESC');
        } elseif ($sort == 'price_asc') {
          return $query->orderBy('mobile_price', 'ASC');
        } elseif ($sort == 'popular') {
          return $query->orderBy('views', 'desc');
        }
      })
      ->when(empty($sort), function ($query, $sort) {
        return $query->orderBy('id', 'DESC');
      });

    $products = $products->where(function ($query) use ($cats, $data) {
      $flag = 0;





      $chFilters = $data["attr"];
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
    });



    $products = $products->where('status', 1)->paginate(10);


    foreach ($products as $product) {



      if (Auth::guard('api')->user()) {


        $favorite_status = Wishlist::where('user_id', '=', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($favorite_status) {
          // $favorite_status = "true";
          $product['favorite_status'] = "true";
        } else {
          $product['favorite_status']  = 'false';
        }
        $like = Like::where('user_id', Auth::guard('api')->user()->id)->where('product_id', '=', $product->id)->first();
        if ($like) {
          $product['like_status'] = "true";
        } else {
          $product['like_status'] = "false";
        }
      } else {


        $product['like_status'] = "false";
        $product['favorite_status']  = 'false';
      }


      $product['price'] = round($product->price / $currency->value);
      // $category = category::where('id', $product->category_id)->first();
      // $brand = Brand::where('id',$category->brand_id)->first();
      $photo = Gallery::where('product_id', $product->id)->where('web', 0)->get();
      $size = Color::where('product_id', $product->id)->get();

      // $product['brand'] = $brand->name;
      $product['gallery'] = $photo;
      $product['mobile_photo'] = !empty($product['mobile_photo']) ? $product['mobile_photo'] : $product['photo'];
      if (empty($product->size)) {
        $product['sizes'] = Color::where('product_id', $product->id)->get();
      } else {
        $product['sizes'] = $product->size;
      }
      $product['link'] = url('api/product/' . $product->id);
      $product['currency'] = $currency->name;
      $product['currency_value'] = $currency->value;

      $product['mobile_price']  = number_format($product->mobile_price * $currency['value'], 2);
      if ($product->previous_price) {
        $product['previous_price']  = number_format($product->previous_price * $currency['value'], 2);
        $product['discount'] = 0;
      } else {
        $product['discount'] = 0;
      }
    }
    $prices = number_format(DB::table('products')->max('mobile_price')  * $currency->value, 2);

    return response()->json(array('status' => 'Ok', 'products' => $products, 'maxprice' => $prices));
  }

  public function Useraddressp($userid)
  {
    $address =  DB::table('addresses')->where('user_id', '=', $userid)->paginate(10);
    return response()->json(array('status' => 'Ok', 'address' => $address));
  }
}
