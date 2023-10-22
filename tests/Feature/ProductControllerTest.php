<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
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
        $product = Product::latest()->limit(1)->get();
        // masukkan session user untuk login
        // $this->actingAs($user)
        //     ->get('product')
        //     ->assertStatus(200)
        //     ->assertSeeText($product[0]->name);
        $this->actingAs($user)
            ->get('product')
            ->assertStatus(200);
            // ->assertSeeText($product[0]->name);
    }
    public function testCreatePage()
    {
        $user = User::find(1);
        // masukkan session user untuk login
        $this->actingAs($user)
            ->get(route('product.create'))
            ->assertStatus(200);
            // ->assertSeeText('Product Create');
    }
    // public function testEditPage()
    // {
    //     $user = User::find(1);
    //     $product = Product::latest()->limit(1)->get();
    //     // masukkan session user untuk login
    //     $this->actingAs($user)
    //         ->get(route('product.edit', $product[0]->id))
    //         ->assertStatus(200)
    //         ->assertSeeText('Product Edit');
    //     // ->assertSeeText($product[0]->name);
    // }
    // public function testStoreProduct()
    // {
    //     $user = User::find(1);
    //     $varian_names = ['Ukuran','Warna'];
    //     $varian_detail_1_names = ['S','M','L'];
    //     $varian_detail_2_names = ['Merah','Biru'];
        
    //     $this->actingAs($user)->post('/product', [
    //         'product_categories_id' => 1,
    //         'product_code' => 'spt121123112312312123123223',
    //         'name' => 'Sepatu Adidas',
    //         'length' => 1,
    //         'width' => 1,
    //         'height' => 1,
    //         'weight' => 1,
    //         'description' => 'Sepatu Elite no 12',
    //         'order_type' => 'PRE ORDER',
    //         'is_active' => 1,
    //         'picture_default' => UploadedFile::fake()->create('file.jpg'),
    //         'picture_1' => UploadedFile::fake()->create('file.jpg'),
    //         'picture_2' => UploadedFile::fake()->create('file.jpg'),
    //         'picture_3' => UploadedFile::fake()->create('file.jpg'),
    //         'picture_4' => UploadedFile::fake()->create('file.jpg'),
    //         'picture_5' => UploadedFile::fake()->create('file.jpg'),
    //         // 'pictures' => $pictures,
    //         'varian_name' => $varian_names,
    //         'varian_detail_1_name' => $varian_detail_1_names,
    //         'varian_detail_2_name' => $varian_detail_2_names,
    //     ])->assertRedirect("/product")
    //         ->assertSessionHas("success", "Data Product has been created!");
    // }
    public function testUpdateProduct()
    {
        $user = User::find(1);
        $product = Product::with(['category','varians.detail'])->latest()->first();
        $pictures = [UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg')];
        $varian_names = ['Ukuran'];
        $varian_detail_1_names = ['S','M','L'];
        $varian_detail_2_names = ['Merah','Biru'];
        // masukkan session user untuk login
        $this->actingAs($user);
        $this->put(
            route('product.update', $product->id),
            [
                "product_code" => $product->product_code    ,
                'product_categories_id' => $product->product_categories_id,
                'name' => 'Sepatu Adidas',
                'length' => 1,
                'width' => 1,
                'height' => 1,
                'weight' => 1,
                'description' => 'Sepatu Elite no 12',
                'order_type' => 'PRE ORDER',
                'is_active' => 1,
                'picture_default' => UploadedFile::fake()->create('file.jpg'),
                'picture_1' => UploadedFile::fake()->create('file.jpg'),
                'picture_2' => UploadedFile::fake()->create('file.jpg'),
                'picture_3' => UploadedFile::fake()->create('file.jpg'),
                'picture_4' => UploadedFile::fake()->create('file.jpg'),
                'picture_5' => UploadedFile::fake()->create('file.jpg'),
                'varian_name' => $varian_names,
                'varian_detail_1_name' => $varian_detail_1_names,
                'varian_detail_2_name' => $varian_detail_2_names,
            ],
        )->assertRedirect("/product")
            ->assertSessionHas("success", "Data Product has been updated!");
    }
    // public function testDeleteProduct()
    // {
    //     $user = User::find(1);
    //     $product = Product::factory()->create();
    //     $this->actingAs($user);
    //     $this->delete(route('product.destroy', $product->id))
    //         ->assertRedirect("/product")
    //         ->assertSessionHas("success", "Data Product has been deleted!");
    //     // cek apakah data sudah kosong setelah dihapus
    //     $this->assertEmpty(Product::find($product->id));
    // }
}