<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Series;

class SeriesController extends Controller
{
    //
    function index(){
        $series = Series::with('category.product.product_varian')->latest()->get();
        // foreach($series->category as $key=> $value){
        //     $value->product->min_price = $value->product->product_varian->min('price');
        //     $value->product->max_price = $value->product->product_varian->max('price');
        // }
        return $series;
    }
}