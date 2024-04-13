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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->unsignedBigInteger('film_id');
            $table->string('session_start_time');
            $table->string('paid_chairs')->nullable();
            $table->string('session_date')->nullable();

            $table->index('hall_id', 'session_hall_idx');
            $table->foreign('hall_id', 'session_hall_fk')->on('halls')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->index('film_id', 'session_film_idx');
            $table->foreign('film_id', 'session_film_fk')->on('films')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
