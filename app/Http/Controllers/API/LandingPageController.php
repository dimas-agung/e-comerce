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
       
            return ProductBestSeller::with('product')->get();
       
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
        return Series::get();
    }
}
