<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    //Funcion que interactue con el dashboard y renderizar la vista dashboard
    public function index(){

        //Jalar la data del usuario logueado
        $usuario = Auth::user();

        //Renderizar la vista dashboard
        return view('dashboard', compact('usuario'));
    }
}
