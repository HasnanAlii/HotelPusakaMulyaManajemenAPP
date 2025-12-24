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
     Schema::create('fuzzy_settings', function (Blueprint $table) {
    $table->id();

    // Harga
    $table->decimal('harga_min_ratio', 4, 2)->default(0.6);
    $table->decimal('harga_max_ratio', 4, 2)->default(1.3);

    // Konsekuen Z
    $table->integer('z_min')->default(50);
    $table->integer('z_max')->default(100);

    // Fasilitas
    $table->integer('fasilitas_min')->default(1);
    $table->integer('fasilitas_mid')->default(3);
    $table->integer('fasilitas_max')->default(5);

    // Kenyamanan
    $table->decimal('nyaman_min', 3, 1)->default(1);
    $table->decimal('nyaman_mid', 3, 1)->default(2);
    $table->decimal('nyaman_max', 3, 1)->default(3);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_settings');
    }
};
