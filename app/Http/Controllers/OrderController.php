<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Jobs\ExpiredOrderShipJob;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Expedition;
use App\Models\ProductVarian;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    private OrderService $orderService;
    public function __construct() {
        $this->orderService =  new OrderService();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $new_orders = Order::where('order_status_id',Order::WAITING_DP_STATUS)->latest()->get();
        $new_orders = Order::where('order_status_id',Order::WAITING_DP_STATUS)->latest()->get();
        $orders_processed = Order::where('order_status_id',Order::READY_DP_STATUS)->latest()->get();
        $orders_ready_shipping = Order::where('order_status_id',Order::READY_SHIPPING_STATUS)->latest()->get();
        $orders_shipping = Order::where('order_status_id',Order::SHIPPING_STATUS)->latest()->get();
        $orders_success = Order::where('order_status_id',Order::SUCCESS_STATUS)->latest()->get();
        $orders_calcelled = Order::where('order_status_id',Order::CANCEL_STATUS)->latest()->get();
        return response()->view('admin.order.index',[
            'new_orders' => $new_orders,
            'orders_processed' => $orders_processed,
            'orders_ready_shipping' => $orders_ready_shipping,
            'orders_shipping' => $orders_shipping,
            'orders_success' => $orders_success,
            'orders_calcelled' => $orders_calcelled,
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
        $customers = User::with('address')->get();
        $products = Product::get();
        // return $customers;
        return response()->view('admin.order.create',[
            'customers' => $customers,
            'products' => $products
        ]);
       
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
        $count_order_this_day = Order::whereDate('created_at', today())->count();
            $order_no = generate_order_no($count_order_this_day);
        $this->orderService->create(
            $order_no,
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
    public function updatePayment(Request $request, Order $order)
    {
        $nominal_transfer = $request->input('total_payment');
        $order->update(['total_payment' => $nominal_transfer]);
        $payment = Payment::where(['orders_id'=>$order->id])->latest()->first();
        $payment->update(['nominal' => $nominal_transfer]);
        return redirect('order')->with('success', 'Data Order has been updated!');
        // return $order;
    }
    public function addPayment(Request $request, Order $order)
    {
        $nominal_transfer = $request->input('total_payment');
        $last_total_payment = $order->total_payment ? 0 : $order->total_payment;
        $nominal_transfer += $last_total_payment;
        $order->update(['total_payment' => $nominal_transfer]);
        $payment = Payment::create([
            'orders_id' => $order->id,
            'users_id' => $order->users_id,
            'status_payment' => 'PAYMEMT',
            'nominal' => $nominal_transfer,
            'img' => null,
            'note' => 'PAYMEMT',
        ]); 
        return redirect('order')->with('success', 'Data Order has been updated!');
        // return $order;
    }
    public function updateResi(Request $request, Order $order)
    {
        $no_resi = $request->input('no_resi');
        $expedition_id = $request->input('expedition_id');
        $order->update(['no_resi' => $no_resi,'expedition_id'=>$expedition_id]);
        return redirect('order')->with('success', 'Data Order has been updated!');
        // return $order;
    }
    public function updatePayment2(Request $request, Order $order)
    {
        $nominal_transfer = $request->input('total_payment');
        $order->update(['total_payment' => $nominal_transfer]);
        $payment = Payment::where(['orders_id'=>$order->id])->latest()->first();
        $payment->update(['nominal' => $nominal_transfer]);
        return redirect('order')->with('success', 'Data Order has been updated!');
        // return $order;
    }
    public function pushStatus(Request $request, Order $order)
    {
        $OrderStatusId = $request->input('status');
        $order->update(['order_status_id' => $OrderStatusId]);
        return redirect('order')->with('success', 'Data Order has been updated!');
        // return $order;
    }
    public function exportReport(Request $request)
    {
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        return Excel::download(new OrdersExport($start_date,$end_date), 'order '.$start_date.'-'.$end_date.'.xlsx');
        // return $order;
    }
}