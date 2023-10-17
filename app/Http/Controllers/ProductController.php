<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        //
        $productCategory = Product::latest()->paginate(10);
        // return $productCategory;
        // return response()->view('admin.productCategory.index', [
        //     'productCategory' => $productCategory
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return response()->view('admin.productCategory.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_categories_id' => ['required'],
            'product_code' => ['required'],
            'name' => ['required'],
            'length' => ['required'],
            'width' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'order_type' => ['sometimes', 'nullable'],
            'description' => ['sometimes', 'nullable'],
            // 'img_ktp' => ['required'],
            // 'img_c1' => ['required'],
        ]);
        //    return $request->file('img_ktp');
        $picture_default = $request->file('picture_default');
        $picture_1 = $request->file('picture_1');
        $picture_2 = $request->file('picture_2');
        $picture_3 = $request->file('picture_3');
        $picture_4 = $request->file('picture_4');
        $path = 'products';
        $picture_default->storePubliclyAs($path, $request->product_code . '_default.png', "public");
        $picture_1->storePubliclyAs($path, $request->product_code . '_1.png', "public");
        $picture_2->storePubliclyAs($path, $request->nikproduct_code . '_2.png', "public");
        $picture_3->storePubliclyAs($path, $request->product_code . '_3.png', "public");
        $picture_4->storePubliclyAs($path, $request->product_code . '_4.png', "public");
        // $url_ktp = $path_ktp . '/' .  $request->nik . '_ktp.png';
        // $url_kta = $path_kta . '/' .  $request->nik . '_kta.png';
        $product = Product::create($validated);
        // return response()
        // $anggota->update(['url_ktp' => $url_ktp, 'url_kta' => $url_kta]);
        //     ->json($anggota);
        return redirect('product')->with('success', 'Data Product berhasil disimpan!');
    }
}