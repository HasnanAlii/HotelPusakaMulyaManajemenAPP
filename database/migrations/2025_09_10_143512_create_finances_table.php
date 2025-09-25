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
    Schema::create('finances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reservation_id')->nullable()->constrained('reservations')->onDelete('cascade');
        $table->foreignId('expense_id')->nullable()->constrained('expenses')->onDelete('cascade');
        $table->string('keterangan')->nullable();
        $table->unsignedBigInteger('amount');


        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
