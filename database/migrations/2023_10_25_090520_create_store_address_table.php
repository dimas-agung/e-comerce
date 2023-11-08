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
        Schema::create('store_address', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('provinces_id');
            $table->unsignedBigInteger('districts_id');
            $table->unsignedBigInteger('cities_id');
            $table->unsignedBigInteger('villages_id');
            $table->string('postal_code');
            $table->text('address');
            $table->string('label')->nullable();
            $table->integer('is_active')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_address');
    }
};
