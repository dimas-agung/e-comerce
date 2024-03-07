<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    
    private OrderService $orderService;
    public function __construct() {
        $this->orderService =  new OrderService();
    }
    function index(Request $request){
        
        $users_id = $request->input('users_id');
        $order_id = $request->input('order_id');

        if ($order_id && $users_id) {
            # code...
            $orders= Order::with(['detail.product'])->where('id',$order_id)->where('users_id',$users_id)->latest()->first();

        }elseif ($users_id) {
            # code...
            $orders= Order::with(['detail.product'])->where('users_id',$users_id)->latest()->get();

        }elseif ($order_id) {
            # code...
            $orders= Order::with(['detail.product'])->where('id',$order_id)->latest()->first();

        }else{
            $orders= Order::with(['detail.product'])->latest()->get();
        }

        return $orders;
    }
    function getAllOrderUser(Request $request){
        $users_id = $request->input('users_id');
         $new_orders = Order::with(['detail.product'])->where('order_status_id',Order::WAITING_DP_STATUS)->where('users_id',$users_id)->latest()->get();
        $orders_processed = Order::with(['detail.product'])->where('order_status_id',Order::READY_DP_STATUS)->where('users_id',$users_id)->latest()->get();
        $orders_ready_shipping = Order::with(['detail.product'])->where('order_status_id',Order::READY_SHIPPING_STATUS)->where('users_id',$users_id)->latest()->get();
        $orders_shipping = Order::with(['detail.product'])->where('order_status_id',Order::SHIPPING_STATUS)->where('users_id',$users_id)->latest()->get();
        $orders_success = Order::with(['detail.product'])->where('order_status_id',Order::SUCCESS_STATUS)->where('users_id',$users_id)->latest()->get();
        $orders_calcelled = Order::with(['detail.product'])->where('order_status_id',Order::CANCEL_STATUS)->where('users_id',$users_id)->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Order berhasil diproses.',
            'data' => [
                'new_orders' => $new_orders,
                'orders_processed' => $orders_processed,
                'orders_ready_shipping' => $orders_ready_shipping,
                'orders_shipping' => $orders_shipping,
                'orders_success' => $orders_success,
                'orders_calcelled' => $orders_calcelled,
            ],
        ], 201); 
    }
    function getPendingDPOrder(Request $request)
    {
        $users_id = $request->input('users_id');
        $new_orders = Order::where(['users_id'=>$users_id,'order_status_id'=>Order::WAITING_DP_STATUS])->latest()->get();
        return $new_orders;
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
    function checkout(Request $request){
        try {
            //code...
            $users_id = $request->input('users_id');
            $address_id = $request->input('address_id');
            $cart_id = $request->input('cart_id');
            $note = $request->input('note');
            $order_type = $request->input('order_type');
            $price = $request->input('price');
            $shipping_price =$request->input('shipping_price');;
            $user = User::find($users_id);
            $last_order_id = Order::latest()->first() ? Order::latest()->first()->id :0;
            $order_no = 'ORDER'.$last_order_id+1;
            $address= Address::with(['district.city.province'])->where('id',$address_id)->first();
            $district_name = $address->district->name;
            $city_name = $address->district->city->name;
            $province_name = $address->district->city->province->name;
            $address_detail = $address->address;
            $dataAddress = $address_detail.', '.$district_name.', '. $city_name.', '.$province_name; 
            
            $name = $address->fullname;
            $email = $user->email;
            $phone = $address->phone_number;
            $address = $dataAddress;
          
            $price_total = $price+$shipping_price;
            $total_payment = $price_total;
            $order_status_id = 1;
            $expedition_id = 1;
           

            $order = $this->orderService->checkout(
                $users_id,
                $order_no,
                $name,
                $phone,
                $email,
                $dataAddress,
                $price,
                $shipping_price,
                $price_total,
                $total_payment,
                $order_status_id,
                $expedition_id,
                $order_type,
                $note,
                $cart_id,
            );
            $dataOrder = Order::with('detail.product')->where('order_no',$order->order_no)->first();
            CartDetail::where('carts_id',$cart_id)->delete();
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
    public function cancel(Request $request)
    {
        //
        $validated = $request->validate([
            'orders_id' => ['required'],
            'reason_cancel' => ['required'],
        ]);
        $order = Order::where(['id' => $request->input('orders_id')])->first();

        $order->update([
            'reason_cancel' => $request->input('reason_cancel'),
            'order_status_id' => 6
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data Order has been canceled!',
            'data' => $order,
        ], 201); 
        // return redirect('order')->with('success', 'Data Order has been canceled!');
    }
}