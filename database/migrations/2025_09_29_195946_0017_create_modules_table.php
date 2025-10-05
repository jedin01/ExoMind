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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('vc_nome');
            $table->string('vc_prefix');
            $table->string('vc_route_subgroup');
            $table->string('vc_url');
            $table->string('vc_icon')->nullable();
            $table->foreignId('it_id_group')->constrained('groups')->onDelete("cascade");   
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};