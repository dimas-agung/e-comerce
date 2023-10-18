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
        $product = Product::create($validated);
        //    return $request->file('img_ktp');
        $path = 'products';
        $url_pic_default = null;
        $url_pic_1 = null;
        $url_pic_2 = null;
        $url_pic_3 = null;
        $url_pic_4 = null;
        $picture_default = $request->file('picture_default');
        $picture_default->storePubliclyAs($path, $request->product_code . '_default.png', "public");
        $url_pic_default = $path.'/'. $request->product_code . '_default.png';
       if ($request->file('picture_1')) {
            # code...
            $picture_1 = $request->file('picture_1');
            $url_pic_1 = $path.'/'. $request->product_code . '_1.png';
            $picture_default->storePubliclyAs($path, $request->product_code . '_1.png', "public");
        }
       if ($request->file('picture_2')) {
            # code...
            $picture_2 = $request->file('picture_2');
            $url_pic_2 = $path.'/'. $request->product_code . '_2.png';
            $picture_default->storePubliclyAs($path, $request->product_code . '_2.png', "public");
        }
       if ($request->file('picture_3')) {
            # code...
            $picture_3 = $request->file('picture_3');
            $url_pic_3 = $path.'/'. $request->product_code . '_3.png';
            $picture_default->storePubliclyAs($path, $request->product_code . '_3.png', "public");
        }
       if ($request->file('picture_4')) {
            # code...
            $picture_4 = $request->file('picture_4');
            $url_pic_4 = $path.'/'. $request->product_code . '_4.png';
            $picture_default->storePubliclyAs($path, $request->product_code . '_4.png', "public");
        }
        $product->update([
            'picture_default' => $url_pic_default, 
            'picture_1' => $url_pic_1,
            'picture_2' => $url_pic_2,
            'picture_3' => $url_pic_3,
            'picture_4' => $url_pic_4,
        ]);
        
        // return response()
        //     ->json($anggota);
        return redirect('product')->with('success', 'Data Product has been created!');
    }
}