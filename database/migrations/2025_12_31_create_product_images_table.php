<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates product_images table and migrates existing images from products table
     *
     * @return void
     */
    public function up(): void
    {
        // Create product_images table
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            // Index for faster queries
            $table->index('product_id');
        });

        // Migrate existing images from products table to product_images table
        $products = DB::table('products')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->get();

        foreach ($products as $product) {
            DB::table('product_images')->insert([
                'product_id' => $product->id,
                'image' => $product->image,
                'created_at' => $product->created_at ?? now(),
                'updated_at' => $product->updated_at ?? now(),
            ]);
        }

        // Drop image column from products table
        if (Schema::hasColumn('products', 'image')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     * Restores the image column in products table and removes product_images table
     *
     * @return void
     */
    public function down(): void
    {
        // Add image column back to products table
        if (!Schema::hasColumn('products', 'image')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('image')->nullable()->after('name');
            });
        }

        // Restore images from product_images table
        $productImages = DB::table('product_images')
            ->whereNull('deleted_at')
            ->get();

        foreach ($productImages as $productImage) {
            DB::table('products')
                ->where('id', $productImage->product_id)
                ->update(['image' => $productImage->image]);
        }

        // Drop product_images table
        Schema::dropIfExists('product_images');
    }
};
