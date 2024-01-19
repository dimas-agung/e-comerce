<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    // protected $table = 'product_categories';
    protected $guard = [];
    public function district()
    {
        return $this->belongsTo(District::class, 'cities_id', 'id');
    }
    public function province()
    {
        return $this->hasOne(Provinces::class, 'id', 'provinces_id');
    }
    
}