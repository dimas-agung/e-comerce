<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = [
        'name',
    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'product_categories_id', 'id');
    }
    public function active_product() {
        return $this->product()->where('is_active','=', 1);
    }
}