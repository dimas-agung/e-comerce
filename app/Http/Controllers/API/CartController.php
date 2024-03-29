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
    function store(Request $request)  {
        try {
            $product_varians_id = $request->input('product_varians_id');
            $user = Auth::user();
            $cart = Cart::where('users_id',$user->id)->first();
            if (empty($cart)) {
                $cart = Cart::create([
                    'users_id' => $user->id,
                    'order_type' => 'PRE ORDER',
                ]);
                # code...
            }
            $cart_item = CartDetail::where(['users_id' => $user->id,'product_varians_id' => $product_varians_id])->first();
            if (empty($cart_items)) {
                // jika belum ada
                $cart_item = Cart::create([
                    'users_id' => $user->id,
                    'order_type' => 'PRE ORDER',
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
            $user = Auth::user();
            $cart_item = CartDetail::where(['users_id' => $user->id,'product_varians_id' => $product_varians_id])->first();
            
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
            $cart_item = CartDetail::where(['users_id' => $user->id,'product_varians_id' => $product_varians_id])->first();
            
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
