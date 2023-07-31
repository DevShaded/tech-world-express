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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('state_province')->nullable();
            $table->string('zip_postal_code');
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('user_billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->bigInteger('card_number')->nullable();
            $table->string('card_name')->nullable();
            $table->dateTime('card_expiry')->nullable();
            $table->integer('card_cvv')->nullable();
            $table->timestamps();
        });

        Schema::create('user_shipping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state_province')->nullable();
            $table->string('shipping_country')->nullable();
            $table->timestamps();
        });

        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->dateTime('order_date');
            $table->decimal('total_amount');
            $table->enum('status', ['pending', 'processing', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        Schema::create('user_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_order_id')->references('id')->on('user_orders');
            $table->foreignId('product_id')->nullable();
            $table->string('product_sku');
            $table->string('product_name');
            $table->decimal('product_price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
