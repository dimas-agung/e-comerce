<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVarian;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    private ProductService $productService;
    public function __construct() {
        $this->productService =  new ProductService();
    }
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
            'description'  => ['sometimes', 'nullable'],
            'varian_name.*'  => ['required','min:1'],
            'varian_detail_1_name.*'  => ['required','min:1'],
            'varian_detail_2_name.*'  => ['sometimes', 'nullable'],
            'picture_default'  => ['required'],
        ]);
        $dataProduct = [
            'product_categories_id' => $request->input('product_categories_id'),
            'product_code' => $request->input('product_code'),
            'name' => $request->input('name'),
            'length' => $request->input('length'),
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
            'order_type' => $request->input('weight'),
            'description' => $request->input('description'),
            'picture_default' => $request->input('picture_default'),
            'pictures' => $request->input('pictures'),
        ];
        $varians = [];
        foreach($request->input('varian_name') as $key=>$value){
            $varians[]['name'] = $value;
        }
        $varian_details =[];
        foreach($request->input('varian_detail_1_name') as $key=>$value){
            $varian_details[0][] = $value;
        }
        if(count($varians) >1){
            if (!empty($request->input('varian_detail_2_name'))) {
                foreach($request->input('varian_detail_2_name') as $key=>$value){
                    $varian_details[1][] = $value;
                }
            }
        }
        $this->productService->create($dataProduct,$varians,$varian_details);
        
        // return response()
        //     ->json($anggota);
        return redirect('product')->with('success', 'Data Product has been created!');
    }
}