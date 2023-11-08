<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    // public function testIndexPage()
    // {
    //     $user = User::find(1);
    //     $product = Order::latest()->limit(1)->get();
    //     // masukkan session user untuk login
    //     // $this->actingAs($user)
    //     //     ->get('product')
    //     //     ->assertStatus(200)
    //     //     ->assertSeeText($product[0]->name);
    //     $this->actingAs($user)
    //         ->get('product')
    //         ->assertStatus(200);
    //         // ->assertSeeText($product[0]->name);
    // }
    // public function testCreatePage()
    // {
    //     $user = User::find(1);
    //     // masukkan session user untuk login
    //     $this->actingAs($user)
    //         ->get(route('product.create'))
    //         ->assertStatus(200);
    //         // ->assertSeeText('Order Create');
    // }
    // public function testEditPage()
    // {
    //     $user = User::find(1);
    //     $product = Order::latest()->limit(1)->get();
    //     // masukkan session user untuk login
    //     $this->actingAs($user)
    //         ->get(route('product.edit', $product[0]->id))
    //         ->assertStatus(200)
    //         ->assertSeeText('Order Edit');
    //     // ->assertSeeText($product[0]->name);
    // }
    public function testStoreOrder()
    {
        $user = User::find(1);
        $product_varian_id = [1];
        $qty_order = [12];
        $discounts = [1];
       
        $this->actingAs($user)->post('/order', [
            'order_no' => 1,
            'address' => 'spt121123112312312123123223',
            'price' => 1,
            'shipping_price' => 1,
            'price_total' => 1,
            'total_payment' => 1,
            'order_status_id' => 1,
            'expedition_id' => 1,
            'order_type' => 'PRE ORDER',
            'note' => 1,
            'product_varian_id' => $product_varian_id,
            'qty_order' => $qty_order,
            'discounts' => $discounts,

        ])->assertRedirect("/order")
            ->assertSessionHas("success", "Data Order has been created!");
    }
    public function testUpdateStatusOrder()
    {
        $user = User::find(1);
        $order = Order::latest()->first();
        $order_status = OrderStatus::first();
        // masukkan session user untuk login
        $this->actingAs($user);
        $this->put(
            route('order.update', $order->id),
            [
                "order_status_id" => $order_status->id    ,
            ],
        )->assertRedirect("/order")
            ->assertSessionHas("success", "Data Order has been updated!");
    }
    public function testCancelOrder()
    {
        $user = User::find(1);
        $order = Order::first();
        $this->actingAs($user);
        $this->put(route('order.cancel', $order->id),
            [
                "reason_cancel" => 'Ada kendala',
            ],
            )
            ->assertRedirect("/order")
            ->assertSessionHas("success", "Data Order has been canceled!");
        // cek apakah data sudah kosong setelah dihapus
        // $this->assertEmpty(Order::find($order->id));
    }
}
