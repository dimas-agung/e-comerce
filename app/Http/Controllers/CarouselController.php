<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CarouselController extends Controller
{
    //
    
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        // $pictures = [UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg')];
        // //
        

        $carousels = Carousel::latest()->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.carousel.index', [
            'carousels' => $carousels
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
        $product = Product::get();
        return response()->view('admin.carousel.create', [

            'productw' => $product
        ]);
        // return response()->view('admin.productCategory.create');
    }
    public function store(Request $request)
    {
        // return $request->input('picture_default');
        // return $request->input('varian_name');
        $validated = $request->validate([
            'title' => ['required'],
            'picture' => ['required'],
            'description'  => ['sometimes', 'nullable'],
        ]);


        return redirect('carousel')->with('success', 'Data Carousel has been created!');
    }
    public function edit(Carousel $carousel)
    {
        //
        $products = Product::get();
        
        return response()->view('admin.carousel.edit', [
            'carousel' => $carousel,
            'products' => $products,
        ]);
    }
    public function update(Request $request,Carousel $carousel)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'picture' => ['required'],
            'product_id'  => ['sometimes', 'nullable'],
            'description'  => ['sometimes', 'nullable'],
        ]);
        DB::beginTransaction();
        
        $carousel->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'product_id' => $request->input('product_id'),
            
        ]);
        $path = 'carousel';
        $picture_default = $request->input('picture');
        if (!empty($picture_default)) {
            # code...
            // $file_name = $dataProduct['product_code'].'_default';
            $file_name = 'Carousel_'.$carousel->id.'.png';
            $url = self::upploadFile($picture_default,$path,$file_name);
            $carousel->update([ 
                        'picture' => $url,
            ]);
        }
        DB::commit();
        return redirect('carousel')->with('success', 'Data Carousel has been updated!');
    }

    public function activated(Carousel $carousel)
    {
        //
        $carousel->activated();
        
        return redirect('carousel')->with('success', 'Data Carousel has been Activated!');
    }
    public function nonactive(Carousel $carousel)
    {
        //
        $carousel->nonactive();
        // return $address;
        return redirect('carousel')->with('success', 'Data Carousel has been nonactive!');
    }
    function upploadFile($file,$path,$file_name){
  
        $image = Image::make($file->getRealPath());
        $image->encode('jpg', 70); 
        // $image->resize(320, 240); 
        $file_compressed = $image;

        $fullPath = "{$path}/{$file_name}";
        // $img = Image::make('public/foo.jpg')->resize(320, 240)->insert('public/{$path}/{$file_name}');
        Storage::disk('public')->put($fullPath, $file_compressed);
        // $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name;
        return $url;
    }
}
