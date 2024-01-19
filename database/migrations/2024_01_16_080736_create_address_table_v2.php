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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->integer('is_default');
            $table->string('fullname');
            $table->string('phone_number');
            $table->unsignedBigInteger('provinces_id');
            $table->unsignedBigInteger('districts_id');
            $table->unsignedBigInteger('cities_id');
            $table->string('village');
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
        Schema::dropIfExists('address');
    }
};