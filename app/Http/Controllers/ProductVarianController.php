<?php

namespace App\Http\Controllers;

use App\Models\ProductVarian;
use Illuminate\Http\Request;

class ProductVarianController extends Controller
{
    //
    function index(Request $request){

        $products_id = $request->input('products_id');
        $varians_id = $request->input('varians_id');
        if ($products_id) {
            # code...
           $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail1'])->where('products_id',$products_id)->get();
        }elseif ($varians_id) {
            # code...
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail1'])->where('varians_id',$varians_id)->get();
        }else{
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail1'])->get();
        }
        return $product_varians;
    }
    function update(Request $request, ProductVarian $product_varian) {
        $validated = $request->validate([
            'stock' => ['required'],
            'price' => ['required'],
        ]);
        $product_varian->update($validated);
    }
    public function activated(ProductVarian $product_varian)
    {
        $product_varian->activated();
        return $product_varian;
    }
    public function nonactive(ProductVarian $product_varian)
    {
        $product_varian->nonactive();
        return $product_varian;
    }
}
