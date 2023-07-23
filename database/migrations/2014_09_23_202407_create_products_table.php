<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->string('slug');
            $table->foreignId('information_id')->nullable();
            $table->timestamps();
        });

        Schema::create('product_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('description')->nullable();
            $table->decimal('price');
            $table->foreignId('product_information_picture_id')->nullable();
            $table->text('highlights')->nullable();
            $table->string('stock')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });

        Schema::create('product_information_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_information_id')->constrained('product_informations');
            $table->string('image');
            $table->timestamps();
        });

        Schema::table('product_informations', function (Blueprint $table) {
            $table->foreign('product_information_picture_id')->references('id')->on('product_information_pictures')->cascadeOnDelete();
        });

        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('information_id')->references('id')->on('product_informations')->cascadeOnDelete();
        });

        Schema::create('product_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->text('question');
            $table->text('answer');
            $table->timestamps();
        });

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users');
            $table->text('content');
            $table->integer('rating');
            $table->timestamps();
        });

        Schema::table('user_order_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_informations');
        Schema::dropIfExists('product_information_pictures');
        Schema::dropIfExists('product_specifications');
        Schema::dropIfExists('product_faqs');
        Schema::dropIfExists('product_reviews');
    }
};
