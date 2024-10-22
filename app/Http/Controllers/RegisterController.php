<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public int $id_rol;
    public string $nombreRol = '';
    public $rolesUsuarios;
    /**
     * Handle an incoming registration request.
     */


     public function register(): void
     {
         $this->rolesUsuarios = DB::select('select * from rols' );
         dd($this->rolesUsuarios);
 
         $validated = $this->validate([
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
             'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
         ]);
 
         dd($validated);
         $validated['password'] = Hash::make($validated['password']);    
         event(new Registered($user = User::create($validated)));
 
         Auth::login($user);
         return view('dashboard', compact('tareas', 'usuario'));
        //  $this->redirect(route('dashboard', absolute: false), navigate: true);
     }

}
