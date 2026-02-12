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
    $table->integer('harga_min')->default(100000);
    $table->integer('harga_mid')->default(200000);
    $table->integer('harga_max')->default(300000);

    // Fasilitas
    $table->integer('fasilitas_min')->default(1);
    $table->integer('fasilitas_mid')->default(3);
    $table->integer('fasilitas_max')->default(5);

    // Kenyamanan
    $table->integer('nyaman_min')->default(1);
    $table->integer('nyaman_mid')->default(2);
    $table->integer('nyaman_max')->default(3);
    
    //jumlah orang
    $table->integer('jumlah_orang_min')->default(1);
    $table->integer('jumlah_orang_max')->default(2);
    


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
