<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductVarian;
use Illuminate\Http\Request;

class ProductVarianController extends Controller
{
    //
    function index(Request $request){

        $products_id = $request->input('products_id');
        $varians_id = $request->input('varians_id');
        $product_varian_id = $request->input('product_varian_id');
        if ($products_id) {
            # code...
           $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->where('products_id',$products_id)->get();
        }elseif ($varians_id) {
            # code...
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->where('varians_id',$varians_id)->get();
        }elseif ($product_varian_id) {
            # code...
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->where('id',$product_varian_id)->first();
        }else{
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->get();
        }
        return $product_varians;
    }
}
