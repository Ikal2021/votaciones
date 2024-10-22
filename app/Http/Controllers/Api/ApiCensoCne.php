<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ApiCensoCne extends Controller
{
    public $datosCandidato;

    private function conexionPG(){
        $conection = DB::connection('pgsql');
        return $conection;
    }
    public function getPersonaCne($dni){
        $this->datosCandidato = $this->conexionPG()->select("SELECT 'ok' AS resp, concat_ws(' ',cne.primer_nombre, cne.segundo_nombre) AS nombres,
          concat_ws(' ', cne.primer_apellido,cne.segundo_apellido) AS apellidos,
          TO_DATE(cne.fecha_nacimiento, 'yyyy-mm-dd') AS fecha_nacimiento_f,
          re.descripcion_sexo, re.nombre_departamento, re.nombre_municipio
          from TBL_CNE_M_CENSO_NACIONAL AS cne
          INNER JOIN REGISTRO_ELECTORAL AS re ON(re.identidad_persona = cne.numero_identidad)
          WHERE cne.NUMERO_IDENTIDAD = '$dni' ");

        if(!isset($this->datosCandidato)){
            $data = [
                'message' => 'DNI no encontrado en el CNE',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'message' => 'DNI encontrado en el CNE',
            'data' => $this->datosCandidato,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}
