<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product_varian()
    {
        return $this->hasOne(ProductVarian::class, 'id', 'product_varians_id');
    }
}
