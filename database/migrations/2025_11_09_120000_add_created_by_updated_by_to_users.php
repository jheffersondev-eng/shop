<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds nullable created_by and updated_by to users with foreign keys to users.id
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            }
        });

        // Add foreign keys in a try/catch to avoid migration failures on DBs with
        // different states or when the foreign key already exists.
        try {
            Schema::table('users', function (Blueprint $table) {
                // If the FK already exists this will throw; we catch and ignore.
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            });
        } catch (\Throwable $e) {
            // ignore; FK may already exist or DB may not support adding it here
        }
    }

    /**
     * Reverse the migrations.
     * Drops foreign keys and columns if present.
     *
     * @return void
     */
    public function down(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        // Try to drop foreign keys if present
        try {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'created_by')) {
                    // dropForeign accepts column array and infers constraint name
                    $table->dropForeign(['created_by']);
                }
                if (Schema::hasColumn('users', 'updated_by')) {
                    $table->dropForeign(['updated_by']);
                }
            });
        } catch (\Throwable $e) {
            // ignore; constraints may not exist
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'created_by')) {
                $table->dropColumn('created_by');
            }
            if (Schema::hasColumn('users', 'updated_by')) {
                $table->dropColumn('updated_by');
            }
        });
    }
};
