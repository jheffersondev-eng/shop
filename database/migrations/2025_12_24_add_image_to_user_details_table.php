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
        if (!Schema::hasTable('user_details')) {
            return;
        }

        if (Schema::hasColumn('user_details', 'image')) {
            return;
        }

        Schema::table('user_details', function (Blueprint $table) {
            $table->string('image')->nullable()->after('user_id');
        });
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

        if (!Schema::hasColumn('user_details', 'image')) {
            return;
        }

        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
