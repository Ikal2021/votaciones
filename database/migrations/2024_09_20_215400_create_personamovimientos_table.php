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
        Schema::create('personamovimientos', function (Blueprint $table) {
            $table->id();

            //lave foranea de la tabla personas
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            //llave foranea para movimientos
            $table->unsignedBigInteger('id_movimiento');
            $table->foreign('id_movimiento')->references('id')->on('movimientos');
            //llave foranea de la tabla tipoCandidato
            $table->unsignedBigInteger('id_tipo_candidato');
            $table->foreign('id_tipo_candidato')->references('id')->on('tipocandidatos');     
            //lave foranea para departamentos
            $table->unsignedBigInteger('id_departamento');
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            //llave foranea para municipios
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->string('num_planilla');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personamovimientos');
    }
};
