<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MoveClientStatusToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * Strategy:
     * 1) add `status` to `users`
     * 2) copy `clients.status` -> `users.status` by matching `user_id`
     * 3) rename `clients` -> `user_details`
     * 4) drop `status` from `user_details` (it now lives on users)
     */
    public function up()
    {
        // 1) add status to users (nullable to be safe)
        if (! Schema::hasColumn('users', 'status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedTinyInteger('status')->nullable()->after('profile_id');
            });
        }

        // 2) copy values from clients -> users
        if (Schema::hasTable('clients')) {
            $clients = DB::table('clients')->get();
            foreach ($clients as $client) {
                if (! empty($client->user_id)) {
                    DB::table('users')->where('id', $client->user_id)->update(['status' => $client->status]);
                }
            }

            // 3) rename clients -> user_details
            Schema::rename('clients', 'user_details');

            // 4) drop status from user_details if present
            if (Schema::hasColumn('user_details', 'status')) {
                Schema::table('user_details', function (Blueprint $table) {
                    // dropColumn for some drivers may require Doctrine DBAL; attempt and ignore if not possible
                    $table->dropColumn('status');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // 1) rename user_details -> clients (if exists)
        if (Schema::hasTable('user_details')) {
            Schema::rename('user_details', 'clients');

            // 2) add status back to clients if missing
            if (! Schema::hasColumn('clients', 'status')) {
                Schema::table('clients', function (Blueprint $table) {
                    $table->unsignedTinyInteger('status')->nullable()->after('credit_limit');
                });
            }

            // 3) copy users.status -> clients.status
            $clients = DB::table('clients')->get();
            foreach ($clients as $client) {
                if (! empty($client->user_id)) {
                    $status = DB::table('users')->where('id', $client->user_id)->value('status');
                    DB::table('clients')->where('id', $client->id)->update(['status' => $status]);
                }
            }
        }

        // 4) drop users.status column
        if (Schema::hasColumn('users', 'status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
}
