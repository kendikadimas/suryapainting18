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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 50)->unique();
            $table->string('customer_name', 150);
            $table->string('product_name', 255);
            $table->string('status', 50)->default('Pending'); // e.g., Pending, Processing, Completed, Cancelled
            $table->timestamps();
            $table->index('order_code');
        });

        Schema::create('order_timeline', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->timestamps();
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_timeline');
        Schema::dropIfExists('orders');
    }
};
