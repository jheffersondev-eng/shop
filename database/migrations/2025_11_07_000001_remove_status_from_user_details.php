<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // guard: only try to drop if table and column exist
        if (!Schema::hasTable('user_details')) {
            return;
        }

        if (!Schema::hasColumn('user_details', 'status')) {
            return;
        }

        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // restore the column if the table exists and the column is missing
        if (!Schema::hasTable('user_details')) {
            return;
        }

        if (Schema::hasColumn('user_details', 'status')) {
            return;
        }

        Schema::table('user_details', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1);
        });
    }
};
