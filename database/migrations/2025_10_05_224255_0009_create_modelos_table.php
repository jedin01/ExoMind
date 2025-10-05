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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data');
            $table->foreignId('it_id_dataset')->constrained('datasets')->onDelete("cascade");
            $table->foreignId('it_id_categoria')->constrained('categorias_modelo')->onDelete("cascade");
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
        Schema::dropIfExists('modelos');
    }
};