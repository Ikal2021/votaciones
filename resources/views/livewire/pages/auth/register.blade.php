<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $usuario = '';
    public string $tipo_usuario = '';
    public string $descripcion_usuario = '';
    public int $id_rol;
    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'usuario' => ['required', 'string', 'max:255'],
            'tipo_usuario' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        if($validated['tipo_usuario'] === 'Administrador')
        {
            $validated['id_rol'] = 1;
            $validated['descripcion_usuario'] = 'Acceso total al sistema';
        }

        else {
            $validated['id_rol'] = 2;
            $validated['descripcion_usuario'] = 'Solo digitalizará conteo de votos';

        }

        $validated['password'] = Hash::make($validated['password']);    
        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- Usuario -->
         <div  class="mt-4">
            <x-input-label for="usuario" :value="__('Nombre de Usuario')" />
            <x-text-input wire:model="usuario" id="usuario" class="block mt-1 w-full" type="text" name="usuario" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
        </div>

        {{-- Tipo Usuario --}}
        <div class="mt-4">
            <x-input-label for="tipo_usuario" value="{{ __('Tipo usuario') }}" />
            <select name="tipo_usuario" class="block mt-1 w-full" id="tipo_usuario" wire:model="tipo_usuario" required>
                <option value="" disabled selected>Seleccione el tipo de usuario</option>  
                <option value="Administrador">Administrador</option>
                <option value="Digitalizador">Digitalizador</option>
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Ya registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</div>
