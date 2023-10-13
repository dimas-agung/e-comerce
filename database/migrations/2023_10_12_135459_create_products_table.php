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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_categories_id');
            $table->string('order_type');
            $table->string('name');
            $table->integer('length');
            $table->integer('with');
            $table->integer('height');
            $table->integer('weight');
            $table->string('picture_default');
            $table->string('picture_1');
            $table->string('picture_2');
            $table->string('picture_3');
            $table->string('picture_4');
            $table->integer('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};