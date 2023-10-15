<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\User;
use Database\Seeders\ProductsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testIndexPage()
    {
        $user = User::find(1);
        $productCategory = ProductCategory::latest()->limit(1)->get();
        // masukkan session user untuk login
        // $this->actingAs($user)
        //     ->get('product_category')
        //     ->assertStatus(200)
        //     ->assertSeeText($productCategory[0]->name);
        $this->actingAs($user)
            ->get('product_category')
            ->assertStatus(200);
            // ->assertSeeText($productCategory[0]->name);
    }
    public function testCreatePage()
    {
        $user = User::find(1);
        // masukkan session user untuk login
        $this->actingAs($user)
            ->get(route('product_category.create'))
            ->assertStatus(200);
            // ->assertSeeText('Product Category Create');
    }
    // public function testEditPage()
    // {
    //     $user = User::find(1);
    //     $productCategory = ProductCategory::latest()->limit(1)->get();
    //     // masukkan session user untuk login
    //     $this->actingAs($user)
    //         ->get(route('product_category.edit', $productCategory[0]->id))
    //         ->assertStatus(200)
    //         ->assertSeeText('Product Category Edit');
    //     // ->assertSeeText($productCategory[0]->name);
    // }
    public function testStoreProduct()
    {
        $user = User::find(1);
        $this->actingAs($user)->post('/product_category', [
            "name" => "kaos"
        ])->assertRedirect("/product_category")
            ->assertSessionHas("success", "Data Product Category has been created!");
    }
    public function testUpdateProduct()
    {
        $user = User::find(1);
        $productCategory = ProductCategory::factory()->create();
        // masukkan session user untuk login
        $this->actingAs($user);
        $this->put(
            route('product_category.update', $productCategory->id),
            [
                "name" => "kaos_edit",
            ],
        )->assertRedirect("/product_category")
            ->assertSessionHas("success", "Data Product Category has been updated!");
    }
    public function testDeleteProduct()
    {
        $user = User::find(1);
        $productCategory = ProductCategory::factory()->create();
        $this->actingAs($user);
        $this->delete(route('product_category.destroy', $productCategory->id))
            ->assertRedirect("/product_category")
            ->assertSessionHas("success", "Data Product Category has been deleted!");
        // cek apakah data sudah kosong setelah dihapus
        $this->assertEmpty(ProductCategory::find($productCategory->id));
    }
}