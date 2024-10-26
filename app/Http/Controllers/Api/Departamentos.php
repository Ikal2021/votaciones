<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Aldea;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Dd;

class Departamentos extends Controller
{
    public $departamentos, $municipios, $aldeas;

    public function getDepartamentos(){
        $this->departamentos = DB::table('departamentos')->select('codigo_departamento', 'nombre_departamento')->get();//notacion tabla
        // $this->departamentos = Departamento::select('id', 'nombre')->get(); // notacion de modelos
        if($this->departamentos->isEmpty()){
            $data = [
                'message' => 'No se encontraron departamentos',
                'status' => 404
            ];
            return response()->json($data, 404);

        }

        $data = [
            'message' => 'Departamentos encontrados',
            'data' => $this->departamentos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function getMunicipios(){
        $this->municipios = DB::select('select mun.codigo_municipio AS codigoMun, mun.nombre_municipio
                        AS nombreMun, dp.codigo_departamento AS codigoDep, dp.nombre_departamento
                        AS deptoPerteneciente from municipios as mun
                        INNER JOIN departamentos AS dp on(mun.id_departamento = dp.id)');

        if(!$this->municipios){
            $data = [
                'message' => 'No se encontraron municipios',
                'status' => 404
            ];
            return response()->json($data, 404);

        }

        $data = [
            'message' => 'Municipios con sus respectivos departamentos',
            'data' => $this->municipios,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function getAldeas(){
        $this->aldeas = DB::select('select aldea.codigo_aldea AS codigoAldea, aldea.nombre_aldea AS nombreAldea,
                mun.codigo_municipio AS codigoMuni, mun.nombre_municipio AS municipioPerteneciente,
                dp.codigo_departamento As codigoDepto,
                dp.nombre_departamento AS deptoPerteneciente from aldeas as aldea
                INNER JOIN municipios AS mun on(mun.id = aldea.id_municipio)
                INNER JOIN departamentos AS dp on(dp.id = mun.id_departamento)');

        if(!$this->aldeas){
            $data = [
                'message' => 'No se encontraron aldeas',
                'status' => 404
            ];
            return response()->json($data, 404);

        }

        $data = [
            'message' => 'Aldeas con sus respectivos departamentos y municipios',
            'data' => $this->aldeas,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
