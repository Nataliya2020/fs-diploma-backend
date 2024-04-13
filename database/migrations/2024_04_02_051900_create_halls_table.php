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
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('rows')->nullable();
            $table->integer('chairs_in_row')->nullable();
            $table->integer('total_chairs')->nullable();
            $table->string('blocked_chairs')->nullable();
            $table->integer('price_standart_chair')->nullable();
            $table->integer('price_vip_chair')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
