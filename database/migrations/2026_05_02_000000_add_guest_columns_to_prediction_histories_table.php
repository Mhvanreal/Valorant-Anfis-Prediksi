<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('prediction_histories', function (Blueprint $table) {
            $table->string('guest_token', 64)->nullable()->index()->after('user_id');
            $table->string('guest_ip', 45)->nullable()->after('guest_token');
            $table->text('guest_user_agent')->nullable()->after('guest_ip');
        });
    }

    public function down(): void
    {
        Schema::table('prediction_histories', function (Blueprint $table) {
            $table->dropColumn(['guest_token', 'guest_ip', 'guest_user_agent']);
        });
    }
};
