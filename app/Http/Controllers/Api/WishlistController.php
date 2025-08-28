<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Auth;

class WishlistController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function wishlists(Request $request)
    {
        $sort = '';
        $user = Auth::user();

        // Search By Sort

        if(!empty($request->sort))
        {
        $sort = $request->sort;
        $wishes = Wishlist::where('user_id','=',$user->id)->pluck('product_id');
        if($sort == "date_desc")
        {
        $wishlists = Product::where('status','=',1)->whereIn('id',$wishes)->orderBy('id','desc')->get();
        }
        else if($sort == "date_asc")
        {
        $wishlists = Product::where('status','=',1)->whereIn('id',$wishes)->get();
        }
        else if($sort == "price_asc")
        {
        $wishlists = Product::where('status','=',1)->whereIn('id',$wishes)->orderBy('price','asc')->get();
        }
        else if($sort == "price_desc")
        {
        $wishlists = Product::where('status','=',1)->whereIn('id',$wishes)->orderBy('price','desc')->get();
        }
        if($request->ajax())
        {
                 return response()->json(array('status' => 'Ok', 'user' => $user,'wishlists'=>$wishlists,'sort'=>$sort));

        }
                 return response()->json(array('status' => 'Ok', 'user' => $user,'wishlists'=>$wishlists,'sort'=>$sort));

        }


        $wishlists = Wishlist::where('user_id','=',$user->id)->get();
        if($request->ajax())
        {
                             return response()->json(array('status' => 'Ok', 'user' => $user,'wishlists'=>$wishlists,'sort'=>$sort));

        }
                         return response()->json(array('status' => 'Ok', 'user' => $user,'wishlists'=>$wishlists,'sort'=>$sort));

    }

    public function addwish($id)
    {
        $user = Auth::user();
        $data[0] = 0;
        $ck = Wishlist::where('user_id','=',$user->id)->where('product_id','=',$id)->get()->count();
        if($ck > 0)
        {
            return response()->json($data);
        }
        $wish = new Wishlist();
        $wish->user_id = $user->id;
        $wish->product_id = $id;
        $wish->save();
        $data[0] = 1;
        $data[1] = count($user->wishlists);
        return response()->json($data);
    }

    public function removewish($id)
    {
        $user = Auth::user();
        $wish = Wishlist::where('product_id','=',$id)->where('user_id','=',$user->id)->delete();
        // $wish->delete();
        $data[0] = 1;
        $data[1] = count($user->wishlists);
        return response()->json($data);
    }

}
