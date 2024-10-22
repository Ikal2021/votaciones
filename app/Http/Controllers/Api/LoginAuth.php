<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginAuth extends Controller
{
    public function login(Request $request){
        $validarDatos = Validator::make(
            $request ->all(),
            [
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
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

         // Jalar algun usuario relacionado con el ingresado
         $user = User::where('email', $request->email)->first();
        
         //validaciones
         if(!$user || !Hash::check($request->password, $user->password)){
             $data = [
                 'message' => 'Credenciales no validas',
                 'status' => 401
             ];
             
             return response()->json($data, 401);
         }

        $data = [
            'message' => 'Bienvenido '.$user->name,
            'status' => 200
        ];
        
        return response()->json($data, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        //validar si el token se revoco
        if ($request->user()->token()->revoke()) {
            return response()->json([
                'message' => 'success',
                'token' => '',
                'estado_user'=>False,
            ], 200);
        } else {
            return response()->json([
                'message' => 'error',], 401);
        }
    }
    
}
