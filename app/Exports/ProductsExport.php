<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('sku','name','name_ar','slug','size','size_qty','size_price','color','price','stock','previous_price','details','details_ar','policy','policy_ar','youtube','product_type','affiliate_link','user_id','category_id','subcategory_id','childcategory_id','brand_id')->get();
    }
}
