<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CandidateComponent extends Component
{
    public $modalNuevoCandidato = false;
    public $datosAspirante;

    //Realizar conexion a Postgres
    public function conexion()
    {
        $conection = DB::connection('pgsql');
        return $conection;
    }

     //Metodo para abrir el modal de nuevo candidato
    public function openCreateModal()
    {
        // $this->clearInputFields();
        $this->modalNuevoCandidato = true;
    }

    public function closeCreateModal()
    {
        // $this->clearInputFields();
        $this->modalNuevoCandidato = false;
    }

    public function render()
    {
        //Jalar datos de la bd cne para el candidato
        $this->datosAspirante = $this->conexion()->select("SELECT 'ok' AS resp, concat_ws(' ',cne.primer_nombre, cne.segundo_nombre) AS nombres,
            concat_ws(' ', cne.primer_apellido,cne.segundo_apellido) AS apellidos,
            TO_DATE(cne.fecha_nacimiento, 'yyyy-mm-dd') AS fecha_nacimiento_f,
            re.descripcion_sexo, re.nombre_departamento, re.nombre_municipio
            from TBL_CNE_M_CENSO_NACIONAL AS cne
            INNER JOIN REGISTRO_ELECTORAL AS re ON(re.identidad_persona = cne.numero_identidad)
            WHERE cne.NUMERO_IDENTIDAD = '0801198911611' ");

        return view('livewire.candidate-component');
    }
}
