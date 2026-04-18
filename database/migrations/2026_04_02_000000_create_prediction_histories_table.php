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
        Schema::create('prediction_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('weapon_id')->nullable()->constrained('weapons')->nullOnDelete();
            $table->string('weapon_name')->nullable();
            $table->decimal('input_price', 10, 2);
            $table->decimal('input_vfx', 5, 2);
            $table->string('input_rarity', 50);
            $table->unsignedInteger('top_n')->nullable();
            $table->json('recommendations')->nullable();
            $table->json('response_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediction_histories');
    }
};
