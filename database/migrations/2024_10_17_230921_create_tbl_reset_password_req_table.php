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
        Schema::create('tbl_reset_password_req', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('reasons');
            $table->text('new_password')->nullable();
            $table->tinyInteger('email_status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_reset_password_req');
    }
};
