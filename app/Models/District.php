<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $guard = [];
    public function village()
    {
        return $this->belongsTo(Village::class, 'district_id', 'id');
    }
    public function city()
    {
        return $this->hasOne(Cities::class, 'id', 'cities_id');
    }
}