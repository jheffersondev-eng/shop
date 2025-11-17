<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds nullable `image` column to products table.
     *
     * @return void
     */
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'image')) {
                // place after 'name' if present; otherwise append
                try {
                    $table->string('image')->nullable()->after('name');
                } catch (\Throwable $e) {
                    // some DB drivers or older MySQL versions may fail with after(); fallback to append
                    $table->string('image')->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     * Drops `image` column if present.
     *
     * @return void
     */
    public function down(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
