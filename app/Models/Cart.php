<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function detail()
    {
        return $this->hasMany(CartDetail::class, 'carts_id', 'id');
    }
}
