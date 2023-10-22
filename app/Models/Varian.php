<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function detail()
    {
        return $this->hasMany(VarianDetail::class, 'varians_id', 'id');
    }
}