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
  Schema::create('maintenances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
    $table->string('damage')->nullable();
    $table->unsignedBigInteger('amount')->nullable();
    $table->boolean('is_repaired')->default(false); // status perbaikan
    $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
    $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null');
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
