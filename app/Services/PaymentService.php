<?php
namespace App\Services;

use App\Models\Order;

use App\Models\Payment;


class PaymentService
{
    
    private UploadService $uploadService;
    public function __construct() {
        $this->uploadService =  new UploadService();
    }
    function create( $order_no,$img_transfer) {
        $order = Order::where(['order_no' => $order_no])->first();
        $path = 'payment';
        $picture = $img_transfer;
        $file_name = 'DP_'.$order->order_no.'.png';
        $url = $this->uploadService->upploadFile($picture,$path,$file_name);
        // PAYMENY
        $payment = Payment::create([
            'orders_id' => $order->id,
            'users_id' => 1,
            'status_payment' => 'DP',
            'nominal' => $order->total_payment,
            'img' => $url,
            'note' => 'DP',
        ]); 
        return $payment;
    }
    function history($order_id) {
        return Payment::where(['orders_id',$order_id])->get();
    }
}