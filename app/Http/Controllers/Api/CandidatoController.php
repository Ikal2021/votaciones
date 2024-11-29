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

    //Actualizar Candidato
    public function actualizarCandidato(Request $request, $id){
        $candidato = PersonasMovimiento::find($id);
        // $candidato = PersonasMovimiento::where('id', $id)->where('estatus', 'Activo')->get();
        if(!$candidato){
            $data = [
                'message' => 'No se ha encontrado el candidato o ya fué eliminado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validarDatos = Validator::make(
            $request ->all(),
            [
                // 'dni' => ['required', 'string', 'max:255'],

                //Campos de tabla personas
                // 'nombres' => ['required', 'string', 'max:255'],
                // 'apellidos' => ['required', 'string', 'max:255'],
                // 'genero' => ['required', 'string'],
                // 'fecha_nacimiento' => ['required', 'date'],
                // 'lugar_nacimiento' => ['required', 'string', 'max:255'],
                // 'password' => ['required'],
                //Campos de tabla personas

                // 'nombre_partido' => ['required', 'string', 'max:255'],
                'id_partido' => ['required'],
                // 'nombre_movimiento' => 'required', 'string', 'max:255',
                'id_movimiento' => ['required'],
                // 'tipo' => ['required', 'string', 'max:255'], //formula de candidatura
                'id_tipo_candidato' => ['required'], //id para formula de candidatura
                // 'nombre_departamento' => ['required', 'string', 'max:255'],
                'id_departamento' => ['required'],
                // 'nombre_municipio' => ['required', 'string', 'max:255'],
                'id_municipio' => ['required'],
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

        //Jalar los campos editados si se requiere del candidato
        // $id_partido = DB::table('partidos')->where('nombre_partido', $request->nombre_partido)->value('id');
        // $id_movimiento = DB::table('movimientos')->where('nombre_movimiento', $request->nombre_movimiento)->value('id');
        // $id_tipo_candidato = DB::table('tipo_candidatos')->where('tipo', $request->tipo)->value('id');
        // $id_departamento = DB::table('departamentos')->where('nombre_departamento', $request->nombre_departamento)->value('id');
        // $id_municipio = DB::table('municipios')->where('nombre_municipio', $request->nombre_municipio)->value('id');

        // $nombrePartido = DB::table('partidos')->where('id', $request->id_partido)->value('nombre_partido');
        // $nombreMovimiento = DB::table('movimientos')->where('id', $request->id_movimiento)->value('nombre_movimiento');
        // $tipoCandidato = DB::table('tipo_candidatos')->where('id', $request->id_tipo_candidato)->value('tipo');
        // $nombreDepartamento = DB::table('departamentos')->where('id', $request->id_departamento)->value('nombre_departamentp');
        // $nombreMunicipio = DB::table('municipios')->where('id', $request->id_municipio)->value('nombre_municipio');

        //Data para el update
        $candidato->id_partido = $request->id_partido;
        $candidato->id_movimiento  = $request->id_movimiento;
        $candidato->id_tipo_candidato = $request->id_tipo_candidato;
        $candidato->id_departamento = $request->id_departamento;
        $candidato->id_municipio = $request->id_municipio;
        $candidato->num_planilla = $request->num_planilla;

        if($request->id_partido <= 0 || $request->id_movimiento <= 0 || $request->id_tipo_candidato <= 0
                || $request->id_departamento <= 0 || $request->id_municipio <= 0){
            $data = [
               'message' => 'Datos numericos no validos(deben ser enteros positivos)',
               'status' => 404
            ];

            return response()->json($data, 404);
        }

        $candidato->save();
        $data = [
            'message' => 'Candidato actualizado correctamente, sus nuevos datos son:',
            'Candidato' => $candidato,
            'status' => 200
        ];
        return response()->json($data, 200);
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

                // 'nombre_partido' => ['required', 'string', 'max:255'],
                'id_partido' => ['required'],
                // 'nombre_movimiento' => 'required', 'string', 'max:255',
                'id_movimiento' => ['required'],
                // 'tipo' => ['required', 'string', 'max:255'], //formula de candidatura
                'id_tipo_candidato' => ['required'], //id para formula de candidatura
                // 'nombre_departamento' => ['required', 'string', 'max:255'],
                'id_departamento' => ['required'],
                // 'nombre_municipio' => ['required', 'string', 'max:255'],
                'id_municipio' => ['required'],
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

        // $id_partido = DB::table('partidos')->where('nombre_partido', $request->nombre_partido)->value('id');
        // $id_movimiento = DB::table('movimientos')->where('nombre_movimiento', $request->nombre_movimiento)->value('id');
        // $id_tipo_candidato = DB::table('tipo_candidatos')->where('tipo', $request->tipo)->value('id');
        // $id_departamento = DB::table('departamentos')->where('nombre_departamento', $request->nombre_departamento)->value('id');
        // $id_municipio = DB::table('municipios')->where('nombre_municipio', $request->nombre_municipio)->value('id');

        // $nombrePartido = DB::table('partidos')->where('id', $request->id_partido)->value('nombre_partido');
        // $nombreMovimiento = DB::table('movimientos')->where('id', $request->id_movimiento)->value('nombre_movimiento');
        // $tipoCandidato = DB::table('tipo_candidatos')->where('id', $request->id_tipo_candidato)->value('tipo');
        // $nombreDepartamento = DB::table('departamentos')->where('id', $request->id_departamento)->value('nombre_departamentp');
        // $nombreMunicipio = DB::table('municipios')->where('id', $request->id_municipio)->value('nombre_municipio');

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

        if($request->id_partido <= 0 || $request->id_movimiento <= 0 || $request->id_tipo_candidato <= 0
                || $request->id_departamento <= 0 || $request->id_municipio <= 0){
            $data = [
               'message' => 'Datos numericos no validos(deben ser enteros positivos)',
               'status' => 404
            ];

            return response()->json($data, 404);
        }

        //insert a la tabla personas
        $persona = Persona::create($persona);

        if($persona){
            $idPersona = $persona->getOriginal('id');
            $persona_por_movimientos = [
                'id_persona' => $idPersona,
                'id_partido' => $request->id_partido,
                'id_movimiento' => $request->id_movimiento,
                'id_tipo_candidato' => $request->id_tipo_candidato,
                'id_departamento' => $request->id_departamento,
                'id_municipio' => $request->id_municipio,
                'num_planilla' => $request->num_planilla,
                'estatus' => 'Activo'
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
                TIMESTAMPDIFF(YEAR, p.fecha_nacimiento, CURDATE()) AS edad, p.genero AS sexo, pr.id as id_partido,
                pr.nombre_partido, mov.id AS is_movimiento, mov.nombre_movimiento, tc.id AS id_tipo_candidato,
                tc.tipo AS formula, dp.id AS id_departamento, dp.nombre_departamento AS departamento,
                mun.id AS id_municipio, mun.nombre_municipio AS municipio, pxm.num_planilla AS planilla,
                pxm.estatus AS estado FROM personas AS p
                INNER JOIN PERSONAS_MOVIMIENTOS AS pxm on(pxm.id_persona = p.id)
                INNER JOIN partidos AS pr on(pxm.id_partido = pr.id)
                INNER JOIN movimientos AS mov on(pxm.id_movimiento = mov.id)
                INNER JOIN departamentos AS dp on(pxm.id_departamento = dp.id)
                INNER JOIN municipios AS mun on(pxm.id_municipio = mun.id)
                INNER JOIN tipo_candidatos AS tc on(pxm.id_tipo_candidato = tc.id) WHERE pxm.estatus = 'Activo' ");

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

    //Metodo para eliminar candidato
    public function eliminarCandidato($id){
        $candidato = PersonasMovimiento::find($id);
        // $candidato = PersonasMovimiento::where('id', $id)->where('estatus', 'Activo')->get();
        // $candidato = DB::table('personas_movimientos')->where('id', '=', $id)->where('estatus', '=', 'Activo')->get();
        // dd($candidato->estatus);
        if(!$candidato){
            $data = [
                'message' => 'No se ha encontrado el candidato',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        if($candidato->estatus == 'Inactivo'){
            $data = [
                'message' => 'El candidato ya esta dado de baja',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        //Borrando al candidato(darlo de baja)
        // $candidato->delete();
        $candidato = DB::table('personas_movimientos')->where('id', $id)->update(['estatus' => 'Inactivo']);
        $data = [
            'message' => 'Candidato Dado de baja Exitosamente!!',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //Para reactivar candidato dado de baja
    public function activarCandidato($id){
        $candidato = PersonasMovimiento::find($id);
        // dd($candidato);
        if(!$candidato){
            $data = [
                'message' => 'No hay datos, favor intente otra vez',
                'status' => 404 
            ];
            return response()->json($data, 404);
        }

        if($candidato->estatus != 'Inactivo'){
            $data = [
                'message' => 'Este candidato ya esta activo, favor ingrese el candidato correcto',
                'status' => 404 
            ];
            return response()->json($data, 404);
        }

        $candidato = DB::table('personas_movimientos')->where('id', $id)->update(['estatus' => 'Activo']);
        $data = [
            'message' => 'Candidato reactivado Exitosamente!!',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //Para obtener las formulas de los candidatos
    public function getFormulas(){
        $formulas = DB::table('tipo_candidatos')->select('id as id_tipo_candidato', 'tipo as formula')->get();//notacion tabla
        if( $formulas->isEmpty()){
            $data = [
                'message' => 'No se encontraron formulas de candidatos',
                'status' => 404
            ];
            return response()->json($data, 404);

        }

        $data = [
            'message' => 'Formulas de candidaturas encontradas',
            'data' => $formulas,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
