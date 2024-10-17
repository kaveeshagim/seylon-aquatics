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
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->id();
            $table->string('title',4);
            $table->string('fname', 20);
            $table->string('lname', 20)->nullable();
            $table->foreignId('user_id')->constrained('tbl_users')->nullable();
            $table->string('company', 20)->nullable();
            $table->string('country', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('email', 25)->nullable();
            $table->tinyInteger('active_status')->nullable();
            $table->string('primary_contact', 15);
            $table->string('secondary_contact', 15)->nullable();
            $table->foreignId('executive_id')->constrained('tbl_users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customers');
    }
};
