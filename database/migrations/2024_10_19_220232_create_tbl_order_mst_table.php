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
        Schema::create('tbl_order_mst', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cus_id')->constrained('tbl_customers')->onDelete('cascade')->nullable();
            $table->string('customer_name', 20)->nullable();
            $table->string('order_no', 20);
            $table->foreignId('executive_id')->constrained('tbl_users')->onDelete('cascade')->nullable();
            $table->string('status')->nullable();
            $table->integer('tot_orders')->nullable();
            $table->integer('tot_bags')->nullable();
            $table->integer('tot_boxes')->nullable();
            $table->integer('tot_fish')->nullable();
            $table->decimal('advanced_payment', 10, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->date('delivery_date')->nullable();
            $table->decimal('order_total', 10, 2)->nullable();
            $table->decimal('discount_applied', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order_mst');
    }
};
