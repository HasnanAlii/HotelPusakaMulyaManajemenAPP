<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fuzzy_input_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuzzy_input_id')
                  ->constrained('fuzzy_inputs')
                  ->cascadeOnDelete();

            $table->string('label');      // Rp 100.000 | Komplit | VIP
            $table->string('value');      // 100000 | lengkap | tinggi
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuzzy_input_options');
    }
};

