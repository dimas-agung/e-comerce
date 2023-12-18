<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const WAITING_DP_STATUS = 1;
    public const READY_DP_STATUS = 2;
    public const WAITING_PAYMENT_STATUS = 3;
    public const READY_PAYMENT_STATUS = 4;
    public const READY_SHIPPING_STATUS = 5;
    public const SHIPPING_STATUS = 6;
    public const SUCCESS_STATUS = 7;
    public const CANCEL_STATUS = 8;

    public function expedition()
    {
        return $this->belongsTo(Expedition::class, 'id', 'expedition_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'orders_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'id', 'order_status_id');
    }

}
