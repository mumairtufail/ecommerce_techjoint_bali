<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->nullable()->constrained('product_sizes')->onDelete('cascade');
            $table->foreignId('color_id')->nullable()->constrained('product_colors')->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->decimal('price_adjustment', 8, 2)->default(0); // Additional price for this variant
            $table->string('sku')->nullable(); // Unique SKU for this variant
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Ensure unique combinations of product, size, and color
            $table->unique(['product_id', 'size_id', 'color_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
