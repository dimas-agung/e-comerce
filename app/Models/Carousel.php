<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    protected $table = 'carousel';
    protected $fillable = [
       'picture','title','description','product_id','is_active'
    ];
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
