<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Register extends Controller
{
    public function register(Request $request){
        $validarDatos = Validator::make(
            $request ->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'usuario' => ['required', 'string', 'max:255'],
                'tipo_usuario' => ['required', 'string'],
                'password' => ['required'],
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


        // $email = User::where('email', $request->email)->first();
        // if ($email) {
        //     return response()->json([
        //         'message' => 'El email ya existe en el sistema.',
        //         'status' => 200,
        //     ], 200);
        // }

        $user = [
            'name' => $request->name,
            'email' => $request -> email,
            'usuario' => $request -> usuario,
            'tipo_usuario' => $request -> tipo_usuario
        ];


        if($request->tipo_usuario == 'Administrador'){
            $user['id_rol'] = 1;
            $user['descripcion_usuario'] = 'Acceso total al sistema';
        }

        else{
            $user['id_rol'] = 2;
            $user['descripcion_usuario'] = 'Solo digitalizará conteo de votos';
        }

       $user['password'] = Hash::make($request->password); 
       $usuario = User::create($user);   
        
        if(!$usuario)
        {
            $data = [
                'message' => 'Algo malo paso, favor intente de nuevo',
                'status' => 401
            ];
            
            return response()->json($data, 401);
        }

        $data = [
            'message' => 'Usuario creado con exito!!',
            'status' => 200,
            // 'token' => $usuario->createToken('API TOKEN')->planiTextToken
        ];
        
        return response()->json($data, 200);
    }
}
