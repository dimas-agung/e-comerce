<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = [
        'fullname' ,
            'users_id' ,
            'phone_number' ,
            'provinces_id' ,
            'cities_id' ,
            'districts_id' ,
            'villages_id' ,
            'address' ,
            'postal_code' ,
            'is_active',
            'label' ,
    ];

    function activated() {
        $this->update(['is_active'=>1]);
    }
    function nonactive() {
        $this->update(['is_active'=>0]);
    }
}