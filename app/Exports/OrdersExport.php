<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class OrdersExport implements FromView
{
   
    protected $start_date;
    protected $end_date;
    public function __construct($start_date,$end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        return view('admin.export.order', [
            'orders' => OrderDetail::with(['order','product.varians.detail'])->whereBetween('created_at', [$this->start_date, $this->end_date])->get()
        ]);
    }
}