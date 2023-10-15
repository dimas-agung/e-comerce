<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    // protected $table = 'product_categories';
    protected $fillable = [
        'name',
    ];
    public function city()
    {
        return $this->belongsTo(Cities::class, 'provinces_id', 'id');
    }
   
}