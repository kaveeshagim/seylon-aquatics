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
        Schema::create('tbl_order_det', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('tbl_order_mst')->onDelete('cascade');
            $table->string('order_no', 20);
            $table->string('fish_code', 20)->nullable();
            $table->string('size', 5)->nullable();
            $table->integer('per_bag')->nullable();
            $table->integer('orders')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('bags')->nullable();
            $table->integer('boxes')->nullable();
            $table->string('approval_status', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order_det');
    }
};
