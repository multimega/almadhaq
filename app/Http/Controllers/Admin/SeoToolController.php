<?php

namespace App\Http\Controllers\Admin;


use App\Models\Seotool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\ProductClick;

class SeoToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function analytics()
    {
        $tool = Seotool::find(1);
        return view('admin.seotool.googleanalytics',compact('tool'));
    }

    public function analyticsupdate(Request $request)
    {
        $tool = Seotool::findOrFail(1);
        $tool->update($request->all());
        $msg = trans('Update Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200); 
    }  

    public function keywords()
    {
        $tool = Seotool::find(1);
        return view('admin.seotool.meta-keywords',compact('tool'));
    }

    public function keywordsupdate(Request $request)
    {
        $tool = Seotool::findOrFail(1);
        $tool->update($request->all());
         $msg = trans('Update Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);  
    }
     
    public function popular($id)
    {
        $expDate = Carbon::now()->subDays($id);
        $productss = ProductClick::whereDate('date', '>',$expDate)->get()->groupBy('product_id');
        $val = $id;
        return view('admin.seotool.popular',compact('val','productss'));
    }
    
    
     public function homeMeta() {

        
       return view('admin.seotool.home_page_meta');
    }

    public function homePageHeader() {
           $tool = Seotool::findOrFail(1);
       return view('admin.seotool.homepage_header.blade.php',compact('tool'));
    }


    public function productHeader() {
           $tool = Seotool::findOrFail(1);
       return view('admin.seotool.product_page_header',compact('tool'));
    }

   public function categoryHeader() {
        
     $tool = Seotool::findOrFail(1);
    
       return view('admin.seotool.category_page_header',compact('tool'));
    }

     public function subcategoryHeader() {
        
     $tool = Seotool::findOrFail(1);
    
       return view('admin.seotool.subcategory_page_header',compact('tool'));
    }



 public function childcategoryHeader() {
        
     $tool = Seotool::findOrFail(1);
    
       return view('admin.seotool.childcategory_page_header',compact('tool'));
    }



   public function offerHeader() {

        $tool = Seotool::findOrFail(1);
       return view('admin.seotool.offer_page_header',compact('tool'));
    }



     public function brandHeader() {

        $tool = Seotool::findOrFail(1);
       return view('admin.seotool.brand_page_header',compact('tool'));
    }




    
    
    

}
