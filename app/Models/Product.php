<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generalsetting;
use App\Models\Currency;
use App\Models\Color;
use App\Models\ProductCurrency;
use App\Models\IpAdress;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['returned', 'affiliate_setting_id', 'user_id', 'category_id', 'product_type', 'free_ship', 'affiliate_link', 'sku', 'slug_ar', 'scale', 'mobile_price', 'brand_id', 'subscription_type', 'feature', 'trial_period', 'subscription_period', 'subcategory_id', 'childcategory_id', 'id', 'attributes', 'name_ar', 'name', 'photo', 'size', 'size_qty', 'size_price', 'color', 'mobile_photo', 'mobile_details_ar', 'mobile_details', 'details_ar', 'details', 'price', 'previous_price', 'stock', 'mobile_policy_ar', 'mobile_policy', 'policy_ar', 'policy', 'status', 'views', 'tags', 'tags_ar', 'featured', 'best', 'top', 'hot', 'latest', 'big', 'trending', 'sale', 'features', 'colors', 'product_condition', 'ship', 'meta_tag', 'meta_tag_ar', 'meta_description_ar', 'meta_description', 'youtube', 'type', 'file', 'license', 'license_qty', 'link', 'platform', 'region', 'licence_type', 'measure', 'discount_date', 'is_discount', 'whole_sell_qty', 'whole_sell_discount', 'catalog_id', 'slug_ar', 'slug', 'hover_photo', 'alt', 'alt_ar', 'title', 'title_ar', 'featured_price'];

    public static function filterProducts($collection)
    {
        foreach ($collection as $key => $data) {
            if ($data->user_id != 0) {
                if ($data->user->is_vendor != 2) {
                    unset($collection[$key]);
                }
            }
            if (isset($_GET['max'])) {
                if ($data->vendorSizePrice() >= $_GET['max']) {
                    unset($collection[$key]);
                }
            }
            $data->price = $data->vendorSizePrice();
        }
        return $collection;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function childcategory()
    {
        return $this->belongsTo('App\Models\Childcategory');
    }


    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery')->where('web', 1);
    }
    public function size()
    {
        return $this->hasMany('App\Models\Color');
    }
    public function sizes()
    {
        return $this->hasMany('App\Models\Color');
    }
    public function mobilegalleries()
    {
        return $this->hasMany('App\Models\Gallery')->where('web', 0);
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function clicks()
    {
        return $this->hasMany('App\Models\ProductClick');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function piece()
    {
        return $this->belongsToMany('Piece');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'user_id');
    }
    public function related()
    {
        return $this->hasMany('App\Models\Related', 'product_id');
    }

    public function vendorPrice()
    {
        $gs = Generalsetting::findOrFail(1);

        $country_price = ProductCurrency::where('product_id', $this->id)->where('country', $this->ip_info("Visitor", "Country"))->first();

        //    \Log::info($country_price);
        if ($country_price) {

            $price = $country_price->price;
        } else {


            $price = $this->price;
        }

        //  $price = $this->price;


        if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }


        return $price;
    }

 public function new_vendorPrice()
    {
        $gs = Generalsetting::findOrFail(1);

    
        $price = $this->price;
        
      

        //  $price = $this->price;


        if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }


        return $price;
    }


    
    public function vendorSizePrice()
    {
        $gs = Generalsetting::findOrFail(1);

        $country_price = ProductCurrency::where('product_id', $this->id)->where('country', $this->ip_info("Visitor", "Country"))->first();

        //    \Log::info($country_price);
        if ($country_price) {

            $price = $country_price->price;
        } else {


            $price = $this->price;
        }
        //  $price = $this->price;


        if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }
        if (!empty($this->size_price)) {
            $price += $this->size_price[0];
        }

        // Attribute Section

        $attributes = $this->attributes["attributes"];
        if (!empty($attributes)) {
            $attrArr = json_decode($attributes, true);
        }

        if (!empty($attrArr)) {
            foreach ($attrArr as $attrKey => $attrVal) {
                if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                    foreach ($attrVal['values'] as $optionKey => $optionVal) {
                        $price += $attrVal['prices'][$optionKey];
                        // only the first price counts
                        break;
                    }
                }
            }
        }


        // Attribute Section Ends


        return $price;
    }
  public  function setCurrency()
    {

        $gs = Generalsetting::findOrFail(1);
        $price = $this->price;
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {


            return $curr->sign . ' ' . $price;
        } else {
            return $price . ' ' . $curr->sign;
        }
    }

    // public  function setCurrency()
    // {

    //     $gs = Generalsetting::findOrFail(1);

    //     $country_price = ProductCurrency::where('product_id', $this->id)->where('country', $this->ip_info("Visitor", "Country"))->first();

    //     //  \Log::info($country_price);
    //     if ($country_price) {

    //         $price = $country_price->price;
    //     } else {


    //         $price = $this->price;
    //     }
    //     //    $price = $this->price;

    //     /*     $country_curr =  $this->ip_info("Visitor", "currencycode");
       
    // if($country_price){
              
    //          if(!empty($country_curr)){
           
           
    //       $sign = $country_curr;
           
           
    //   }else{
           
    //      if (Session::has('currency')) {
    //         $curr = Currency::find(Session::get('currency'));
    //     } else {
    //         $curr = Currency::where('is_default', '=', 1)->first();
    //     }
           
    //      $sign =   $curr->sign;   
    //      $price = round(($price) * $curr->value, 2);
    //   }
       

              
    //       }else{
              
              
      
              
    //       }
    //       */

    //     if (Session::has('currency')) {
    //         $curr = Currency::find(Session::get('currency'));
    //     } else {
    //         $curr = Currency::where('is_default', '=', 1)->first();
    //     }

    //     $sign =   $curr->sign;
    //     $price = round(($price) * $curr->value, 2);



    //     if ($gs->currency_format == 0) {


    //         return $sign . ' ' . $price;
    //     } else {
    //         return $price . ' ' . $sign;
    //     }
    // }
    public  function setCurrency_ar()
    {

        $gs = Generalsetting::findOrFail(1);

        $country_price = ProductCurrency::where('product_id', $this->id)->where('country', $this->ip_info("Visitor", "Country"))->first();

        //   \Log::info($country_price);
        if ($country_price) {

            $price = $country_price->price;
        } else {


            $price = $this->price;
        }




        //   $price = $this->price;
        /*    $country_curr =  $this->ip_info("Visitor", "currencycode");
       
         if($country_price){
              
             if(!empty($country_curr)){
           
           
           $sign = $country_curr;
           
           
       }else{
           
         if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
           
         $sign =   $curr->sign;   
         $price = round(($price) * $curr->value, 2);
       }
       

              
          }else{
              
              
     
              
          }*/


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        $sign =   $curr->sign;
        $price = round(($price) * $curr->value, 2);


        if ($gs->currency_format == 0) {


            return $sign . ' ' . $price;
        } else {
            return $price . ' ' . $sign;
        }
    }

    public function showPrice()
    {
        $gs = Generalsetting::findOrFail(1);
        $color = Color::where('product_id', $this->id)->where('size_qty', '>', 0)->first();
       $price = $this->price;
 
    //     $price = $this->vendorPrice();

       /* if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }
*/
        if (!empty($this->size_price)) {
            $price += $this->size_price[0];
        }

        if (!empty($color)) {
            $price += $color->size_price;
        }

        // Attribute Section

        $attributes = $this->attributes["attributes"];
        if (!empty($attributes)) {
            $attrArr = json_decode($attributes, true);
        }
        // dd($attrArr);
        if (!empty($attrArr)) {
            foreach ($attrArr as $attrKey => $attrVal) {
                if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                    foreach ($attrVal['values'] as $optionKey => $optionVal) {
                        $price += $attrVal['prices'][$optionKey];
                        // only the first price counts
                        break;
                    }
                }
            }
        }


        // Attribute Section Ends


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }



        $price = round(($price) * $curr->value, 2);
       
        if ($gs->currency_format == 0) {
            return $curr->sign . ' ' . $price;
        } else {
            return $price . ' ' . $curr->sign;
        }
    }


    public function showPrice_ar()
    {
        $gs = Generalsetting::findOrFail(1);
        $color = Color::where('product_id', $this->id)->where('size_qty', '>', 0)->first();
        $price = $this->price;
      //  $price = $this->vendorPrice();

      /*  if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }*/

        if (!empty($this->size_price)) {
            $price += $this->size_price[0];
        }

        if (!empty($color)) {
            $price += $color->size_price;
        }

        // Attribute Section

        $attributes = $this->attributes["attributes"];
        if (!empty($attributes)) {
            $attrArr = json_decode($attributes, true);
        }
        // dd($attrArr);
        if (!empty($attrArr)) {
            foreach ($attrArr as $attrKey => $attrVal) {
                if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                    foreach ($attrVal['values'] as $optionKey => $optionVal) {
                        $price += $attrVal['prices'][$optionKey];
                        // only the first price counts
                        break;
                    }
                }
            }
        }


        // Attribute Section Ends


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }



        $price = round(($price) * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->name_ar . ' ' . $price;
        } else {
            return $price . ' ' . $curr->name_ar;
        }
    }


    public function showFeaturedPrice()
    {
        $gs = Generalsetting::findOrFail(1);
        $color = Color::where('product_id', $this->id)->where('size_qty', '>', 0)->first();
        $price = $this->featured_price;

        if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }

        // Attribute Section Ends

        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        $price = round(($price) * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->sign . ' ' . $price;
        } else {
            return $price . ' ' . $curr->sign;
        }
    }


    public function showFeaturedPrice_ar()
    {
        $gs = Generalsetting::findOrFail(1);
        $color = Color::where('product_id', $this->id)->where('size_qty', '>', 0)->first();
        $price = $this->featured_price;

        if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }

        // Attribute Section Ends
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }



        $price = round(($price) * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->name_ar . ' ' . $price;
        } else {
            return $price . ' ' . $curr->name_ar;
        }
    }

    public function colors()
    {
        return $this->hasMany('App\Models\Color');
    }

    public function getPrice()
    {
        $gs = Generalsetting::findOrFail(1);
        $color = Color::where('product_id', $this->id)->where('size_qty', '>', 0)->first();
        $price = $this->price;

        if ($this->user_id != 0) {
            $price = $this->price + $gs->fixed_commission + ($this->price / 100) * $gs->percentage_commission;
        }

        if (!empty($this->size_price)) {
            $price += $this->size_price[0];
        }

        if (!empty($color)) {
            $price += $color->size_price;
        }

        // Attribute Section

        $attributes = $this->attributes["attributes"];
        if (!empty($attributes)) {
            $attrArr = json_decode($attributes, true);
        }
        // dd($attrArr);
        if (!empty($attrArr)) {
            foreach ($attrArr as $attrKey => $attrVal) {
                if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                    foreach ($attrVal['values'] as $optionKey => $optionVal) {
                        $price += $attrVal['prices'][$optionKey];
                        // only the first price counts
                        break;
                    }
                }
            }
        }


        // Attribute Section Ends

        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }

        $price = round(($price) * $curr->value, 2);

        return $price;
    }


    public function showPreviousPrice()
    {
        $gs = Generalsetting::findOrFail(1);
        $price = $this->previous_price;
        if (!$price) {
            return '';
        }
        if ($this->user_id != 0) {
            $price = $this->previous_price + $gs->fixed_commission + ($this->previous_price / 100) * $gs->percentage_commission;
        }

        if (!empty($this->size_price)) {
            $price += $this->size_price[0];
        }

        // Attribute Section

        $attributes = $this->attributes["attributes"];
        if (!empty($attributes)) {
            $attrArr = json_decode($attributes, true);
        }
        // dd($attrArr);
        if (!empty($attrArr)) {
            foreach ($attrArr as $attrKey => $attrVal) {
                if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                    foreach ($attrVal['values'] as $optionKey => $optionVal) {
                        $price += $attrVal['prices'][$optionKey];
                        // only the first price counts
                        break;
                    }
                }
            }
        }


        // Attribute Section Ends


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->sign . ' ' . $price;
        } else {
            return $price . ' ' . $curr->sign;
        }
    }
    public function showPreviousPrice_ar()
    {
        $gs = Generalsetting::findOrFail(1);
        $price = $this->previous_price;
        if (!$price) {
            return '';
        }
        if ($this->user_id != 0) {
            $price = $this->previous_price + $gs->fixed_commission + ($this->previous_price / 100) * $gs->percentage_commission;
        }

        if (!empty($this->size_price)) {
            $price += $this->size_price[0];
        }

        // Attribute Section

        $attributes = $this->attributes["attributes"];
        if (!empty($attributes)) {
            $attrArr = json_decode($attributes, true);
        }
        // dd($attrArr);
        if (!empty($attrArr)) {
            foreach ($attrArr as $attrKey => $attrVal) {
                if (is_array($attrVal) && array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1) {

                    foreach ($attrVal['values'] as $optionKey => $optionVal) {
                        $price += $attrVal['prices'][$optionKey];
                        // only the first price counts
                        break;
                    }
                }
            }
        }


        // Attribute Section Ends


        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->name_ar . ' ' . $price;
        } else {
            return $price . ' ' . $curr->name_ar;
        }
    }

    public static function getPurePrice($price)
    {

        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        //   $price = round($price ,2);

        return $price;
    }

    public static function convertPrice($price)
    {

        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        //   $price = round($price ,2);
        if ($gs->currency_format == 0) {
            return number_format($price, 2) . ' ' . $curr->sign;
        } else {
            return number_format($price, 2) . ' ' . $curr->sign;
        }
    }
    public static function convertPrice_ar($price)
    {
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->name_ar . ' ' . $price;
        } else {
            return $price;
        }
    }

    public static function vendorConvertPrice($price)
    {
        $gs = Generalsetting::findOrFail(1);

        $curr = Currency::where('is_default', '=', 1)->first();
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->sign . ' ' . $price;
        } else {
            return $price . ' ' . $curr->sign;
        }
    }
    public static function vendorConvertPrice_ar($price)
    {
        $gs = Generalsetting::findOrFail(1);

        $curr = Currency::where('is_default', '=', 1)->first();
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->name_ar . ' ' . $price;
        } else {
            return $price . ' ' . $curr->name_ar;
        }
    }

    public static function convertPreviousPrice($price)
    {
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->sign . ' ' . $price;
        } else {
            return $price . ' ' . $curr->sign;
        }
    }
    public static function convertPreviousPrice_ar($price)
    {
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default', '=', 1)->first();
        }
        $price = round($price * $curr->value, 2);
        if ($gs->currency_format == 0) {
            return $curr->name_ar . ' ' . $price;
        } else {
            return $price . ' ' . $curr->name_ar;
        }
    }

    public function showName()
    {
        $name = strlen($this->name) > 55 ? substr($this->name, 0, 55) . '...' : $this->name;
        return $name;
    }
    public function showName_ar()
    {
        $name_ar = strlen($this->name_ar) > 55 ? substr($this->name_ar, 0, 55) . '...' : $this->name_ar;
        return $name_ar;
    }


    public function emptyStock()
    {
        $stck = (string) $this->stock;

        if ($stck == "0") {

            return true;
        } elseif ($this->stock < 0) {

            return true;
        }
    }

    public static function showTags()
    {
        $tags = null;
        $tagz = '';
        $name = Product::where('status', '=', 1)->pluck('tags')->toArray();
        foreach ($name as $nm) {
            if (!empty($nm)) {
                foreach ($nm as $n) {
                    $tagz .= $n . ',';
                }
            }
        }
        $tags = array_unique(explode(',', $tagz));
        return $tags;
    }


    public function getSizeAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getSizeQtyAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getSizePriceAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getColorAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getTagsAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getMetaTagAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getFeaturesAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getColorsAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getLicenseAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',,', $value);
    }

    public function getLicenseQtyAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getWholeSellQtyAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function getWholeSellDiscountAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }

    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {


        $output = NULL;


        return $output;
    }
}
