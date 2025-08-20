<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('profile_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
