<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    function index(Request $request){
        $users_id = $request->input('user_id');
        if ($users_id) {
            # code...
            return Cart::with(['detail.product_varian.varian_detail1','detail.product_varian.varian_detail2','detail.product_varian.product'])->where('users_id',$users_id)->first();
        }
        return Cart::with(['detail.product_varian.varian_detail1','detail.product_varian.varian_detail2','detail.product_varian.product'])->get();
    }
    function store(Request $request)  {
        try {
            $product_varians_id = $request->input('product_varian_id');
            $users_id = $request->input('user_id');
            $cart = Cart::where('users_id',$users_id)->first();
            if (empty($cart)) {
                $cart = Cart::create([
                    'users_id' => $users_id,
                    'order_type' => 'PRE ORDER',
                ]);
                # code...
            }
            $cart_item = CartDetail::where(['carts_id' => $cart->id,'product_varians_id' => $product_varians_id])->first();
            if (empty($cart_items)) {
                // jika belum ada
                $cart_item = CartDetail::create([
                    'product_varians_id' => $product_varians_id,
                    'qty' => $request->input('qty'),
                ]);
                # code...
            }else{
                //jika sudah ada produk sebelumnya d cart
                $cart_item->update([
                    'qty' => (int )$cart_item->qty+1
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Cart berhasil disimpan.',
                'data' => $cart,
            ], 201); 
           
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data data.',
                'error' => $e->getMessage()
            ], 422); 
        }
    }
    function update(Request $request)  {
        try {
            $product_varians_id = $request->input('product_varians_id');
            $users_id = $request->input('user_id');
            $cart_item = CartDetail::where(['users_id' => $users_id,'product_varians_id' => $product_varians_id])->first();
            
                //jika sudah ada produk sebelumnya d cart
                $cart_item->update([
                    'qty' => (int )$cart_item->qty+1
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Data Cart berhasil diupdate.',
                'data' => $cart_item,
            ], 201); 
           
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data data.',
                'error' => $e->getMessage()
            ], 422); 
        }
    }
    function delete(Request $request)  {
        try {
            $product_varians_id = $request->input('product_varians_id');
            $user = Auth::user();
            $cart_item = CartDetail::where(['users_id' => $users_id,'product_varians_id' => $product_varians_id])->first();
            
                //jika sudah ada produk sebelumnya d cart
                $cart_item->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data Cart berhasil dihapus.',
            ], 201); 
           
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data data.',
                'error' => $e->getMessage()
            ], 422); 
        }
    }
}