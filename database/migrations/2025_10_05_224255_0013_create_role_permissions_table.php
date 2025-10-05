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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->boolean('bl_read');
            $table->boolean('bl_update');
            $table->boolean('bl_create');
            $table->boolean('bl_delete');
            $table->foreignId('it_id_role')->constrained('roles')->onDelete("cascade");
            $table->foreignId('it_id_module')->constrained('modules')->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};