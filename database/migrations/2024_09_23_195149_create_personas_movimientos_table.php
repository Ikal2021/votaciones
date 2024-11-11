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
        Schema::create('personas_movimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->unsignedBigInteger('id_partido');
            $table->foreign('id_partido')->references('id')->on('partidos');
            $table->unsignedBigInteger('id_movimiento');
            $table->foreign('id_movimiento')->references('id')->on('movimientos');
            $table->unsignedBigInteger('id_tipo_candidato');
            $table->foreign('id_tipo_candidato')->references('id')->on('tipo_candidatos');
            $table->unsignedBigInteger('id_departamento');
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->string('num_planilla');
            $table->string('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_movimientos');
    }
};
