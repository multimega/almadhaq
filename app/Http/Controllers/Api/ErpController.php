<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\NewCompare;
use App\Models\Product;
use App\Models\Color;
use App\Models\Gallery;

class ErpController extends Controller
{

    public function connection(Request $request)
    {
        
       
         $code = env('Code');
         
         if($code == $request->code){
             
               return response()->json(array('status' => true));    
               
         }else{
             
               return response()->json(array('status' => false));    
         }
         
  
    }

  public function erpcreatecategory(Request $request)
    {
        $category = [];
        
          $json = json_decode($request->cat, true);

                  foreach($json as $j){
                      
                      if($j['parent_id'] == 0){
                           $category[] = Category::create([
                              'name' => $j['name'],
                              'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                              'slug' => str_replace(' ', '-', $j['name']),
                              'slug_ar' => str_replace(' ', '-', $j['name']),
                              'erp_id' => $j['id'],
                              
                              ]);  
                      }
            
             
                   }
                   
               foreach($json as $j){
                      
                   if($j['parent_id'] != 0){
                       
                       $cat = Category::where('erp_id', $j['parent_id'])->first();
                         $category[] = Subcategory::create([
                              'name' => $j['name'],
                              'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                              'slug' => str_replace(' ', '-', $j['name']),
                              'slug_ar' => str_replace(' ', '-', $j['name']),
                              'erp_id' => $j['id'],
                              'category_id' => !empty($cat) ? $cat->id : Category::first()->id,
                              
                              ]);  
                      }
            
             
          } 
      
      
         return response()->json(array($category));  
         
   
        
  
    }
    
    
public function erpupdatecategory(Request $request)
    {
        $categories = [];
       
          $json = json_decode($request->cat, true);

                  foreach($json as $j){
                      
                                 if($j['parent_id'] == 0){ 
                                     
                                      $category = Category::where('erp_id',$j['id'])->first();
                                      
                                      
                                     if($category){
                                         
                                      $category->update([
                                          'name' => $j['name'],
                                          'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                                          'slug' => str_replace(' ', '-', $j['name']),
                                          'slug_ar' => str_replace(' ', '-', $j['name']),
                                         
                                          ]);
                                        }else{
                                            
                                            
                                          $category = Category::create([
                                          'erp_id' => $j['id'],
                                          'name' => $j['name'],
                                          'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                                          'slug' => str_replace(' ', '-', $j['name']),
                                          'slug_ar' => str_replace(' ', '-', $j['name']),
                                         
                                          ]);       
                                            
                                        }     
                                        
                                         
                                   
                                  $categories[] = $category;                 
                                          
                                 }
                  }
                      
         foreach($json as $j){
                      
                   if($j['parent_id'] != 0){
                       
                       $cat = Category::where('erp_id', $j['parent_id'])->first();
                       
                       
                       
                         $category = Subcategory::where('erp_id',$j['id'])->first();
                         
                         
                            if($category){ 
                         
                         
                         $category->update([
                              'name' => $j['name'],
                              'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                              'slug' => str_replace(' ', '-', $j['name']),
                              'slug_ar' => str_replace(' ', '-', $j['name']),
                            
                              'category_id' => !empty($cat) ? $cat->id : Category::first()->id,
                              
                              ]);  
                          
                         }else{
                             
                             
                             $category = Subcategory::create([
                                          'erp_id' => $j['id'],
                                        'name' => $j['name'],
                                          'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                                          'slug' => str_replace(' ', '-', $j['name']),
                                          'slug_ar' => str_replace(' ', '-', $j['name']),
                                        
                                          'category_id' => !empty($cat) ? $cat->id : Category::first()->id,
                              
                                          ]);     
                                         
                                           
                             
                         }     
                                         
                             
                              
                        $categories[] = $category;       
                      }
            
             
          } 
    //  \Log::info(json_encode($categories));
      
         return response()->json(array($categories));  
         
   
        
  
    }
    
    
 public function erpcreatebrand(Request $request)
    {
        $category = [];
        
          $json = json_decode($request->cat, true);

                  foreach($json as $j){
              $category[] = Brand::create([
                  'name' => $j['name'],
                  'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                  'slug' => str_replace(' ', '-', $j['name']),
                  'slug_ar' => str_replace(' ', '-', $j['name']),
                  'erp_id' => $j['id'],
                  
                  ]);
             
          }
              
      
      
         return response()->json(array($category));  
         
   
        
  
    }
    
    
public function erpupdatebrand(Request $request)
    {
        $category = [];
       
          $json = json_decode($request->cat, true);

                  foreach($json as $j){
                      
                              
                      $category = Brand::where('erp_id', $j['id'])->update([
                          'name' => $j['name'],
                          'name_ar' => !empty($j['name_ar']) ? $j['name_ar'] : $j['name'],
                          'slug' =>  str_replace(' ', '-', $j['name']),
                          'slug_ar' =>str_replace(' ', '-', $j['name']),
                        
                          ]);
                     
                  }
                      
      
      
         return response()->json(array('status' => true));  
         
   
        
  
    }
   
public function erpcreateproduct(Request $request)
    {
        $category = [];
        $pro = '';
       
          $product = json_decode($request->product, true);
          $attr = json_decode($request->attr, true);
                if($product['type'] == 'single'){
                    
                    
                      $pro = new Product();
                    $pro->type = "Physical";
                    $pro->product_type = "normal";
                    $pro->sku = $product['sku'];
                    $pro->erp_id = $product['id'];
                    $pro->photo =  $product['image_url'];
                    $pro->thumbnail =  $product['image_url'];
                    $pro->user_id = 0;
                    $pro->brand_id = !empty($product['brand']['website_brand_id']) ? $product['brand']['website_brand_id'] : null ;
                    
                         $cat =   Category::find($product['category']['website_cat_id']);
                         $first =   Category::first();
                         
                    $pro->category_id =!empty($cat) ? $cat->id : $first->id ;
                    
                       if(!empty($product['sub_category']['website_cat_id'])){
                           $subcat =   Subcategory::find($product['sub_category']['website_cat_id']);
                    } 
                         
                    $pro->subcategory_id =!empty($subcat) ? $subcat->id : null ;
                    
                    $pro->name = $product['name'];
                    $pro->name_ar = $product['name_ar'];
                    $pro->details = $product['product_description'] ;
                    $pro->details_ar = $product['product_description_ar'];
                    $pro->stock = $product['enable_stock'] == 1 ? 0 : null ;
                    $pro->slug = $product['name'].'-'.$product['sku'];
                    $pro->slug_ar = $product['name_ar'].'-'.$product['sku'];
                    
                    
                    $pro->measure = !empty($product['unit']['short_name']) ? $product['unit']['short_name'] : null; 
                    $pro->price = !empty($product['variations'][0]['sell_price_inc_tax']) ? round($product['variations'][0]['sell_price_inc_tax'] ,2) : 0; 
                    $pro->mobile_price = !empty($product['variations'][0]['sell_price_inc_tax']) ? round($product['variations'][0]['sell_price_inc_tax'] ,2) : 0; 
                 
                    $pro->previous_price = !empty($attr['previous_price'] ) ? round($attr['previous_price'],2)  : null ;
                    $pro->featured = !empty($attr['featured'] ) ? $attr['featured']  : 0;
                    $pro->best = !empty($attr['best'] ) ? $attr['best']  : 0;
                    $pro->latest = !empty($attr['latest'] ) ? $attr['latest'] : 0;
                    $pro->big = !empty($attr['big'] ) ? $attr['big']  : 0;
                    $pro->trending = !empty($attr['trending'] ) ? $attr['trending']  : 0;
                 $pro->top = !empty($attr['top'] ) ? $attr['top']  : 0;
                    $pro->hot = !empty($attr['hot'] ) ? $attr['hot'] : 0;
                       $pro->size_status = !empty($attr['size_status'] ) ? $attr['size_status'] :1;
                    $pro->sale = !empty($attr['sale'] ) ? $attr['sale'] : 0;
                    $pro->meta_description = $attr['meta_description'] ;
                    $pro->meta_description_ar = $attr['meta_description_ar'] ;    
                    $pro->youtube = $attr['youtube'] ;
                    $pro->policy = $attr['policy'] ;
                    $pro->policy_ar = $attr['policy_ar'] ;
                     $pro->save(); 
                     
                     if($pro){
              /* if(isset( $product['variations'][0]['media'] ) ){
                 
                 foreach( $product['variations'][0]['media']  as $media){
                     
                     $gal = new Gallery ;
                     $gal->product_id = $pro->id ;
                     $gal->photo = $media['display_url'] ;
                     $gal->var_id = $media['model_id'] ;
                     $gal->erp_media_id = $media['id'] ;
                     $gal->save();
                 }
                 
             }*/
                      
                         
                     }
     
                    
                    
                    
                }else{
                  
                          
                      $pro = new Product();
                    $pro->type = "Physical";
                    $pro->product_type = "normal";
                    $pro->sku = $product['sku'];
                    $pro->erp_id = $product['id'];
                    $pro->photo =  $product['image_url'];
                    $pro->thumbnail =  $product['image_url'];
                    $pro->user_id = 0;
                    $pro->brand_id = !empty($product['brand']['website_brand_id']) ? $product['brand']['website_brand_id'] : null ;
                    
                         $cat =   Category::find($product['category']['website_cat_id']);
                         $first =   Category::first();
                         
                    $pro->category_id =!empty($cat) ? $cat->id : $first->id ;
                       if(!empty($product['sub_category']['website_cat_id'])){
                           $subcat =   Subcategory::find($product['sub_category']['website_cat_id']);
                    } 
                         
                    $pro->subcategory_id =!empty($subcat) ? $subcat->id : null ;
                    
                    
                    $pro->name = $product['name'];
                    $pro->name_ar = $product['name_ar'];
                    $pro->details = $product['product_description'] ;
                    $pro->details_ar = $product['product_description_ar'];
                    $pro->stock = $product['enable_stock'] == 1 ? 0 : null ;
                    $pro->slug = $product['name'].'-'.$product['sku'];
                    $pro->slug_ar = $product['name_ar'].'-'.$product['sku'];
                    
                     $pro->measure = !empty($product['unit']['short_name']) ? $product['unit']['short_name'] : null; 
                    $pro->price = 0; 
                    $pro->mobile_price =  0; 
                 
                    $pro->previous_price = !empty($attr['previous_price'] ) ? round($attr['previous_price'],2)  : null ;
                    $pro->featured = !empty($attr['featured'] ) ? $attr['featured']  : 0;
                    $pro->best = !empty($attr['best'] ) ? $attr['best']  : 0;
                    $pro->latest = !empty($attr['latest'] ) ? $attr['latest'] : 0;
                    $pro->big = !empty($attr['big'] ) ? $attr['big']  : 0;
                    $pro->trending = !empty($attr['trending'] ) ? $attr['trending']  : 0;
                 $pro->top = !empty($attr['top'] ) ? $attr['top']  : 0;
                    $pro->hot = !empty($attr['hot'] ) ? $attr['hot'] : 0;
                       $pro->size_status = !empty($attr['size_status'] ) ? $attr['size_status'] :1;
                    $pro->sale = !empty($attr['sale'] ) ? $attr['sale'] : 0;
                    $pro->meta_description = $attr['meta_description'] ;
                    $pro->meta_description_ar = $attr['meta_description_ar'] ;    
                    $pro->youtube = $attr['youtube'] ;
                    $pro->policy = $attr['policy'] ;
                    $pro->policy_ar = $attr['policy_ar'] ;
                     $pro->save(); 
                     
                     if($pro){
       foreach($product['variations'] as $k=>$variation){
                foreach($product['product_variations'] as $temp) {
                  if($variation['product_variation_id'] == $temp['id']){
                      
                      $color = new Color; 
                       $color->product_id =  $pro->id;
                       $color->erp_var_id =  $variation['id'];
                           $color->size =  $variation['name'];
                           $color->sub_sku =  $variation['sub_sku'];
                           $color->size_qty =  0;
                          
                           $color->size_price = !empty($variation['sell_price_inc_tax']) ? round($variation['sell_price_inc_tax'] ,2) : 0; 
                         
                           $color->colors = $temp['variation_template']['color'] ;
                           $color->save();
                      
                  }  
                    
                    
                }      
                      
                      
                      
           /*   if(isset( $product['variations'][$k]['media'] ) ){
                 
                 foreach( $product['variations'][$k]['media']  as $media){
                     
                     $gal = new Gallery ;
                     $gal->product_id = $pro->id ;
                     $gal->photo = $media['display_url'] ;
                     $gal->var_id = $media['model_id'] ;
                     $gal->erp_media_id = $media['id'] ;
                     $gal->save();
                 }
                 
             } */
                      
                  }       
                         
        
                      
                         
                     }
     
                    
                  
                    
                    
                }
                     
                   $pro = Product::with('galleries','category','brand','size')->where('id',$pro->id)->first();
               

                  /*foreach($json as $j){
                      
                              
                      $category[] = $j ;
                     
                  }*/
                      
      
      
        return response()->json(array($pro));  
         
        
  
    }

public function erpopenstock(Request $request)
    {
        $pro = [];
       
          $product = json_decode($request->product, true);
          $variation = json_decode($request->vari, true);
          $qty = json_decode($request->qty, true);
          $qty_difference = json_decode($request->qty_difference, true);
          $new_quantity = json_decode($request->new_quantity, true);
 if($product['type'] == 'single'){
          $pro = Product::where('erp_id',$product['id'])->first();
            if(!empty($pro)){
                $pro->stock = $qty ;
                 $pro->save();
                
            }
     
 }else{
       $pro = Product::where('erp_id',$product['id'])->first();
            if(!empty($pro)){
                $pro->stock = $qty ;
                 $pro->save();
                
            }
               $web_color= Color::where('erp_var_id', $variation['id'])->first();
                      if(!empty($web_color)){
                          if($qty_difference == 0){
                              if($web_color->size_qty == 0){
                                  
                                  $web_color->size_qty += $new_quantity ;
                               $web_color->save();   
                              }else{
                                  
                                   $web_color->size_qty += $qty_difference ;
                               $web_color->save();     
                                  
                              }
                              
                               
                          }else{
                              
                                $web_color->size_qty += $qty_difference ;
                               $web_color->save();     
                              
                          }
                                       
                                        }
     
     
 }
                    
                 /* foreach($json as $j){
                      
                              
                      $pro = Product::where('erp_id', $j['id'])->first();
                     
                  }*/
                      
      
      
         return response()->json(array($product,$variation,$qty));  
         
   
        
  
    }
    
