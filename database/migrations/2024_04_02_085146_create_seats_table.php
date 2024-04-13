<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->integer('seat_number');
            $table->boolean('is_standard_chairs')->nullable();
            $table->boolean('is_vip_chairs')->nullable();
            $table->timestamps();

            $table->index('hall_id', 'seat_hall_idx');
            $table->foreign('hall_id', 'seat_hall_fk')->on('halls')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
