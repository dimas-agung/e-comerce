<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $discount = Discount::latest()->paginate(10);
        // return $discount;
        // return response()->view('admin.discount.index', [
        //     'discount' => $discount
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
        // return response()->view('admin.discount.create');
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
            'discount_code' => ['required'],
            'products_id' => ['required'],
            'minimum_order' => ['required'],
            'persen' => ['required'],
            'description' => ['sometimes','nullable'],
            'start_at' => ['required'],
            'end_at' => ['required'],
        ]);
        $discount = Discount::create($validated);
        return redirect('discount')->with('success', 'Data discount has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
        return $discount;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
        // return response()->view('admin.discount.edit', [
        //     'discount' => $discount
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
        $validated = $request->validate([
            'products_id' => ['required'],
            'discount_code' => ['required'],
            'minimum_order' => ['required'],
            'persen' => ['required'],
            'description' => ['sometimes','nullable'],
            'start_at' => ['required'],
            'end_at' => ['required'],
        ]);
        $discount->update($validated);
        return redirect('discount')->with('success', 'Data discount has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
        $discount->delete();
        return redirect('discount')->with('success', 'Data discount has been deleted!');
    }
}