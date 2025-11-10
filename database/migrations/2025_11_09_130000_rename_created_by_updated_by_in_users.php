<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Rename created_by -> user_id_create and updated_by -> user_id_update
     * Uses renameColumn when available, otherwise falls back to add/copy/drop.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        $pairs = [
            'created_by' => 'user_id_create',
            'updated_by' => 'user_id_update',
        ];

        foreach ($pairs as $old => $new) {
            if (!Schema::hasColumn('users', $old) || Schema::hasColumn('users', $new)) {
                // nothing to do
                continue;
            }

            // Try dropping foreign key on old column if exists
            try {
                Schema::table('users', function (Blueprint $table) use ($old) {
                    if (Schema::hasColumn('users', $old)) {
                        $table->dropForeign([$old]);
                    }
                });
            } catch (\Throwable $e) {
                // ignore; constraint may not exist or its name differs
            }

            // Try to rename using doctrine/dbal aware method
            try {
                Schema::table('users', function (Blueprint $table) use ($old, $new) {
                    $table->renameColumn($old, $new);
                });
            } catch (\Throwable $e) {
                // fallback: add new column, copy data, drop old column
                try {
                    Schema::table('users', function (Blueprint $table) use ($new) {
                        $table->unsignedBigInteger($new)->nullable()->after('id');
                    });

                    // copy data from old to new
                    DB::statement("UPDATE `users` SET `$new` = `$old` WHERE `$new` IS NULL AND `$old` IS NOT NULL");

                    // drop old column
                    Schema::table('users', function (Blueprint $table) use ($old) {
                        if (Schema::hasColumn('users', $old)) {
                            $table->dropColumn($old);
                        }
                    });
                } catch (\Throwable $inner) {
                    // As a last resort, try raw ALTER to add column and copy values
                    try {
                        DB::statement("ALTER TABLE `users` ADD COLUMN `$new` BIGINT UNSIGNED NULL AFTER `id`");
                        DB::statement("UPDATE `users` SET `$new` = `$old` WHERE `$new` IS NULL AND `$old` IS NOT NULL");
                        DB::statement("ALTER TABLE `users` DROP COLUMN `$old`");
                    } catch (\Throwable $final) {
                        // give up for this column; skip
                    }
                }
            }

            // Try adding FK on the new column
            try {
                Schema::table('users', function (Blueprint $table) use ($new) {
                    if (Schema::hasColumn('users', $new)) {
                        $table->foreign($new)->references('id')->on('users')->onDelete('set null');
                    }
                });
            } catch (\Throwable $e) {
                // ignore; adding FK may fail in some DB states
            }
        }
    }

    /**
     * Reverse the migrations.
     * Rename user_id_create -> created_by and user_id_update -> updated_by
     *
     * @return void
     */
    public function down(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        $pairs = [
            'created_by' => 'user_id_create',
            'updated_by' => 'user_id_update',
        ];

        // reverse mapping
        foreach ($pairs as $old => $new) {
            // now $old is the original, $new is the current; swap for down
            if (!Schema::hasColumn('users', $new) || Schema::hasColumn('users', $old)) {
                continue;
            }

            // drop foreign key on new column if exists
            try {
                Schema::table('users', function (Blueprint $table) use ($new) {
                    if (Schema::hasColumn('users', $new)) {
                        $table->dropForeign([$new]);
                    }
                });
            } catch (\Throwable $e) {
                // ignore
            }

            // Try rename back
            try {
                Schema::table('users', function (Blueprint $table) use ($new, $old) {
                    $table->renameColumn($new, $old);
                });
            } catch (\Throwable $e) {
                // fallback: add old column, copy data, drop new column
                try {
                    Schema::table('users', function (Blueprint $table) use ($old) {
                        $table->unsignedBigInteger($old)->nullable()->after('id');
                    });

                    DB::statement("UPDATE `users` SET `$old` = `$new` WHERE `$old` IS NULL AND `$new` IS NOT NULL");

                    Schema::table('users', function (Blueprint $table) use ($new) {
                        if (Schema::hasColumn('users', $new)) {
                            $table->dropColumn($new);
                        }
                    });
                } catch (\Throwable $inner) {
                    try {
                        DB::statement("ALTER TABLE `users` ADD COLUMN `$old` BIGINT UNSIGNED NULL AFTER `id`");
                        DB::statement("UPDATE `users` SET `$old` = `$new` WHERE `$old` IS NULL AND `$new` IS NOT NULL");
                        DB::statement("ALTER TABLE `users` DROP COLUMN `$new`");
                    } catch (\Throwable $final) {
                        // give up
                    }
                }
            }

            // try to restore FK on old column
            try {
                Schema::table('users', function (Blueprint $table) use ($old) {
                    if (Schema::hasColumn('users', $old)) {
                        $table->foreign($old)->references('id')->on('users')->onDelete('set null');
                    }
                });
            } catch (\Throwable $e) {
                // ignore
            }
        }
    }
};
