<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partido;
use App\Models\Movimiento;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Aldea;
use App\Models\Persona;
use App\Models\PersonasMovimiento;
use App\Models\TipoCandidato;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Termwind\Components\Dd;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class CandidatoController extends Controller
{
    public $datosCandidato;

    //Conexion PGSQL para acceder a la bd de censo del CNE
    private function conexionPG(){
        $conection = DB::connection('pgsql');
        return $conection;
    }

    private function getPersonaCne($dni){
        $this->datosCandidato = $this->conexionPG()->select("SELECT 'ok' AS resp, concat_ws(' ',cne.primer_nombre, cne.segundo_nombre) AS nombres,
          concat_ws(' ', cne.primer_apellido,cne.segundo_apellido) AS apellidos,
          TO_DATE(cne.fecha_nacimiento, 'yyyy-mm-dd') AS fecha_nacimiento_f,
          re.descripcion_sexo, re.nombre_departamento, re.nombre_municipio
          from TBL_CNE_M_CENSO_NACIONAL AS cne
          INNER JOIN REGISTRO_ELECTORAL AS re ON(re.identidad_persona = cne.numero_identidad)
          WHERE cne.NUMERO_IDENTIDAD = '$dni' ");

        return $this->datosCandidato;
    }

    //Crear el candidato
    public function CrearCandidato(Request $request){

        $validarDatos = Validator::make(
            $request ->all(),
            [
                'dni' => ['required', 'string', 'max:255'],

                //Campos de tabla personas
                // 'nombres' => ['required', 'string', 'max:255'],
                // 'apellidos' => ['required', 'string', 'max:255'],
                // 'genero' => ['required', 'string'],
                // 'fecha_nacimiento' => ['required', 'date'],
                // 'lugar_nacimiento' => ['required', 'string', 'max:255'],
                // 'password' => ['required'],
                //Campos de tabla personas

                'nombre_partido' => ['required', 'string', 'max:255'],
                'nombre_movimiento' => ['required', 'string', 'max:255'],
                'tipo' => ['required', 'string', 'max:255'], //formula de candidatura
                'nombre_departamento' => ['required', 'string', 'max:255'],
                'nombre_municipio' => ['required', 'string', 'max:255'],
                'num_planilla' => ['required', 'string', 'max:255'],
            ]
        );

        if($validarDatos->fails()){
            return response()->json(
                [
                    'status' => false,
                    'message' => 'error de validacion',
                    'errors' => $validarDatos->errors()
                ], 401
            );
        }

        $dni = Persona::where('dni', $request->dni)->first();

        if(isset($dni)){
            $data = [
                'message' => 'El DNI ingresado ya existe en el sistema',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        $id_partido = DB::table('partidos')->where('nombre_partido', $request->nombre_partido)->value('id');
        $id_movimiento = DB::table('movimientos')->where('nombre_movimiento', $request->nombre_movimiento)->value('id');
        $id_tipo_candidato = DB::table('tipo_candidatos')->where('tipo', $request->tipo)->value('id');
        $id_departamento = DB::table('departamentos')->where('nombre_departamento', $request->nombre_departamento)->value('id');
        $id_municipio = DB::table('municipios')->where('nombre_municipio', $request->nombre_municipio)->value('id');

        $datosPersonaCne = $this->getPersonaCne($request->dni);

        if(!$datosPersonaCne){
            $data = [
                'message' => 'El DNI no esta en el CNE',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
 
        for($i = 0; $i < count($datosPersonaCne); $i ++){
            $res = $datosPersonaCne[$i];
        }
      
        $persona = [
            'dni' => $request->dni,
            'nombres' => $res->nombres,
            'apellidos' => $res->apellidos,
            'genero' => $res->descripcion_sexo,
            'fecha_nacimiento' => $res->fecha_nacimiento_f,
            'lugar_nacimiento' => $res->nombre_departamento. ' '.$res->nombre_municipio
        ];


        //insert a la tabla personas
        $persona = Persona::create($persona);

        if($persona){
            $idPersona = $persona->getOriginal('id');
            $persona_por_movimientos = [
                'id_persona' => $idPersona,
                'id_partido' => $id_partido,
                'id_movimiento' => $id_movimiento,
                'id_tipo_candidato' => $id_tipo_candidato,
                'id_departamento' => $id_departamento,
                'id_municipio' => $id_municipio,
                'num_planilla' => $request->num_planilla
            ];

            //insert a la tabla personas_por_movimientos
            $persona_por_movimientos = PersonasMovimiento::create($persona_por_movimientos);
        }

        if(!isset($persona_por_movimientos)){
            $data = [
                'message' => 'No se puso crear el candidato, favor intente de nuevo',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'message' => 'candidato creado correctamente',
            'data' => $persona_por_movimientos,
            'status' => 200
        ];

        return response()->json($data, 200);       
    }

    //Obtener los candidatos creados
    public function getCandidatos(){
        $candidatos = DB::select("SELECT p.dni, CONCAT_WS(' ',p.nombres, p.apellidos) AS nombres, p.fecha_nacimiento,
                TIMESTAMPDIFF(YEAR, p.fecha_nacimiento, CURDATE()) AS edad, p.genero AS sexo,
                pr.nombre_partido, mov.nombre_movimiento, tc.tipo AS candidato_a, dp.nombre_departamento AS departamento,
                mun.nombre_municipio AS municipio, pxm.num_planilla AS planilla FROM personas AS p
                INNER JOIN PERSONAS_MOVIMIENTOS AS pxm on(pxm.id_persona = p.id)
                INNER JOIN partidos AS pr on(pxm.id_partido = pr.id)
                INNER JOIN movimientos AS mov on(pxm.id_movimiento = mov.id)
                INNER JOIN departamentos AS dp on(pxm.id_departamento = dp.id)
                INNER JOIN municipios AS mun on(pxm.id_municipio = mun.id)
                INNER JOIN tipo_candidatos AS tc on(pxm.id_tipo_candidato = tc.id) ");
        if(!$candidatos){
            $data = [
                'message' => 'No hay candidatos que mostrar',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Candidatos a cargo de elección popular : ',
            'data' => $candidatos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
