<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop permission_profile first (has foreign keys to permissions)
        Schema::dropIfExists('permission_profile');
        
        // Then drop permissions
        Schema::dropIfExists('permissions');
    }

    public function down(): void
    {
        // Recreate permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        // Recreate permission_profile table
        Schema::create('permission_profile', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('permission_id');

            $table->primary(['profile_id', 'permission_id']);

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }
};
