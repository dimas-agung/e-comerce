<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVarian;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    //
    private ProductService $productService;
    public function __construct() {
        $this->productService =  new ProductService();
    }
    public function index()
    {
        // $pictures = [UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg')];
        // //
        

        $product = Product::with(['category','varians.detail','product_varian'])->latest()->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.product.index', [
            'products' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = [];
        $product_categories = ProductCategory::get();
        return response()->view('admin.product.create', [

            'product_categories' => $product_categories
        ]);
        // return response()->view('admin.productCategory.create');
    }
    public function store(Request $request)
    {
        // return $request->input('picture_default');
        // return $request->input('varian_name');
        $validated = $request->validate([
            'product_categories_id' => ['required'],
            // 'product_code' => ['required'],
            'name' => ['required'],
            'length' => ['required'],
            'width' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'order_period' => ['sometimes', 'nullable'],
            'order_type' => ['sometimes', 'nullable'],
            'description'  => ['sometimes', 'nullable'],
            'varian_name'  => ['required','min:1'],
            'varian_detail_1_name'  => ['required','min:1'],
            'varian_detail_2_name'  => ['sometimes', 'nullable'],
            'picture_default'  => ['required'],
        ]);


        $dataProduct = [
            'product_categories_id' => $request->input('product_categories_id'),
            'product_code' => 'Product123',
            'name' => $request->input('name'),
            'length' => $request->input('length'),
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
            'order_period' => $request->input('order_period'),
            'order_type' => $request->input('order_type'),
            'description' => $request->input('description'),
            'picture_default' => $request->file('picture_default'),
            'picture_1' => $request->file('picture_1'),
            'picture_2' => $request->file('picture_2'),
            'picture_3' => $request->file('picture_3'),
            'picture_4' => $request->file('picture_4'),
            'picture_5' => $request->file('picture_5'),
        ];
        return $dataProduct;
        $varians = [];
        foreach($request->input('varian_name') as $key=>$value){
            if($value !=null){
                $varians[]['name'] = $value;
            }
        }
        $varian_details =[];
   
        $varian_details[0]=explode(",",$request->input('varian_detail_1_name'));
        if(count($varians) >1){
            // $varian_details[0][]=explode(" ",$request->input('varian_detail_1_name'));
            if (!empty($request->input('varian_detail_2_name'))) {
                $varian_details[1]=explode(",",$request->input('varian_detail_2_name'));  
            }
        }
        // foreach ($varian_details[0] as $key => $value) {
        //     # code...
        //     var_dump($value);
            
        // }
        // return $varian_details[0];
        $this->productService->create($dataProduct,$varians,$varian_details);
        
        // return response()
        //     ->json($anggota);
        return redirect('product')->with('success', 'Data Product has been created!');
    }
    public function edit(Product $product)
    {
        //
        $product_categories = ProductCategory::get();
        
        return response()->view('admin.product.edit', [
            'product_categories' => $product_categories,
            'product' => $product
        ]);
    }
    public function update(Request $request,Product $product)
    {
        $validated = $request->validate([
            'product_categories_id' => ['required'],
            'product_code' => ['required'],
            'name' => ['required'],
            'length' => ['required'],
            'width' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'order_period' => ['required'],
            'order_type' => ['sometimes', 'nullable'],
            'description'  => ['sometimes', 'nullable'],
            'varian_name.*'  => ['required','min:1'],
            'varian_detail_1_name'  => ['required','min:1'],
            'varian_detail_2_name'  => ['sometimes', 'nullable'],
            // 'picture_default'  => ['required'],
        ]);
        $dataProduct = [
            'product_categories_id' => $request->input('product_categories_id'),
            'product_code' => $request->input('product_code'),
            'name' => $request->input('name'),
            'length' => $request->input('length'),
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
            'order_type' => $request->input('order_type'),
            'order_period' => $request->input('order_period'),
            'description' => $request->input('description'),
            'picture_default' => $request->file('picture_default'),
            'picture_1' => $request->file('picture_1'),
            'picture_2' => $request->file('picture_2'),
            'picture_3' => $request->file('picture_3'),
            'picture_4' => $request->file('picture_4'),
            'picture_5' => $request->file('picture_5'),
        ];
        // return redirect('product')->with('success', 'Data Product has been created!');
        // return $dataProduct;
        $varians = [];
        foreach($request->input('varian_name') as $key=>$value){
            $varians[]['name'] = $value;
        }
        $varian_details =[];
   
        $varian_details[0]=explode(",",$request->input('varian_detail_1_name'));
        if(count($varians) >1){
            // $varian_details[0][]=explode(" ",$request->input('varian_detail_1_name'));
            if (!empty($request->input('varian_detail_2_name'))) {
                $varian_details[1]=explode(",",$request->input('varian_detail_2_name'));  
            }
        }
        // return  $varian_details[0];
        $this->productService->update($product,$dataProduct,$varians,$varian_details);
        
        // return response()
        //     ->json($anggota);
        return redirect('product')->with('success', 'Data Product has been updated!');
    }

    public function activated(Product $product)
    {
        //
        $product->activated();
        
        return redirect('product')->with('success', 'Data Product has been Activated!');
    }
    public function nonactive(Product $product)
    {
        //
        $product->nonactive();
        // return $address;
        return redirect('product')->with('success', 'Data Product has been nonactive!');
    }
    function upploadFile($files,$path,$file_name){
        $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name. '_default.png';
        return $url;
    }
}