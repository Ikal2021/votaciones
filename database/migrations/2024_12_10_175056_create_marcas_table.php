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
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_acta');
            $table->foreign('id_acta')->references('id')->on('actas');
            $table->unsignedBigInteger('id_centro_votacion');
            $table->foreign('id_centro_votacion')->references('id')->on('centro_votacions');
            $table->unsignedBigInteger('id_persona_movimiento');
            $table->foreign('id_persona_movimiento')->references('id')->on('personas_movimientos');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas');
    }
};
