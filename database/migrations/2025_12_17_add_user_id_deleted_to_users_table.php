<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('user_id_create', 'user_id_created');
            $table->renameColumn('user_id_update', 'user_id_updated');
            $table->unsignedBigInteger('user_id_deleted')->nullable()->after('user_id_updated');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('user_id_created', 'user_id_create');
            $table->renameColumn('user_id_updated', 'user_id_update');
            $table->dropColumn('user_id_deleted');
        });
    }
};
