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
        Schema::create('tbl_fish_variety', function (Blueprint $table) {
            $table->id();
            $table->string('fish_code', 30);
            $table->foreignId('species_id')->constrained('tbl_fish_species')->onDelete('cascade')->nullable();
            $table->string('common_name', 50);
            $table->string('scientific_name', 50)->nullable();
            $table->string('size_cm', 10)->nullable();
            $table->integer('qtyperbag')->nullable();
            $table->text('image')->nullable();
            $table->string('size', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_fish_variety');
    }
};
