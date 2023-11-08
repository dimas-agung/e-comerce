<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVarian extends Model
{
    use HasFactory;
    protected $table = 'product_varians';
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
    public function varian_detail1()
    {
        return $this->belongsTo(VarianDetail::class, 'varian_detail_id_1', 'id');
    }
    public function varian_detail2()
    {
        return $this->belongsTo(VarianDetail::class, 'varian_detail_id_2', 'id');
    }
    function activated() {
        $this->update(['is_active'=>1]);
    }
    function nonactive() {
        $this->update(['is_active'=>0]);
    }
}