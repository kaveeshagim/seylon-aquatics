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
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 15);
            $table->text('password');
            $table->foreignId('tbl_usertype_id')->constrained('tbl_usertype'); // foreign key to tbl_usertype
            $table->string('fname', 15);
            $table->string('lname', 15)->nullable();
            $table->string('company', 25)->nullable();
            $table->tinyInteger('active_status')->nullable();
            $table->string('email', 25);
            $table->string('primary_contact', 15);
            $table->string('secondary_contact', 15)->nullable();
            $table->integer('token')->nullable();
            $table->string('avatar', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
