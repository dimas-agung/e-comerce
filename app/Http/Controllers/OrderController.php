<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\ProductVarian;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $orderService;
    public function __construct() {
        $this->orderService =  new OrderService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $order = Order::latest()->paginate(10);
        $product_varian = ProductVarian::with(['product','varian_detail1','varian_detail2'])->find(1);
        OrderStatusHistory::create([
            'order_id' => 1,
            'order_status_id' => 2
        ]);
        $order_hystorys = OrderStatusHistory::all();
        return $order_hystorys;
        // return $order;
        // return response()->view('admin.productCategory.index', [
        //     'productCategory' => $order
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
            'order_no' => ['required'],
            'address' => ['required'],
            'price' => ['required'],
            'shipping_price' => ['required'],
            'price_total' => ['required'],
            'total_payment' => ['sometimes', 'nullable'],
            'order_status_id' => ['required'],
            'expedition_id' => ['required'],
            'order_type' => ['required'],
            'note' => ['sometimes', 'nullable'],
            // 'products_id.*'  => ['required','min:1'],
            'product_varian_id.*'  => ['required','min:1'],
            'qty.*'  => ['required','min:1'],
            // 'price_detail.*'  => ['required','min:1'],
            'discount.*'  => ['required','min:1'],
        ]);
        $this->orderService->create(
            $request->input('order_no'),
            $request->input('address'),
            $request->input('price'),
            $request->input('shipping_price'),
            $request->input('price_total'),
            $request->input('total_payment'),
            $request->input('order_status_id'),
            $request->input('expedition_id'),
            $request->input('order_type'),
            $request->input('note'),
            $request->input('product_varian_id'),
            $request->input('qty_order'),
            $request->input('discounts')
        );
        // $order = Order::create($validated);
        return redirect('order')->with('success', 'Data Order has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        // return response()->view('admin.productCategory.edit', [
        //     'productCategory' => $order
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $validated = $request->validate([
            'order_status_id' => ['required'],
        ]);
        $order->update($validated);
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'order_status_id' => $request->input('order_status_id'),
        ]);
        
        return redirect('order')->with('success', 'Data Order has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request,Order $order)
    {
        //
        $validated = $request->validate([
            'reason_cancel' => ['required'],
        ]);
        $order->update([
            'reason_cancel' => $request->input('reason_cancel'),
            'order_status_id' => 6
        ]);
        return redirect('order')->with('success', 'Data Order has been canceled!');
    }
}
