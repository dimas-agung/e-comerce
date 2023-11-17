<?php

namespace App\Http\Controllers;

use App\Models\ProductVarian;
use Illuminate\Http\Request;

class ProductVarianController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(Request $request){

        $products_id = $request->input('products_id');
        $varians_id = $request->input('varians_id');
        if ($products_id) {
            # code...
           $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->where('products_id',$products_id)->get();
        }elseif ($varians_id) {
            # code...
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->where('varians_id',$varians_id)->get();
        }else{
            $product_varians= ProductVarian::with(['product','varian_detail1','varian_detail2'])->get();
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
    function update_batch(Request $request) {
        $validated = $request->validate([
            'id.*' => ['required'],
            'stock.*' => ['required'],
            'price.*' => ['required'],
            'is_active.*' => ['required'],
        ]);
        $ids = $request->input('id');
        $stocks = $request->input('stock');
        $price = $request->input('price');
        $is_actives = $request->input('is_active');
        foreach ($ids as $key => $id) {
            $product_varian = ProductVarian::where('id',$id)->update([
                'stock' => $stocks[$key],
                'price' => $price[$key],
                'is_active' => $is_actives[$key],
            ]);
        }
        return redirect('product')->with('success', 'Data Varian has been updated!');

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
    function getData(Request $request) {
        if ($request->input('products_id')) {
            $data = ProductVarian::with(['product','varian_detail1','varian_detail1'])->where('products_id',$request->input('products_id'))->get();
        }else{

        }
        
    }
}
