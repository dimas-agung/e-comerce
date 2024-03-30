<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // public function testCheckoutOrder()
    // {
    //     $user = User::find(1);

    //     $orderService = new OrderService();
    //     $users_id = $user->id;
    //     $order_no = '1234TEST';
    //     $name = 'TEST NAME';
    //     $phone = '09112121';
    //     $email = $user->email;
    //     $address = 'Test ADdress';
    //     $price = '10000';
    //     $shipping_price = '10000';
    //     $price_total = '11000';
    //     $total_payment = '11000';
    //     $order_status_id =1;
    //     $expedition_id =1;
    //     $order_type = 'jne';
    //     $note = 'TEST';
    //     $cart_id = '1';
    //     $checkout = $orderService->checkout(
    //         $users_id,
    //         $order_no,
    //         $name,
    //         $phone,
    //         $email,
    //         $address,
    //         $price,
    //         $shipping_price,
    //         $price_total,
    //         $total_payment,
    //         $order_status_id,
    //         $expedition_id,
    //         $order_type,
    //         $note,
    //         $cart_id
    //     );
       
    // }
    public function testCheckoutOrderController()
    {
        $user = User::find(1);
        $product_varian_id = [1];
        $qty_order = [12];
        $discounts = [1];
        $users_id = $user->id;
        $order_no = '1234TEST';
        $name = 'TEST NAME';
        $phone = '09112121';
        $email = $user->email;
        $address = 'Test ADdress';
        $price = '10000';
        $shipping_price = '10000';
        $price_total = '11000';
        $total_payment = '11000';
        $order_status_id =1;
        $expedition_id =1;
        $order_type = 'jne';
        $note = 'TEST';
        $cart_id = '1';
        $this->actingAs($user)->post('api/order/checkout', [
            'users_id' => $users_id,
            'address_id' => 1,
            'cart_id' => $cart_id,
            'note' => $note,
            'price' => $price,
            'shipping_price' => $shipping_price,
            'order_type' => 'dp',

        ])->assertRedirect("/order")
            ->assertSessionHas("success", "Data Order has been created!");
    }
}
