<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // If the legacy table exists and the correct table does not, rename it.
        if (Schema::hasTable('categorys') && ! Schema::hasTable('categories')) {
            try {
                Schema::rename('categorys', 'categories');
            } catch (\Throwable $e) {
                // Fallback to raw SQL if Schema::rename fails (some drivers/permissions)
                try {
                    DB::statement('RENAME TABLE `categorys` TO `categories`');
                } catch (\Throwable $ex) {
                    // swallow - migration will continue to attempt FK fixes below
                }
            }
        }

        // Update foreign keys that pointed to the old table name.
        // Discovered references in migrations: products.category_id -> categorys
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'category_id')) {
            // attempt to drop existing foreign key on products.category_id
            try {
                Schema::table('products', function (Blueprint $table) {
                    $table->dropForeign(['category_id']);
                });
            } catch (\Throwable $e) {
                // Try dropping by common constraint name as fallback
                try {
                    DB::statement('ALTER TABLE `products` DROP FOREIGN KEY `products_category_id_foreign`');
                } catch (\Throwable $ex) {
                    // ignore if it doesn't exist
                }
            }

            // recreate FK to point to the correct table name `categories` if column exists
            if (Schema::hasColumn('products', 'category_id') && Schema::hasTable('categories')) {
                try {
                    Schema::table('products', function (Blueprint $table) {
                        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                    });
                } catch (\Throwable $e) {
                    // ignore - FK might already exist or there might be other issues
                }
            }
        }
    }

    public function down(): void
    {
        // Reverse: rename categories back to categorys if needed
        if (Schema::hasTable('categories') && ! Schema::hasTable('categorys')) {
            try {
                Schema::rename('categories', 'categorys');
            } catch (\Throwable $e) {
                try {
                    DB::statement('RENAME TABLE `categories` TO `categorys`');
                } catch (\Throwable $ex) {
                    // ignore
                }
            }
        }

        // Update products FK back to `categorys`
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'category_id')) {
            try {
                Schema::table('products', function (Blueprint $table) {
                    $table->dropForeign(['category_id']);
                });
            } catch (\Throwable $e) {
                try {
                    DB::statement('ALTER TABLE `products` DROP FOREIGN KEY `products_category_id_foreign`');
                } catch (\Throwable $ex) {
                    // ignore
                }
            }

            if (Schema::hasColumn('products', 'category_id') && Schema::hasTable('categorys')) {
                try {
                    Schema::table('products', function (Blueprint $table) {
                        $table->foreign('category_id')->references('id')->on('categorys')->onDelete('cascade');
                    });
                } catch (\Throwable $e) {
                    // ignore
                }
            }
        }
    }
};
