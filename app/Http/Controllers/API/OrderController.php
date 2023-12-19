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
            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $address = $request->input('address');
            $price = $request->input('price');
            $shipping_price = $request->input('phone');
            $price_total = $request->input('price_total');
            $total_payment = $request->input('total_payment');
            $order_status_id = 1;
            $expedition_id = null;
            $order_type = $request->input('order_type');
            $note =$request->input('note');
            $product_varian_ids = $request->input('product_varian_ids');
            $qty_orders =$request->input('qty_orders');
            $discounts =$request->input('discounts');
            $img_payment =$request->input('img_payment');

            $this->orderService->create2($order_no,$name,$phone,$email,$address,$price,$shipping_price,$price_total,$total_payment,$order_status_id,$expedition_id,$order_type,$note,$product_varian_ids,$qty_orders,$discounts,$img_payment);
            return response()->json([
                'success' => true,
                'message' => 'Data Order berhasil diproses.'
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
