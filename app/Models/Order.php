<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function expedition()
    {
        return $this->belongsTo(Expedition::class, 'id', 'expedition_id');
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
