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
        return view('livewire.candidate-component');
    }
}
