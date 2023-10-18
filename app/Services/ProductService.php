<?php

use App\Models\Varian;
use App\Models\VarianDetail;

class ProductService
{
    public function __construct() {
    }

    function create() {
        
    }
    function addVarians($product_id,$varians){
        foreach ($varians as $key => $value) {
            $varian = Varian::create([
                'product_id' => $product_id,
                'name' => $value->name,
            ]);
            self::addVarianDetails($varian->id,$value->details);
        }
    }
    function addVarianDetails($varian_id,$details){
        $varian_detail = VarianDetail::create([
            'varian_id' =>$varian_id,
            'picture_id' => $details,
        ]);
    }
}
