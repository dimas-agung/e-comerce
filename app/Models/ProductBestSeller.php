<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBestSeller extends Model
{
    use HasFactory;
    protected $guard = [];
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
