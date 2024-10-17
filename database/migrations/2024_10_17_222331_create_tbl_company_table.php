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
        Schema::create('tbl_company', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('address');
            $table->string('web_url', 40)->nullable();
            $table->string('contact_no_one', 15);
            $table->string('contact_no_two', 15)->nullable();
            $table->string('email_one', 25);
            $table->string('email_two', 25)->nullable();
            $table->string('country', 15);
            $table->integer('perbox_cost');
            $table->integer('document_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_company');
    }
};
