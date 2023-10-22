<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        
        $img = UploadedFile::fake()->create('file.jpg');
        
        $path = 'products';
        $picture_default = $img;
        $file_name = 'defaultjk.png';
        $url = self::upploadFile($picture_default,$path,$file_name);
        return $url;
        $product = Product::with(['category','varians.detail'])->latest()->paginate(10);
        return $product;
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
            'picture_default' => $request->file('picture_default'),
            'picture_1' => $request->file('picture_1'),
            'picture_2' => $request->file('picture_2'),
            'picture_3' => $request->file('picture_3'),
            'picture_4' => $request->file('picture_4'),
            'picture_5' => $request->file('picture_5'),
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
        $this->productService->update($product,$dataProduct,$varians,$varian_details);
        
        // return response()
        //     ->json($anggota);
        return redirect('product')->with('success', 'Data Product has been created!');
    }
    function upploadFile($files,$path,$file_name){
        $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name. '_default.png';
        return $url;
    }
}