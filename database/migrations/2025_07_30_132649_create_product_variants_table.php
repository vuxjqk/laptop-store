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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ram_id')->constrained();
            $table->foreignId('storage_id')->constrained();
            $table->foreignId('color_id')->constrained();
            $table->decimal('price', 15, 2);
            $table->decimal('original_price', 15, 2);
            $table->integer('stock_quantity')->default(0);
            $table->unique(['product_id', 'ram_id', 'storage_id', 'color_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
