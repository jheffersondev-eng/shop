<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');

            $table->string('fantasy_name', 255);
            $table->string('legal_name', 255);
            $table->string('document', 20)->nullable();
            $table->string('email', 255);
            $table->string('phone', 20);

            $table->string('image', 255);
            $table->string('primary_color', 20);
            $table->string('secondary_color', 20);
            $table->string('domain', 255);

            $table->string('zip_code', 20);
            $table->string('state', 2);
            $table->string('city', 255);
            $table->string('neighborhood', 255);
            $table->string('street', 255);
            $table->string('number', 20);
            $table->string('complement', 255)->nullable();

            $table->boolean('is_active')->default(true);

            $table->foreignId('user_id_created')->constrained('users');
            $table->foreignId('user_id_updated')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('user_id_deleted')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();

            $table->index('owner_id');
            $table->index('is_active');
            $table->unique('domain');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
