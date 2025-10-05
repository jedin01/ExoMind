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
        Schema::create('treinamento_metricas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('it_id_metrica')->constrained('metricas')->onDelete("cascade");
            $table->foreignId('it_id_treinamento')->constrained('treinamentos')->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinamento_metricas');
    }
};