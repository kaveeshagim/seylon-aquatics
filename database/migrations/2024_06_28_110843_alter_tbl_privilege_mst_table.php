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
        Schema::table('tbl_privilege_mst', function (Blueprint $table) {
            $table->foreignId('sec_id')->constrained('tbl_privilege_section')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_privilege_mst', function (Blueprint $table) {
            $table->dropForeign(['sec_id']);
            $table->dropColumn('sec_id');
        });
    }
};
