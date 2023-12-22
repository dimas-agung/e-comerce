<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVarian;
use App\Models\Varian;
use App\Models\VarianDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OrderService
{
    public function __construct() {
    }

    function create(
        $order_no,
        $address,
        $price,
        $shipping_price,
        $price_total,
        $total_payment,
        $order_status_id,
        $expedition_id,
        $order_type,
        $note,
        Array $product_varian_id,
        Array $qty_order,
        Array $discounts,
     ) 
     {
        DB::beginTransaction();
       $order = Order::create([
        'order_no' => $order_no,
        'address' => $address,
        'price' => $price,
        'shipping_price' => $shipping_price,
        'price_total' => $price_total,
        'total_payment' => $total_payment,
        'order_status_id' => $order_status_id,
        'expedition_id' => $expedition_id,
        'order_type' => $order_type,
        'note' => $note,
        'users_id' => Auth::user()->id
       ]);
       foreach ($product_varian_id as $key => $value) {
            $product_varian = ProductVarian::with(['varian_detail1','varian_detail2'])->find($value);
            $productvarian1 = $product_varian->varian_detail1->varians_name.' '.$product_varian->varian_detail1->name;
            $productvarian2 = '';
            if ($product_varian->varian_detail2) {
                $productvarian2 = $product_varian->varian_detail2->varians_name.' '.$product_varian->varian_detail2->name;
                $product_varian_name = $productvarian1.' - '.$productvarian2 ;
            }
            else{
                $product_varian_name = $productvarian1;
            }
            $qty = $qty_order[$key];
            $discount = $discounts[$key];
            $price_product = $product_varian->price;
            $price_after_discount = $price_product - ($price_product * $discount/100);
            $orderDetail = OrderDetail::create([
                'orders_id' => $order->id,
                'products_id' => 1,
                'product_varian_name' => $product_varian_name,
                // 'shipping_price' => $shipping_price,
                'qty' => $qty,
                'price' => $price_product,
                'discount' => $discount,
                'price_after_discount' => $price_after_discount,
            ]);
            
            
       }
        
        
        DB::commit();
        // return $order;
    }
    function create2(
        $order_no,
        $name,
        $phone,
        $email,
        $address,
        $price,
        $shipping_price,
        $price_total,
        $total_payment,
        $order_status_id,
        $expedition_id,
        $order_type,
        $note,
        array $orderItems,  

     ) 
     {
        DB::beginTransaction();
       $order = Order::create([
        'order_no' => $order_no,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'price' => $price,
        'shipping_price' => $shipping_price,
        'price_total' => $price_total,
        'total_payment' => $total_payment,
        'order_status_id' => $order_status_id,
        'expedition_id' => $expedition_id,
        'order_type' => $order_type,
        'note' => $note,
        'users_id' => 1
       ]);
       foreach ($orderItems as $key => $value) {
            // $product_varian = ProductVarian::with(['varian_detail1','varian_detail2'])->find(8);
            $product_varian = ProductVarian::with(['varian_detail1','varian_detail2'])->find($value['product_varian_id']);
            $productvarian1 = $product_varian->varian_detail1->varians_name.' '.$product_varian->varian_detail1->name;
            $productvarian2 = '';
            if ($product_varian->varian_detail2) {
                $productvarian2 = $product_varian->varian_detail2->varians_name.' '.$product_varian->varian_detail2->name;
                $product_varian_name = $productvarian1.' - '.$productvarian2 ;
            }
            else{
                $product_varian_name = $productvarian1;
            }
            $qty = $value['qty'];
            $discount = 0;
            $price_product = $product_varian->price;
            $price_after_discount = $price_product - ($price_product * $discount/100);
            $orderDetail = OrderDetail::create([
                'orders_id' => $order->id,
                'products_id' => $product_varian->products_id,
                'product_varian_name' => $product_varian_name,
                // 'shipping_price' => $shipping_price,
                'qty' => $qty,
                'price' => $price_product,
                'discount' => $discount,
                'price_after_discount' => $price_after_discount,
            ]);
            
            
       }
        
        
        DB::commit();
        return $order;
    }
    public function pushStatus(Order $order, int $OrderStatusId)
    {
        $order->update(['order_status_id' => $OrderStatusId]);
        return $order;
    }
    function upploadFile($file,$path,$file_name){
       
    
        $image = Image::make($file->getRealPath());
        $image->encode('jpg', 90); 
        // $image->resize(320, 240); 
        $file_compressed = $image;

        $fullPath = "{$path}/{$file_name}";
        // $img = Image::make('public/foo.jpg')->resize(320, 240)->insert('public/{$path}/{$file_name}');
        Storage::disk('public')->put($fullPath, $file_compressed);
        // $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name;
        return $url;
    }


}