<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $table = 'series';
    protected $fillable = [
       'picture','title','description','product_cotegory_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    function activated() {
        $this->update(['is_active'=>1]);
    }
    function nonactive() {
        $this->update(['is_active'=>0]);
    }
}
