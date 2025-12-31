<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabelas que pertencem ao tenant e devem ter owner_id
        $tables = [
            'users',
            'products',
            'categories',
            'units',
            'profiles',
            'permissions',
            'sales',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    if (!Schema::hasColumn($table->getTable(), 'owner_id')) {
                        $table->unsignedBigInteger('owner_id')->nullable()->after('id');
                    }
                });
            }
        }
    }

    public function down(): void
    {
        // Tabelas que pertencem ao tenant
        $tables = [
            'users',
            'products',
            'categories',
            'units',
            'profiles',
            'permissions',
            'sales',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'owner_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('owner_id');
                });
            }
        }
    }
};
