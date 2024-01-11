<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $new_orders = Order::where('order_status_id',Order::WAITING_DP_STATUS)->latest()->get();
        $orders_processed = Order::where('order_status_id',Order::READY_DP_STATUS)->latest()->get();
        $orders_ready_shipping = Order::where('order_status_id',Order::READY_SHIPPING_STATUS)->latest()->get();
        $orders_shipping = Order::where('order_status_id',Order::SHIPPING_STATUS)->latest()->get();
        $orders_success = Order::where('order_status_id',Order::SUCCESS_STATUS)->latest()->get();
        $orders_calcelled = Order::where('order_status_id',Order::CANCEL_STATUS)->latest()->get();
        return response()->view('admin.dashboard',[
            'new_orders' => $new_orders,
            'orders_processed' => $orders_processed,
            'orders_ready_shipping' => $orders_ready_shipping,
            'orders_shipping' => $orders_shipping,
            'orders_success' => $orders_success,
            'orders_calcelled' => $orders_calcelled,
        ]);
    }
}
