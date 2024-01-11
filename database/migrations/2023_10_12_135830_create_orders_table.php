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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            // $table->unsignedBigInteger('adress_id');
            $table->string('order_no');
            $table->text('address');
            $table->string('no_resi')->nullable();
            $table->integer('price');
            $table->integer('shipping_price');
            $table->integer('price_total');
            $table->integer('total_payment')->nullable();
            $table->unsignedBigInteger('order_status_id');
            $table->integer('expedition_id')->nullable();
            $table->string('order_type')->comment('Pre Order,Order');
            $table->text('note')->nullable();
            $table->text('reason_cancel')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};