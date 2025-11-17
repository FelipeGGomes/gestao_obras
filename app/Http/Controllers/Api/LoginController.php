<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attemptWhen([
            'cpf' => $request->cpf,
            'password' => $request->password,
        ])){

            //Recuperar os dados do usuario
            $user = Auth::user();

            //Retornando o Token
            $token = $request->user()->createToken('api_token')->plainTextToken;

            return response()->json([
                'status' => 'OK',
                'token' => $token,
                'user' => $user,                
            ], status: 201);

        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }
    }
}
