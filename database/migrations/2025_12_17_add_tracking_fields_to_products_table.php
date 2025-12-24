<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id_created')->nullable()->after('is_active');
            $table->unsignedBigInteger('user_id_updated')->nullable()->after('user_id_created');
            $table->unsignedBigInteger('user_id_deleted')->nullable()->after('user_id_updated');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['user_id_created', 'user_id_updated', 'user_id_deleted']);
        });
    }
};
