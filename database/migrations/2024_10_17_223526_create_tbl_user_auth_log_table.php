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
        Schema::create('tbl_user_auth_log', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 15);
            $table->foreignId('user_id')->constrained('tbl_users');
            $table->string('username', 15);
            $table->string('description', 30)->nullable();
            $table->string('event', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_auth_log');
    }
};