    public function adjustQuantity(Request $request)
    {
        $pro = [];
       
          $product = $request->product;
          $variation = $request->vari;
      
          $increment_qty = $request->increment_qty;

       $pro = Product::where('erp_id',$product)->first();
            if(!empty($pro)){
                $pro->stock += $increment_qty ;
                 $pro->save();
                
            }
               $web_color= Color::where('erp_var_id', $variation)->first();
                      if(!empty($web_color)){
                                        $web_color->size_qty += $increment_qty ;
                                        $web_color->save();  
                                        }
     
     
 
                    
               
                      
      
      
         return response()->json(array($product,$variation,$increment_qty));  
         
   
        
  
    }
    public function decreaseProductQuantity(Request $request)
    {
        $pro = [];
       
          $product = $request->product;
          $variation = $request->vari;
      
          $qty_difference = $request->qty_difference;

       $pro = Product::where('erp_id',$product)->first();
            if(!empty($pro)){
                $pro->stock -= $qty_difference ;
                 $pro->save();
                
            }
               $web_color= Color::where('erp_var_id', $variation)->first();
                      if(!empty($web_color)){
                                        $web_color->size_qty -= $qty_difference ;
                                        $web_color->save();  
                                        }
     
     
 
                    
               
                      
      
      
         return response()->json(array($product,$variation,$increment_qty));  
         
   
        
  
    }
    
      
  
