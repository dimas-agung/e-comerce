<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExpiredOrderShipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        //cek order expired
        $orders = Order::where('order_status_id',Order::SHIPPING_STATUS)->get();
        foreach ($orders as $key => $value) {
            $diff = now()->diffInDays($value->updated_at);
            if($diff >= 14){
                $order = Order::where('id',$value->id)->update(['order_status_id' => Order::SUCCESS_STATUS ]);
                Log::channel('info')->info('Order Kode :' .$order->order_no.' telah selesai otomatis');
            }
        }
    }
}
