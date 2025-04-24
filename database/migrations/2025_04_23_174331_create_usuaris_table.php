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
        Schema::create('usuaris', function (Blueprint $table) {
            $table->string('nom')->nullable();
            $table->string('cognoms');
            $table->string('correu')->unique();
            $table->string('nickname')->primary();
            $table->text('contrasenya')->nullable();
            $table->string('xarxa_social', 25)->nullable();
            $table->boolean('administrador')->default(false);
            $table->string('imgPerfil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuaris');
    }
};
