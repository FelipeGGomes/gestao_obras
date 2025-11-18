<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

    public function logout(User $user): JsonResponse
    {

        try {

            $user->tokens()->delete();

            return response()->json([
            'status' => 'OK',
            'message' => 'Logged out successfully'
            ], status: 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Logout failed'
            ], 500);
        }
        
        
    }
}
