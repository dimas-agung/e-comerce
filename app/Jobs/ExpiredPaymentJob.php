<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExpiredPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $orders = Order::where('order_status_id',Order::WAITING_DP_STATUS)->doesntHave('payment')->get();
        // Log::channel('info')->info($orders);
        foreach ($orders as $key => $value) {
            $diff = now()->diffInMinutes($value->created_at);
            if(($diff/60) >= 24){
                $order = Order::where('id',$value->id)->update(['order_status_id' => Order::CANCEL_STATUS,'reason_cancel' => 'Order melebihi batas waktu pembayaran' ]);
                Log::channel('info')->info('Order Kode :' .$value->order_no.' melebihi batas waktu pembayaran');
            }
        }
    }
}