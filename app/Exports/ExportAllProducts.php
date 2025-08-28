<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;


class ExportAllProducts implements FromCollection, WithMapping, WithHeadings
{
    
    public function collection()
    {
        return  Product::with(['category','subcategory','childcategory'])->get();
    }
    
      public function map($product) : array 
      {
        return [
            $product->id,
            $product->name,
            $product->name_ar,
            asset('/assets/images/thumbnails/'.$product->thumbnail),
            strip_tags($product->details),
            strip_tags($product->details_ar),
            $product->youtube,
            $product->price,
            $product->stock,
            $product->category->name,
            $product->category->name_ar,
            isset($product->subcategory->name) ? $product->subcategory->name : '',
            isset($product->subcategory->name_ar) ? $product->subcategory->name_ar : '',
            isset($product->childcategory->name) ? $product->childcategory->name : '',
            isset($product->childcategory->name_ar) ? $product->childcategory->name_ar : '',
            
        ];
      }
      
      
      public function headings():array
    {
        return [
                'id',
                'name',
                'name_ar',
                'photo',
                'details',
                'details_ar',
                'youtube',
                'price',
                'stock',
                'category_name',
                'category_name_ar',
                'subcategory_name',
                'subcategory_name_ar',
                'childcategory_name',
                'childcategory_name_ar',
            ];    
    }
    
}