  public function erpupdateproduct(Request $request)
    {
        $category = [];
        $pro = '';
       
          $product = json_decode($request->product, true);
          $attr = json_decode($request->attr, true);
          $variations_ids = json_decode($request->variations, true);
           $location = json_decode($request->location, true);
          $qty = 0 ;
           $pro = Product::where('erp_id',$product['id'])->first();
           
         
        //   \Log::info('erp_id ' .$product['id']);
       //    \Log::info('website_product_id ' .$product['website_product_id']);  
       //    \Log::info($pro);
         if(!empty($pro)){
             
             
                if($product['type'] == 'single'){
                    
                    
                 if(isset( $product['variations'][0]['variation_location_details'] ) ){
                 
                 foreach( $product['variations'][0]['variation_location_details']  as $variation_location_detail){
                     
                     if($variation_location_detail['location_id'] == $location){
                         
                       $qty += $variation_location_detail['qty_available'];
                         
                         
                     }
                     
                     
                     
                   }
                       
                       
                  }
                 
                  //  $pro->photo =  $product['image_url'];
                  //  $pro->thumbnail =  $product['image_url'];
                 
                    $pro->brand_id = !empty($product['brand']['website_brand_id']) ? $product['brand']['website_brand_id'] : null ;
                    
                     //    $cat =   Category::find($product['category']['website_cat_id']);
                      $cat =   Category::where('erp_id',$product['category']['id'])->first();
                         $first =   Category::first();
                         
                    $pro->category_id =!empty($cat) ? $cat->id : $first->id ;
                       if(!empty($product['sub_category']['website_cat_id'])){
                           $subcat =   Subcategory::find($product['sub_category']['website_cat_id']);
                    } 
                         
                    $pro->subcategory_id =!empty($subcat) ? $subcat->id : null ;
                    
                    
                    $pro->name = $product['name'];
                    $pro->name_ar = $product['name_ar'];
                    $pro->details = $product['product_description'] ;
                    $pro->details_ar = $product['product_description_ar'];
                    
                    $pro->slug = $product['name'].'-'.$product['sku'];
                    $pro->slug_ar = $product['name_ar'].'-'.$product['sku'];
                    
                       $pro->stock = $product['enable_stock'] == 1 ? !empty($qty) ? $qty : $pro->stock : null ; 
                    $pro->measure = !empty($product['unit']['short_name']) ? $product['unit']['short_name'] : null; 
                    $pro->price = !empty($product['variations'][0]['sell_price_inc_tax']) ? round($product['variations'][0]['sell_price_inc_tax'] ,2) : 0; 
                    $pro->mobile_price = !empty($product['variations'][0]['sell_price_inc_tax']) ? round($product['variations'][0]['sell_price_inc_tax'] ,2) : 0; 
                 
                    $pro->previous_price = !empty($attr['previous_price'] ) ? round($attr['previous_price'],2)  : null ;
                    $pro->featured = !empty($attr['featured'] ) ? $attr['featured']  : 0;
                    $pro->best = !empty($attr['best'] ) ? $attr['best']  : 0;
                    $pro->latest = !empty($attr['latest'] ) ? $attr['latest'] : 0;
                    $pro->big = !empty($attr['big'] ) ? $attr['big']  : 0;
                    $pro->trending = !empty($attr['trending'] ) ? $attr['trending']  : 0;
                 $pro->top = !empty($attr['top'] ) ? $attr['top']  : 0;
                    $pro->hot = !empty($attr['hot'] ) ? $attr['hot'] : 0;
                       $pro->size_status = !empty($attr['size_status'] ) ? $attr['size_status'] :1;
                    $pro->sale = !empty($attr['sale'] ) ? $attr['sale'] : 0;
                    $pro->meta_description = $attr['meta_description'] ;
                    $pro->meta_description_ar = $attr['meta_description_ar'] ;    
                    $pro->youtube = $attr['youtube'] ;
                    $pro->policy = $attr['policy'] ;
                    $pro->policy_ar = $attr['policy_ar'] ;
                     $pro->save(); 
                     
                     if($pro){
             /*  if(isset( $product['variations'][0]['media'] ) ){
                 
                 foreach( $product['variations'][0]['media']  as $media){
                      $gal  =  Gallery::where('product_id',$pro->id)->where('var_id',$media['model_id'])->where('erp_media_id',$media['id'])->first();
                     if(!$gal){
                     $gal = new Gallery ;
                     $gal->product_id = $pro->id ;
                     $gal->photo = $media['display_url'] ;
                     $gal->var_id = $media['model_id'] ;
                     $gal->erp_media_id = $media['id'] ;
                     $gal->save();
                     }
                 }
                 
             }
                      */
                         
                     }
     
                    
                    
                    
                }else{
                  
                          
                   
                    
                  
                //    $pro->photo =  $product['image_url'];
               //     $pro->thumbnail =  $product['image_url'];
                   
                    $pro->brand_id = !empty($product['brand']['website_brand_id']) ? $product['brand']['website_brand_id'] : null ;
                    
                       //  $cat =   Category::find($product['category']['website_cat_id']);
                        $cat =   Category::where('erp_id',$product['category']['id'])->first();
                         $first =   Category::first();
                         
                    $pro->category_id =!empty($cat) ? $cat->id : $first->id ;
                       if(!empty($product['sub_category']['website_cat_id'])){
                           $subcat =   Subcategory::find($product['sub_category']['website_cat_id']);
                    } 
                         
                    $pro->subcategory_id =!empty($subcat) ? $subcat->id : null ;
                    
                    
                    $pro->name = $product['name'];
                    $pro->name_ar = $product['name_ar'];
                    $pro->details = $product['product_description'] ;
                    $pro->details_ar = $product['product_description_ar'];
                   
                    $pro->slug = $product['name'].'-'.$product['sku'];
                    $pro->slug_ar = $product['name_ar'].'-'.$product['sku'];
                    
                     $pro->measure = !empty($product['unit']['short_name']) ? $product['unit']['short_name'] : $pro->measure; 
                    $pro->price = 0; 
                    $pro->mobile_price =  0; 
                 
                    $pro->previous_price = !empty($attr['previous_price'] ) ? round($attr['previous_price'],2)  : $pro->previous_price ;
                    $pro->featured = !empty($attr['featured'] ) ? $attr['featured']  : 0;
                    $pro->best = !empty($attr['best'] ) ? $attr['best']  : 0;
                    $pro->latest = !empty($attr['latest'] ) ? $attr['latest'] : 0;
                    $pro->big = !empty($attr['big'] ) ? $attr['big']  : 0;
                    $pro->trending = !empty($attr['trending'] ) ? $attr['trending']  : 0;
                 $pro->top = !empty($attr['top'] ) ? $attr['top']  : 0;
                    $pro->hot = !empty($attr['hot'] ) ? $attr['hot'] : 0;
                       $pro->size_status = !empty($attr['size_status'] ) ? $attr['size_status'] :1;
                    $pro->sale = !empty($attr['sale'] ) ? $attr['sale'] : 0;
                    $pro->meta_description = $attr['meta_description'] ;
                    $pro->meta_description_ar = $attr['meta_description_ar'] ;    
                    $pro->youtube = $attr['youtube'] ;
                    $pro->policy = $attr['policy'] ;
                    $pro->policy_ar = $attr['policy_ar'] ;
                     $pro->save(); 
                     
                     if($pro){
                         
                  /* Color::where('product_id', $pro->id)
                        ->whereNotIn('erp_var_id', $variations_ids)
                        ->delete();  */
                
                
                
       foreach($product['variations'] as $k=>$variation){
                foreach($product['product_variations'] as $temp) {
                  if($variation['product_variation_id'] == $temp['id']){
                      
                      
                      $color = Color::where('erp_var_id' , $variation['id'])->where('product_id',$pro->id)->first();
                      
                      if(!empty($color)){
                          
                        //  \Log::info('size '.$variation['name']);
                       //    $color->product_id =  $pro->id;
                       //   $color->erp_var_id =  $variation['id'];
                           $color->size =  $variation['name'];
                           $color->sub_sku =  $variation['sub_sku'];
                         //  $color->size_qty =  0;
                          
                           $color->size_price = !empty($variation['sell_price_inc_tax']) ? round($variation['sell_price_inc_tax'] ,2) : 0; 
                         
                           $color->colors = $temp['variation_template']['color'] ;
                           $color->save();
                          
                          
                      }else{
                          
                          
                            
                       $color = new Color; 
                       $color->product_id =  $pro->id;
                       $color->erp_var_id =  $variation['id'];
                           $color->size =  $variation['name'];
                           $color->sub_sku =  $variation['sub_sku'];
                           $color->size_qty =  0;
                          
                           $color->size_price = !empty($variation['sell_price_inc_tax']) ? round($variation['sell_price_inc_tax'] ,2) : 0; 
                         
                           $color->colors = $temp['variation_template']['color'] ;
                           $color->save();
                          
                          
                          
                      }
                      
                    
                    //    \Log::info('color '.$color);
                  }  
                  
                     
             //    $color_stock = Color::where('erp_var_id',$variation['id'])->first();
            
                 
                 foreach($variation['variation_location_details']  as $variation_location_detail){
                      //    $color_stock = Color::where('erp_var_id',$variation_location_detail['variation_id'])->first();
                     if($variation_location_detail['location_id'] == $location && $variation_location_detail['variation_id'] == $color->erp_var_id){
                         //   \Log::info('size_qty '.$variation_location_detail['qty_available']);
                       $color->size_qty = round($variation_location_detail['qty_available']);
                       $color->save();
                         
                        //  \Log::info('color_stock '.$color);
                     }
                     
                     
                     
                   }
                  
                  
                  
                    
                    
                }      
                      
                      
                      
            /*  if(isset( $product['variations'][$k]['media'] ) ){
                 
                 foreach( $product['variations'][$k]['media']  as $media){
                     
                  $gal  =  Gallery::where('product_id',$pro->id)->where('var_id',$media['model_id'])->where('erp_media_id',$media['id'])->first();
                     if(!$gal){
                         
                     $gal = new Gallery ;
                     $gal->product_id = $pro->id ;
                     $gal->photo = $media['display_url'] ;
                     $gal->var_id = $media['model_id'] ;
                     $gal->erp_media_id = $media['id'] ;
                     $gal->save();
                     }
                     
                   
                 }
                 
             } */
                      
                  }       
                         
        
                  $stocks = Color::where('product_id',$pro->id)->sum('size_qty');
                    
                     $pro->stock = $product['enable_stock'] == 1 ? $stocks : null;
                    $pro->save();
        
        
        
                      
                         
                     }
     
                    
                  
                    
                    
                }
                      
             
             
             
         }else{
             
              //   \Log::info('erp_product '.$request->product);     
                if($product['type'] == 'single'){
                    
                    
                       if(isset( $product['variations'][0]['variation_location_details'] ) ){
                 
                 foreach( $product['variations'][0]['variation_location_details']  as $variation_location_detail){
                     
                     if($variation_location_detail['location_id'] == $location){
                         
                       $qty += $variation_location_detail['qty_available'];
                         
                         
                     }
                     
                     
                     
                   }
                       
                       
                  }
                 
                    
                      $pro = new Product();
                    $pro->type = "Physical";
                    $pro->product_type = "normal";
                    $pro->sku = $product['sku'];
                    $pro->erp_id = $product['id'];
                //    $pro->photo =  $product['image_url'];
               //     $pro->thumbnail =  $product['image_url'];
                    $pro->user_id = 0;
                    $pro->brand_id = !empty($product['brand']['website_brand_id']) ? $product['brand']['website_brand_id'] : null ;
                    
                    $cat = Category::find($product['category']['website_cat_id']);
                    $first = Category::first();
                         
                    $pro->category_id =!empty($cat) ? $cat->id : $first->id ;
                       if(!empty($product['sub_category']['website_cat_id'])){
                           $subcat =   Subcategory::find($product['sub_category']['website_cat_id']);
                    } 
                         
                    $pro->subcategory_id =!empty($subcat) ? $subcat->id : null ;
                    
                    
                    $pro->name = $product['name'];
                    $pro->name_ar = $product['name_ar'];
                    $pro->details = $product['product_description'] ;
                    $pro->details_ar = $product['product_description_ar'];
                    $pro->stock = $product['enable_stock'] == 1 ? !empty($qty) ? $qty : 0 : null ;
                    $pro->slug = $product['name'].'-'.$product['sku'];
                    $pro->slug_ar = $product['name_ar'].'-'.$product['sku'];
                    
                    
                    $pro->measure = !empty($product['unit']['short_name']) ? $product['unit']['short_name'] : null; 
                    $pro->price = !empty($product['variations'][0]['sell_price_inc_tax']) ? round($product['variations'][0]['sell_price_inc_tax'] ,2) : 0; 
                    $pro->mobile_price = !empty($product['variations'][0]['sell_price_inc_tax']) ? round($product['variations'][0]['sell_price_inc_tax'] ,2) : 0; 
                 
                    $pro->previous_price = !empty($attr['previous_price'] ) ? round($attr['previous_price'],2)  : null ;
                    $pro->featured = !empty($attr['featured'] ) ? $attr['featured']  : 0;
                    $pro->best = !empty($attr['best'] ) ? $attr['best']  : 0;
                    $pro->latest = !empty($attr['latest'] ) ? $attr['latest'] : 0;
                    $pro->big = !empty($attr['big'] ) ? $attr['big']  : 0;
                    $pro->trending = !empty($attr['trending'] ) ? $attr['trending']  : 0;
                 $pro->top = !empty($attr['top'] ) ? $attr['top']  : 0;
                    $pro->hot = !empty($attr['hot'] ) ? $attr['hot'] : 0;
                       $pro->size_status = !empty($attr['size_status'] ) ? $attr['size_status'] :1;
                    $pro->sale = !empty($attr['sale'] ) ? $attr['sale'] : 0;
                    $pro->meta_description = $attr['meta_description'] ;
                    $pro->meta_description_ar = $attr['meta_description_ar'] ;    
                    $pro->youtube = $attr['youtube'] ;
                    $pro->policy = $attr['policy'] ;
                    $pro->policy_ar = $attr['policy_ar'] ;
                     $pro->save(); 
                     
                     if($pro){
             /*  if(isset( $product['variations'][0]['media'] ) ){
                 
                 foreach( $product['variations'][0]['media']  as $media){
                     
                     $gal = new Gallery ;
                     $gal->product_id = $pro->id ;
                     $gal->photo = $media['display_url'] ;
                     $gal->var_id = $media['model_id'] ;
                     $gal->erp_media_id = $media['id'] ;
                     $gal->save();
                 }
                 
             }*/
                      
                         
                     }
     
                    
                    
                    
                }else{
                  
                
                      $pro = new Product();
                    $pro->type = "Physical";
                    $pro->product_type = "normal";
                    $pro->sku = $product['sku'];
                    $pro->erp_id = $product['id'];
               //     $pro->photo =  $product['image_url'];
               //     $pro->thumbnail =  $product['image_url'];
                    $pro->user_id = 0;
                    $pro->brand_id = !empty($product['brand']['website_brand_id']) ? $product['brand']['website_brand_id'] : null ;
                    
                         $cat =   Category::find($product['category']['website_cat_id']);
                         $first =   Category::first();
                         
                    $pro->category_id =!empty($cat) ? $cat->id : $first->id ;
                       if(!empty($product['sub_category']['website_cat_id'])){
                           $subcat =   Subcategory::find($product['sub_category']['website_cat_id']);
                    } 
                         
                    $pro->subcategory_id =!empty($subcat) ? $subcat->id : null ;
                    
                    
                    $pro->name = $product['name'];
                    $pro->name_ar = $product['name_ar'];
                    $pro->details = $product['product_description'] ;
                    $pro->details_ar = $product['product_description_ar'];
                    $pro->stock = $product['enable_stock'] == 1 ? 0 : null ;
                    $pro->slug = $product['name'].'-'.$product['sku'];
                    $pro->slug_ar = $product['name_ar'].'-'.$product['sku'];
                    
                     $pro->measure = !empty($product['unit']['short_name']) ? $product['unit']['short_name'] : null; 
                    $pro->price = 0; 
                    $pro->mobile_price =  0; 
                 
                    $pro->previous_price = !empty($attr['previous_price'] ) ? round($attr['previous_price'],2)  : null ;
                    $pro->featured = !empty($attr['featured'] ) ? $attr['featured']  : 0;
                    $pro->best = !empty($attr['best'] ) ? $attr['best']  : 0;
                    $pro->latest = !empty($attr['latest'] ) ? $attr['latest'] : 0;
                    $pro->big = !empty($attr['big'] ) ? $attr['big']  : 0;
                    $pro->trending = !empty($attr['trending'] ) ? $attr['trending']  : 0;
                 $pro->top = !empty($attr['top'] ) ? $attr['top']  : 0;
                    $pro->hot = !empty($attr['hot'] ) ? $attr['hot'] : 0;
                       $pro->size_status = !empty($attr['size_status'] ) ? $attr['size_status'] :1;
                    $pro->sale = !empty($attr['sale'] ) ? $attr['sale'] : 0;
                    $pro->meta_description = $attr['meta_description'] ;
                    $pro->meta_description_ar = $attr['meta_description_ar'] ;    
                    $pro->youtube = $attr['youtube'] ;
                    $pro->policy = $attr['policy'] ;
                    $pro->policy_ar = $attr['policy_ar'] ;
                     $pro->save(); 
                     
                     if($pro){
       foreach($product['variations'] as $k=>$variation){
                foreach($product['product_variations'] as $temp) {
                  if($variation['product_variation_id'] == $temp['id']){
                      
                      
                      
                      $color = new Color; 
                       $color->product_id =  $pro->id;
                       $color->erp_var_id =  $variation['id'];
                           $color->size =  $variation['name'];
                           $color->sub_sku =  $variation['sub_sku'];
                           $color->size_qty =  !empty($qty) ? $qty : 0;
                          
                           $color->size_price = !empty($variation['sell_price_inc_tax']) ? round($variation['sell_price_inc_tax'] ,2) : 0; 
                         
                           $color->colors = $temp['variation_template']['color'] ;
                           $color->save();
                      
                  }  
                    
                    
                }      
                  
              //   $color_stock = Color::where('erp_var_id',$variation['id'])->first();
                 
                 foreach($variation['variation_location_details']  as $variation_location_detail){
                     
                     if($variation_location_detail['location_id'] == $location && $variation_location_detail['variation_id'] == $color->erp_var_id){
                         
                       $color->size_qty = $variation_location_detail['qty_available'];
                       $color->save();
                         
                         
                     }
                     
                     
                     
                   }
                       
                       
          
                        
                      
                      
          /*    if(isset( $product['variations'][$k]['media'] ) ){
                 
                 foreach( $product['variations'][$k]['media']  as $media){
                     
                     $gal = new Gallery ;
                     $gal->product_id = $pro->id ;
                     $gal->photo = $media['display_url'] ;
                     $gal->var_id = $media['model_id'] ;
                     $gal->erp_media_id = $media['id'] ;
                     $gal->save();
                 }
                 
             } */
                      
                  }       
                         
                    $stocks = Color::where('product_id',$pro->id)->sum('size_qty');
                    
                     $pro->stock = $product['enable_stock'] == 1 ? $stocks : null;
                    $pro->save();
        
        
                      
                         
                     }
     
                    
                  
                    
                    
                }
                      
             
         }
           
          
                   $pro = Product::with('galleries','category','brand','size')->where('id',$pro->id)->first();
               

                  /*foreach($json as $j){
                      
                              
                      $category[] = $j ;
                     
                  }*/
                      
      
      
        return response()->json(array($pro));  
         
        
  
    }
    
  public function erpdeletemedia(Request $request)
    {
      
       
          $media = json_decode($request->media, true);
        
      
            $gal =  Gallery::where('erp_media_id',$media)->first() ;
               if($gal){
                   $gal->delete();
               }

                  /*foreach($json as $j){
                      
                              
                      $category[] = $j ;
                     
                  }*/
                      
      
      
        return response()->json(array('success'=> true));  
         
        
  
    }
  
     public function ProductPrice(Request $request)
    {
        $pro = [];
       
          $product = $request->product;
          $variation = $request->vari;
          $price = $request->price;
      
     

     
               $web_color= Color::where('erp_var_id', $variation)->first();
            if(!empty($web_color)){
                  $web_color->size_price = $price ;
                   $web_color->save();  
               }else{
                   
            $pro = Product::where('erp_id',$product)->first();
            if(!empty($pro)){
                $pro->price = $price ;
                $pro->mobile_price = $price ;
                 $pro->save();
                
            }   
                   
                   
               }
     
     
 
                    
               
                      
      
      
         return response()->json(array($product,$variation,$price));  
         
   
        
  
    }
      
  
}