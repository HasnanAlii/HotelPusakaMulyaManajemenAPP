<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('room_number')->unique();
        $table->string('bed_type');
        $table->text('facilities')->nullable();
        $table->string('category')->nullable();
        $table->unsignedBigInteger('price');
        $table ->string('tata_letak')->nullable();
        $table->enum('status', ['tersedia', 'terisi', 'dibooking', 'perawatan'])->default('tersedia');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
