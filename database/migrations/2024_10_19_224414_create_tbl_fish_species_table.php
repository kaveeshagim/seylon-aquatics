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
        Schema::create('tbl_fish_species', function (Blueprint $table) {
            $table->id();
            $table->string('species_code', 30)->nullable();
            $table->foreignId('family_id')->constrained('tbl_fish_family')->onDelete('cascade');
            $table->string('name', 30);
            $table->string('scientific_name', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_fish_species');
    }
};
