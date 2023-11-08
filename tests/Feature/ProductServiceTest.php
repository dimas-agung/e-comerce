<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductServiceTest extends TestCase
{
    private ProductService $productService;
    //sama kayak contruct di controller
    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = $this->app->make(ProductService::class);
    }
    function testSaveProduct(){
        $varian_names = [['name'=>'Ukuran'],['name'=>'Warna']];
        $varian_detail_1_names = [['S'],['M'],['L']];
        $varian_detail_2_names = [['Merah'],['Biru']];
        
        $data = [
            'product_categories_id' => 1,
            'product_code' => 'spt121123112312312123123223',
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
        ];
        $this->productService->create($data, $varian_names,$varian_detail_1_names,$varian_detail_2_names);
        $this->assertDatabaseHas('products', [
                    'product_code' => 'spt121123112312312123123223'
                ]);
    }
    function testUpdateProduct(){
        $varian_names = [['name'=>'Ukuran'],['name'=>'Warna']];
        $varian_detail_1_names = [['S'],['M'],['L']];
        $varian_detail_2_names = [['Merah'],['Biru']];
        $product = Product::first();
        $data = [
            'product_categories_id' => 1,
            'product_code' => 'spt121123112312312123123223TEST',
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
        ];
        $this->productService->update($product,$data, $varian_names,$varian_detail_1_names,$varian_detail_2_names);
        $this->assertDatabaseHas('products', [
                    'product_code' => 'spt121123112312312123123223TEST'
                ]);
    }
}
