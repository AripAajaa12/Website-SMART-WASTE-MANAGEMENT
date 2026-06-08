<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up() {
    Schema::create('waste_bins', function (Blueprint $table) {
        $table->id();
        $table->string('location_name');
        $table->decimal('latitude', 10, 8);
        $table->decimal('longitude', 11, 8);
        $table->integer('fill_level')->default(0); // Kapasitas 0-100%
        $table->string('status')->default('normal'); // normal, full, maintenance
        $table->foreignId('waste_category_id')->constrained('waste_categories')->onDelete('cascade');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_bins');
    }
};
