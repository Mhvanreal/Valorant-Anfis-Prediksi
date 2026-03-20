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
        Schema::table('skins', function (Blueprint $table) {
            $table->string('is_battlepass')->nullable()->after('rarity');
            $table->decimal('popularity', 5, 2)->nullable()->after('is_battlepass');
            $table->decimal('vfx', 8, 4)->nullable()->after('popularity');
            $table->uuid('theme_uuid')->nullable()->after('image_url');
            $table->decimal('score', 8, 4)->nullable()->after('theme_uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skins', function (Blueprint $table) {
            $table->dropColumn(['is_battlepass', 'popularity', 'vfx', 'theme_uuid', 'score']);
        });
    }
};
