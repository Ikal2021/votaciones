<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Dd;

use App\Models\Partido;
use App\Models\TipoCandidato;


class CreateNewCandidate extends Component
{
    public $partidos, $tipo_candidatos, $movimientos;
    public function render()
    {
        //Jalar data de los partidos politicos
        $this->partidos = DB::table('partidos')->select('id', 'nombre')->get();//notacion tabla
        // $this->partidos = Partido::select('id', 'nombre')->get(); // notacion de modelos

        //Jalar las formulas de los candidatos(tipo de candidato)
        $this->tipo_candidatos = DB::table('tipo_candidatos')->select('id', 'tipo')->get();

        //Jalar los movimientos relacionados con cada partido
        $this->movimientos = DB::table('movimientos')->select('id', 'nombre')->get();
        
        return view('livewire.create-new-candidate');
    }
}
