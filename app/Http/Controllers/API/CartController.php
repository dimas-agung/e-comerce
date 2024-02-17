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
            if (empty($cart_item)) {
                // jika belum ada
                $cart_item = CartDetail::create([
                    'carts_id' => $cart->id,
                    'product_varians_id' => $product_varians_id,
                    'qty' => $request->input('qty'),
                ]);
                # code...
            }else{
                //jika sudah ada produk sebelumnya d cart
                $cart_item = CartDetail::where('id', $cart_item->id)->update([
                    'qty' => (int )$cart_item->qty+(int)$request->input('qty')
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
            // $product_varians_id = $request->input('product_varians_id');
            $cart_detail_id = $request->input('cart_detail_id');
            $qty = $request->input('qty');
            $cart_item = CartDetail::where(['id' => $cart_detail_id])->first();

                //jika sudah ada produk sebelumnya d cart
                $cart_item->update([
                    'qty' => $qty
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
    function destroy( $cart_detail_id)  {
        try {
            // $product_varians_id = $request->input('product_varians_id');
            // $cart_detail_id = $request->input('cart_detail_id');
            $cart_item = CartDetail::where(['id' => $cart_detail_id])->delete();

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
