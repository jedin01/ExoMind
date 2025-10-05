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
        Schema::create('hiperparametros_modelo', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->foreignId('it_id_modelo')->constrained('modelos')->onDelete("cascade");
            $table->foreignId('it_id_hiperparametro')->constrained('hiperparametros_categoria_modelo')->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiperparametros_modelo');
    }
};