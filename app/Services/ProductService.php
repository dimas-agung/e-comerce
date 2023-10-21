<?php
namespace App\Services;
use App\Models\Product;
use App\Models\ProductVarian;
use App\Models\Varian;
use App\Models\VarianDetail;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct() {
    }

    function create(Array $dataProduct, Array $varians,Array $varian_details) {
        DB::beginTransaction();
        $product = Product::create([
            'product_categories_id' => $dataProduct['product_categories_id'],
            'product_code' => $dataProduct['product_code'],
            'name' => $dataProduct['name'],
            'length' => $dataProduct['length'],
            'width' => $dataProduct['width'],
            'height' => $dataProduct['height'],
            'weight' => $dataProduct['weight'],
            'order_type' => $dataProduct['weight'],
            'description' => $dataProduct['description'],
        ]);
        $path = 'products';
        $picture_default = $dataProduct['picture_default'];
        $file_name = $dataProduct['product_code'].'_default.png';
        $url = self::upploadFile($picture_default,$path,$file_name);
        $product->update([ 
                    'picture_default' => $url,
        ]);
        $pictures = $dataProduct['pictures'];
        if(!empty($pictures)){    
            foreach ($pictures as $key => $value) {
                $no = $key+1;
                $file_name = $dataProduct['product_code'].'_'.$no.'.png';
                $url = self::upploadFile($value,$path,$file_name);
                $product->update([ 
                    'picture_'.$no => $url,
                ]);
                # code...
            }
        }
        $datavarian = [];
        $varian_detail_ids = [];
        foreach ($varians as $key => $value) {
            $varian = Varian::create([
                'products_id' => $product->id,
                'name' => $value['name'],
            ]);
            $datavarian[] = $varian;
            $varian_detail_ids[] = self::addVarianDetails($varian,$varian_details[$key]);
        }
        
        if (count($varians) > 1) {
            # code...
            foreach ($varian_detail_ids[0] as $key => $value1) {
                # code...
                foreach ($varian_detail_ids[1] as $key => $value2) {
                    $productVarians = ProductVarian::create([
                        'products_id' => $product->id,
                        'varian_detail_id_1' => $value1,
                        'varian_detail_id_2' => $value2,
                    ]);
                }
            }
        }else{
            foreach ($varian_detail_ids[0] as $key => $value1) {
                $productVarians = ProductVarian::create([
                    'products_id' => $product->id,
                    'varian_detail_id_1' => $value1,
                    'varian_detail_id_2' => null,
                ]);
            }
        }
        
        
        
        DB::commit();
    }
    function update($product,Array $dataProduct, Array $varians,Array $varian_details) {
        DB::beginTransaction();
        
        $product->update([
            'product_categories_id' => $dataProduct['product_categories_id'],
            'product_code' => $dataProduct['product_code'],
            'name' => $dataProduct['name'],
            'length' => $dataProduct['length'],
            'width' => $dataProduct['width'],
            'height' => $dataProduct['height'],
            'weight' => $dataProduct['weight'],
            'order_type' => $dataProduct['weight'],
            'description' => $dataProduct['description'],
        ]);
        $path = 'products';
        $picture_default = $dataProduct['picture_default'];
        $file_name = $dataProduct['product_code'].'_default.png';
        $url = self::upploadFile($picture_default,$path,$file_name);
        $product->update([ 
                    'picture_default' => $url,
        ]);
        $pictures = $dataProduct['pictures'];
        if(!empty($pictures)){    
            foreach ($pictures as $key => $value) {
                $no = $key+1;
                $file_name = $dataProduct['product_code'].'_'.$no.'.png';
                $url = self::upploadFile($value,$path,$file_name);
                $product->update([ 
                    'picture_'.$no => $url,
                ]);
                # code...
            }
        }
        // delete varian
        Varian::where('products_id'.$product->id)->delete();
        VarianDetail::where('products_id'.$product->id)->delete();
        ProductVarian::where('products_id'.$product->id)->delete();
        $datavarian = [];
        $varian_detail_ids = [];
        foreach ($varians as $key => $value) {
            $varian = Varian::create([
                'products_id' => $product->id,
                'name' => $value['name'],
            ]);
            $datavarian[] = $varian;
            $varian_detail_ids[] = self::addVarianDetails($varian,$varian_details[$key]);
        }
        
        if (count($varians) > 1) {
            # code...
            foreach ($varian_detail_ids[0] as $key => $value1) {
                # code...
                foreach ($varian_detail_ids[1] as $key => $value2) {
                    $productVarians = ProductVarian::create([
                        'products_id' => $product->id,
                        'varian_detail_id_1' => $value1,
                        'varian_detail_id_2' => $value2,
                    ]);
                }
            }
        }else{
            foreach ($varian_detail_ids[0] as $key => $value1) {
                $productVarians = ProductVarian::create([
                    'products_id' => $product->id,
                    'varian_detail_id_1' => $value1,
                    'varian_detail_id_2' => null,
                ]);
            }
        }
        DB::commit();
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
    function addVarianDetails($varian,array $details){
        $varian_detail_ids = [];
        foreach ($details as $key => $value) {
            # code...
            $varian_detail = VarianDetail::create([
                'varians_id' =>$varian->id,
                'varians_name' =>$varian->name,
                'name' => $value,
            ]);
            $varian_detail_ids[] = $varian_detail->id; 
        }
        return $varian_detail_ids;
    }
    function upploadFile($files,$path,$file_name){
        $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name. '_default.png';
        return $url;
    }
}