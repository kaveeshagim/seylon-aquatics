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
        Schema::create('tbl_privilege_mst', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('tbl_privilege_section')->onDelete('cascade');
            $table->foreignId('cat_id')->constrained('tbl_priv_category')->onDelete('cascade');
            $table->foreignId('subcat_id')->constrained('tbl_priv_subcategory')->onDelete('cascade');
            $table->foreignId('sec_id')->constrained('tbl_privilege_section')->onDelete('cascade');
            $table->string('cre_user');
            $table->string('updated_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_privilege_mst');
    }
};
