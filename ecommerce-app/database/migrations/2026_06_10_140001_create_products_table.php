<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('image');
            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedInteger('review_count')->default(0);
            $table->boolean('is_new')->default(false);
            $table->unsignedTinyInteger('discount_percent')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->string('brand')->default('E-SHOP');
            $table->json('sizes')->nullable();
            $table->json('colors')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_deal')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
