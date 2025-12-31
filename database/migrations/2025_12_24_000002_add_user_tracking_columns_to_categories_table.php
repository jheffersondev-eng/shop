<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id_created')->nullable();
            $table->unsignedBigInteger('user_id_updated')->nullable();
            $table->unsignedBigInteger('user_id_deleted')->nullable();

            $table->foreign('user_id_created')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id_updated')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id_deleted')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeignKey(['user_id_created']);
            $table->dropForeignKey(['user_id_updated']);
            $table->dropForeignKey(['user_id_deleted']);

            $table->dropColumn(['user_id_created', 'user_id_updated', 'user_id_deleted']);
        });
    }
};
