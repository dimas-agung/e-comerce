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
            $table->string('fullname');
            $table->string('phone_number');
            $table->unsignedBigInteger('provinces_id');
            $table->unsignedBigInteger('districts_id');
            $table->unsignedBigInteger('villages_id');
            $table->string('postal_code');
            $table->text('address');
            $table->string('label');
            $table->integer('is_active'); 
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