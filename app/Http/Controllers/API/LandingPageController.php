<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\ProductBestSeller;
use App\Models\Series;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    function productBestSeller()  {
       
            $productBestSeller = ProductBestSeller::with('product.product_varian')->get();
            foreach($productBestSeller as $key=> $value){
                $value->product->min_price = $value->product->product_varian->min('price');
                $value->product->max_price = $value->product->product_varian->max('price');
            }
            return $productBestSeller;
    }
    function carousel(Request $request)  {
        if($request->input('carousel_id')){
            return Carousel::where('id',$request->input('carousel_id'))->first();
        }
        return Carousel::get();
    }
    function series(Request $request)  {
        if($request->input('series_id')){
            return Series::where('id',$request->input('series_id'))->first();
        }
        // return Series::get();
        $series = Series::with('category.product.product_varian')->latest()->get();
        foreach($series as $key=> $value){
            foreach($value->category->product  as $key=> $value2){
                $value2->min_price = $value2->product_varian->min('price');
                $value2->max_price = $value2->product_varian->max('price');
            }
        }
        return $series;
    }
}