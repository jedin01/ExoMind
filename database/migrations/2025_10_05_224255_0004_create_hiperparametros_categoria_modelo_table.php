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
        Schema::create('hiperparametros_categoria_modelo', function (Blueprint $table) {
            $table->id();
            $table->string('vc_nome');
            $table->foreignId('it_id_categoria')->constrained('categorias_modelo')->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiperparametros_categoria_modelo');
    }
};