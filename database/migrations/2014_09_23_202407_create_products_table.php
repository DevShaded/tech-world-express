<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->string('slug');
            $table->foreignId('information_id')->nullable();
            $table->foreignId('specification_id')->nullable();
            $table->timestamps();
        });

        Schema::create('product_information', function (Blueprint $table) {
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
            $table->foreignId('product_information_id')->constrained('product_information');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('product_information', function (Blueprint $table) {
            $table->foreignId('product_information_picture_id')->references('id')->on('product_information_pictures')->cascadeOnDelete();
        });

        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('information_id')->references('id')->on('product_information')->cascadeOnDelete();
            $table->foreign('specification_id')->references('id')->on('product_specifications')->cascadeOnDelete();
        });

        Schema::create('product_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('order_date');
            $table->decimal('total_amount');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users');
            $table->string('order_date');
            $table->decimal('total_amount');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
