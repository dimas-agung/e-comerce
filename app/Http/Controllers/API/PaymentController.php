<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    private $paymentService;
    public function __construct() {
        $this->paymentService =  new PaymentService();
    }
    function store(Request $request){
        $image = $request->file('image');
        // return $image;
        $order_no = $request->input('order_no');
        $data = $this->paymentService->create($order_no,$image);
        return response()->json([
            'success' => true,
            'message' => 'Data Order berhasil diproses.',
            'data' => $data,
        ], 201); 
    }
}
