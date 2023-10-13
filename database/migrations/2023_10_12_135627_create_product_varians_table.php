<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_varians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('varian_detail_id_1');
            $table->unsignedBigInteger('varian_detail_id_2');
            $table->integer('price');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_varians');
    }
};