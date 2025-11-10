<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_details')) {
            return;
        }

        if (!Schema::hasColumn('user_details', 'user_id')) {
            return;
        }

        // if already nullable, nothing to do — check information_schema
        try {
            $dbName = DB::connection()->getDatabaseName();
            $row = DB::selectOne('SELECT IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ?', [$dbName, 'user_details', 'user_id']);
            if ($row && isset($row->IS_NULLABLE) && strtoupper($row->IS_NULLABLE) === 'YES') {
                return;
            }
        } catch (\Throwable $e) {
            // ignore and attempt change
        }

        // Try the standard Laravel change() approach (requires doctrine/dbal).
        try {
            Schema::table('user_details', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            });
            return;
        } catch (\Throwable $e) {
            // fallback to raw SQL (best-effort). We assume unsigned big integer.
            DB::statement('ALTER TABLE `user_details` MODIFY `user_id` BIGINT UNSIGNED NULL');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('user_details')) {
            return;
        }

        if (!Schema::hasColumn('user_details', 'user_id')) {
            return;
        }

        // only convert back to non-nullable if there are no NULL values
        $nulls = DB::table('user_details')->whereNull('user_id')->count();
        if ($nulls > 0) {
            // don't force change to NOT NULL if data would violate it
            return;
        }

        try {
            Schema::table('user_details', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable(false)->change();
            });
            return;
        } catch (\Throwable $e) {
            DB::statement('ALTER TABLE `user_details` MODIFY `user_id` BIGINT UNSIGNED NOT NULL');
        }
    }
};
