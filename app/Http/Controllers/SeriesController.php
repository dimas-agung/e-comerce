<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $series = Series::latest()->get();
        // return $productBestSeller;
        return response()->view('admin.series.index',[
            'series'=> $series
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
        // return response()->view('admin.productBestSeller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
          // return $request->input('varian_name');
        $validated = $request->validate([
            'title' => ['required'],
            'picture' => ['required'],
            'description'  => ['sometimes', 'nullable'],
        ]);


        return redirect('carousel')->with('success', 'Data Carousel has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        //
        $product_category = ProductCategory::get();
        
        return response()->view('admin.series.edit', [
            'carousel' => $series,
            'product_category' => $product_category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBestSeller $productBestSeller)
    {
        //
        // return response()->view('admin.productBestSeller.edit', [
        //     'productBestSeller' => $productBestSeller
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        DB::beginTransaction();
        $series= Series::find($request->input('series_id'));
        $series->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'product_category_id' => $request->input('product_category_id'),
            'is_active' => $request->input('is_active') ?? 1,
        ]);
        $path = 'carousel';
        $picture_default = $request->file('picture');
        // return $picture_default;
        if (!empty($picture_default)) {
            # code...
            // $file_name = $dataProduct['product_code'].'_default';
            $file_name = 'Series_'.$series->id.'.png';
            $url = self::upploadFile($picture_default,$path,$file_name);
            // return $url;
            $series->update([ 
                'picture' => $url,
            ]);
        }
        // return $picture_default;
        DB::commit();
        // return 123;
        return redirect('landing_page')->with('success', 'Data Series has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBestSeller $productBestSeller)
    {
        //
        $productBestSeller->delete();
        return redirect('product_best_seller')->with('success', 'Data Product Best Seller has been deleted!');
    }
    function upploadFile($file,$path,$file_name){
  
        $image = Image::make($file->getRealPath());
        $image->encode('jpg', 70); 
        // $image->resize(320, 240); 
        $file_compressed = $image;

        $fullPath = "{$path}/{$file_name}";
        // $img = Image::make('public/foo.jpg')->resize(320, 240)->insert('public/{$path}/{$file_name}');
        Storage::disk('public')->put($fullPath, $file_compressed);
        $file_name2= $file_name.'-mobile';
        $fullPath = "{$path}/{$file_name2}";
        $img1 = Image::make($image)->resize(400, 800)->encode();
        Storage::disk('public')->put($fullPath, $img1);
        // $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name;
        return $url;
    }
}