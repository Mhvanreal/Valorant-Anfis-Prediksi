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
        Schema::create('skins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('weapon_id')
                ->constrained('weapons')
                ->cascadeOnDelete();

            $table->string('skin_name');
            $table->string('rarity')->nullable();
            $table->integer('price')->nullable();
            $table->string('image_url')->nullable();

            // Mencegah duplikat skin di weapon yang sama
            $table->unique(['weapon_id', 'skin_name']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skins');
    }
};
