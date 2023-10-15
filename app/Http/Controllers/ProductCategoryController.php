<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Database\Seeders\ProductsSeeder;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productCategory = ProductCategory::latest()->paginate(10);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => ['required'],

        ]);
        $productCategory = ProductCategory::create($validated);
        return redirect('product_category')->with('success', 'Data Product Category has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
        return $productCategory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
        // return response()->view('admin.productCategory.edit', [
        //     'productCategory' => $productCategory
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $productCategory->update($validated);
        return redirect('product_category')->with('success', 'Data Product Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
        $productCategory->delete();
        return redirect('product_category')->with('success', 'Data Product Category has been deleted!');
    }
}