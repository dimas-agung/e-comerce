<?php

namespace App\Http\Controllers;

use App\Models\ProductBestSeller;
use Illuminate\Http\Request;

class ProductBestSellerController extends Controller
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
        $productBestSeller = ProductBestSeller::latest()->paginate(10);
        // return $productBestSeller;
        return response()->view('admin.product_best_seller.index', [
            'productBestSeller' => $productBestSeller
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
        $validated = $request->validate([
            'product_id' => ['required'],

        ]);
        $productBestSeller = ProductBestSeller::create($validated);
        return redirect('product_best_seller')->with('success', 'Data Product Best Seller has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBestSeller $productBestSeller)
    {
        //
        return $productBestSeller;
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
    public function update(Request $request, ProductBestSeller $productBestSeller)
    {
        //
        $validated = $request->validate([
            'product_id' => ['required'],
        ]);
        $productBestSeller->update($validated);
        return redirect('product_best_seller')->with('success', 'Data Product Best Seller has been updated!');
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
}
