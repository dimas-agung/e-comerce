<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    
    private OrderService $orderService;
    public function __construct() {
        $this->orderService =  new OrderService();
    }
    function store(Request $request){
        try {
            //code...
            $last_order_id = Order::latest()->first() ? Order::latest()->first()->id :0;
            $order_no = 'ORDER'.$last_order_id+1;
            $biodata = (object)$request->input('biodata');
        
           
            $name = $biodata->name;
            $email = $biodata->email;
            $phone = $biodata->phone;
            $address = $biodata->address;
            $note = $biodata->note;
            $order_type = $request->input('order_type');
            $orderItems = $request->input('order_items');
            $price = collect($orderItems)->sum('price');
            $shipping_price =0;
            $price_total = $price+$shipping_price;
            $total_payment = $price_total/2;
            $order_status_id = 1;
            $expedition_id = null;
           

            $order = $this->orderService->create2(
                $order_no,
                $name,
                $phone,
                $email,
                $address,
                $price,
                $shipping_price,
                $price_total,
                $total_payment,
                $order_status_id,
                $expedition_id,
                $order_type,
                $note,
                $orderItems,
                // $product_varian_ids,
                // $qty_orders,
                // $discounts
            );
            $dataOrder = Order::with('detail.product')->where('order_no',$order->order_no)->first();
            return response()->json([
                'success' => true,
                'message' => 'Data Order berhasil diproses.',
                'data' => $dataOrder,
            ], 201); 
           
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data data.',
                'error' => $e->getMessage()
            ], 422); 
        }
    }
}
