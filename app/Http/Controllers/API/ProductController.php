<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function index(Request $request){
        $products_id = $request->input('products_id');
        $products_id = $request->input('products_id');
        $product_categories_id = $request->input('product_categories_id');
        if ($product_categories_id) {
            # code...
            $product= Product::with(['category','varians.detail','product_varian'])->where('product_categories_id',$product_categories_id)->where('is_active',1)->latest()->get();
            foreach($product as $key=> $value){
                $value->min_price = $value->product_varian->min('price');
                $value->max_price = $value->product_varian->max('price');
            }  
        }elseif ($products_id) {
            # code...
            $product= Product::with(['category','varians.detail','product_varian'])->where('id',$products_id)->where('is_active',1)->latest()->first();
           
                $product->min_price = $product->product_varian->min('price');
                $product->max_price = $product->product_varian->max('price');
            
        }else{
            $product= Product::with(['category','varians.detail','product_varian'])->where('is_active',1)->latest()->get();
            foreach($product as $key=> $value){
                $value->min_price = $value->product_varian->min('price');
                $value->max_price = $value->product_varian->max('price');
            }
        }
        
        return $product;
    }

    function search(Request $request){

        $search = $request->input('search');

        if($search){
            $product= Product::with(['category','varians.detail','product_varian'])->where('name','LIKE',"%{$search}%")->where('is_active',1)->latest()->get();
            foreach($product as $key=> $value){
                $value->min_price = $value->product_varian->min('price');
                $value->max_price = $value->product_varian->max('price');
            }  
        }
        
        
        return $product;
    }
}
