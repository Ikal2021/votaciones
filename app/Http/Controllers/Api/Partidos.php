<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partido;
use App\Models\Movimiento;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Dd;

class Partidos extends Controller
{
    public $partidos, $movimientos;

    //Metodo para jalar partidos disponibles
    public function getPartidos(){
        $this->partidos = DB::table('partidos')->select('id', 'nombre_partido')->get();
        if($this->partidos->isEmpty()){
            $data = [
                'message' => 'No hay partidos disponibles',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Lista de partidos disponibles',
            'data' => $this->partidos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //Metodo para jalar los movimientos por partido
    public function getMovimientos(){
        // $this->movimientos = DB::table('movimientos')->select('id', 'nombre')->get();
        // $this->movimientos = DB::table('movimientos')->select('id', 'nombre')->get();

        $this->movimientos = DB::select('SELECT mov.id AS idMovimiento, mov.nombre_movimiento
                AS nombreMovimiento, pr.id AS idPartido, pr.nombre_partido AS partidoPerteneciente
                FROM movimientos AS mov INNER JOIN partidos AS pr ON(pr.id = mov.id_partido)
                ORDER BY pr.id');
        
        if(!$this->movimientos){
            $data = [
                'message' => 'No se encontraron movimientos ni partidos',
                'status' => 404                
            ];

            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Municipios con sus respectivos departamentos',
            'data' => $this->movimientos,
            'status' => 200
        ];

        return response()->json($data, 200); 

    }
    
}
