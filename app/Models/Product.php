<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories_id', 'id');
    }
    public function varians()
    {
        return $this->hasMany(Varian::class, 'products_id', 'id');
    }
    public function product_varian()
    {
        return $this->hasMany(ProductVarian::class, 'products_id', 'id');
    }
    function activated() {
        $this->update(['is_active'=>1]);
    }
    function nonactive() {
        $this->update(['is_active'=>0]);
    }
    
}