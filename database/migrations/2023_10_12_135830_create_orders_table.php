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
            $table->unsignedBigInteger('adress_id');
            $table->string('no_resi');
            $table->integer('price');
            $table->integer('shipping_price');
            $table->integer('price_total');
            $table->integer('total_dp');
            $table->unsignedBigInteger('order_status_id');
            $table->string('order_type');
            $table->text('note');
            $table->text('reason_cancel');
            
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