<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fuzzy_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();   // harga, fasilitas, kenyamanan
            $table->string('label');            // Harga, Fasilitas, Kenyamanan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuzzy_inputs');
    }
};
