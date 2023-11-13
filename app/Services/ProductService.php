<?php
namespace App\Services;

use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductVarian;
use App\Models\Varian;
use App\Models\VarianDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
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
            'order_type' => $dataProduct['order_type'],
            'order_period' => $dataProduct['order_period'],
            'description' => $dataProduct['description'],
        ]);
        $path = 'products';
        $picture_default = $dataProduct['picture_default'];

        // $file_name = $dataProduct['product_code'].'_default.png';
        $file_name = 'Product_'.$product->id.'_default.png';
        $url = self::upploadFile($picture_default,$path,$file_name);
        $product->update([ 
                    'picture_default' => $url,
        ]);
          for ($i=1; $i <= 4; $i++) { 
            # code...
            $keyPicture = 'picture_'.$i;
            $picture = $dataProduct[$keyPicture];
            if(!empty($picture)){  
                  
                // $file_name = $dataProduct['product_code'].'_'.$i.'.png';
                $file_name = 'Product_'.$product->id.'_'.$i.'.png';
                $url = self::upploadFile($picture,$path,$file_name);
                $product->update([ 
                    $keyPicture => $url,
                ]);
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
            'order_type' => $dataProduct['order_type'],
            'order_period' => $dataProduct['order_period'],
            'description' => $dataProduct['description'],
        ]);
        $path = 'products';
        $picture_default = $dataProduct['picture_default'];
        if (!empty($picture_default)) {
            # code...
            // $file_name = $dataProduct['product_code'].'_default.png';
            $file_name = 'Product_'.$product->id.'_default.png';
            $url = self::upploadFile($picture_default,$path,$file_name);
            $product->update([ 
                        'picture_default' => $url,
            ]);
        }
          for ($i=1; $i <= 4; $i++) { 
            # code...
            $keyPicture = 'picture_'.$i;
            $picture = $dataProduct[$keyPicture];
            if(!empty($picture)){  
                  
                // $file_name = $dataProduct['product_code'].'_'.$i.'.png';
                $file_name = 'Product_'.$product->id.'_'.$i.'.png';
                $url = self::upploadFile($picture,$path,$file_name);
                $product->update([ 
                    $keyPicture => $url,
                ]);
            }
        }
        // // delete varian
        // $varianids = [];
        $lastVarian = Varian::where('products_id',$product->id)->get();
        foreach ($varians as $key => $varian) {
            foreach($lastVarian as $key=>$value){
                if ($varian['name'] != $value->name) {
                    Varian::where('id',$value->id)->delete();
                    $varianNew = Varian::create([
                        'products_id' => $product->id,
                        'name' => $value['name'],
                    ]);
                    $varianids[] = $varianNew;
                }else{
                    
                    $varianids[] = $value;
                }
            }
        }
        
        $varian_detail_ids = [];
        $lastVarianDetails = VarianDetail::whereIn('varians_id',$varianids)->get();
        foreach ($varian_details as $key1 => $varianD) {
            $varianid = $varianids[$key]->id;
            foreach($lastVarianDetails as $key=>$value){
                if ($varianD != $value->name) {
                    VarianDetail::where('id',$value->id)->delete();
                    $varian_detail_ids[] = self::addVarianDetails($varianid,$varianD);
                }
                $varian_detail_ids[] = $value->id;
            }
        }
        $lastVarian = Varian::where('products_id',$product->id)->get();
        $varian_details = [];
        foreach($lastVarian as $ke=>$val){
            $varian_details[] =VarianDetail::where('varians_id',$value->id)->get();
        }
        // $lastVarianDetails = VarianDetail::whereIn('varians_id',$varianids)->get();
        if (count($lastVarian) > 1) {
            # code...
            foreach ($varian_details[0] as $key => $value1) {
                $lastProductVarians = ProductVarian::where('products_id',$product->id)->where('varian_detail_id_1',$value1->id)->get();
                if (empty($lastProductVarians)) {
                    ProductVarian::where('products_id',$product->id)->where('varian_detail_id_1',$value1->id)->delete();
                }
                foreach ($varian_details[1] as $key => $value2) {
                    $checkProductVarian = ProductVarian::where('varian_detail_id_1',$value1->id)->where('varian_detail_id_2',$value2->id)->where('products_id',$product->id)->first();
                    if (empty($checkProductVarian)) {
                        # code...
                        $productVarians = ProductVarian::create([
                            'products_id' => $product->id,
                            'varian_detail_id_1' => $value1->id,
                            'varian_detail_id_2' => $value2->id,
                        ]);
                    }else{
                        ProductVarian::where('varian_detail_id_1',$value1->id)->where('varian_detail_id_2',$value2->id)->where('products_id',$product->id)->delete();
                    }
                }
            }
        }else{
            foreach ($varian_details[0] as $key => $value1) {
                $checkProductVarian = ProductVarian::where('varian_detail_id_1',$value1->id)->where('products_id',$product->id)->first();
                if (empty($checkProductVarian)) {
                    $productVarians = ProductVarian::create([
                        'products_id' => $product->id,
                        'varian_detail_id_1' => $value1->id,
                        'varian_detail_id_2' => null,
                    ]);
                }else{
                    $checkProductVarian->delete();
                }
            }
        }
        // // VarianDetail::where('products_id',$product->id)->delete();
        // ProductVariran::where('products_id'.$product->id)->delete();
        // $datavarian = [];
        // $varian_detail_ids = [];
        // foreach ($varians as $key => $value) {
        //     $varian = Varian::create([
        //         'products_id' => $product->id,
        //         'name' => $value['name'],
        //     ]);
        //     $datavarian[] = $varian;
        //     $varian_detail_ids[] = self::addVarianDetails($varian,$varian_details[$key]);
        // }
        
        // if (count($varians) > 1) {
        //     # code...
        //     foreach ($varian_detail_ids[0] as $key => $value1) {
        //         # code...
        //         foreach ($varian_detail_ids[1] as $key => $value2) {
        //             $productVarians = ProductVarian::create([
        //                 'products_id' => $product->id,
        //                 'varian_detail_id_1' => $value1,
        //                 'varian_detail_id_2' => $value2,
        //             ]);
        //         }
        //     }
        // }else{
        //     foreach ($varian_detail_ids[0] as $key => $value1) {
        //         $productVarians = ProductVarian::create([
        //             'products_id' => $product->id,
        //             'varian_detail_id_1' => $value1,
        //             'varian_detail_id_2' => null,
        //         ]);
        //     }
        // }
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
    function checkProductDiscount($products_id,$qty) {
        $date = date('Y-m-d');
        $discount = Discount::where('products_id',$products_id)->where('qty','<=', $qty)->where('end_at','<=',$date)->first();
        if ($discount) {
           return $discount->persen;
        }
        return 0;
    }
    function upploadFile($files,$path,$file_name){
        $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name;
        return $url;
    }
}