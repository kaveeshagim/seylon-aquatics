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
        Schema::create('tbl_privilege_section', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->constrained('tbl_priv_category')->onDelete('cascade');
            $table->foreignId('subcat_id')->constrained('tbl_priv_subcategory')->onDelete('cascade');
            $table->string('route_name', 30)->nullable();
            $table->string('section_name', 30)->nullable();
            $table->foreignId('cre_user')->constrained('tbl_users')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_privilege_section');
    }
};
