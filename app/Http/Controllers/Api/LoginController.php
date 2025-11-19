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
    // validação opcional
    $request->validate([
        'cpf' => 'required',
        'password' => 'required',
    ]);


    if (Auth::attempt([
        'cpf' => $request->cpf,
        'password' => $request->password
    ])) {

        $user = Auth::user();


        if ($user->status !== '1') {


            Auth::logout();

            return response()->json([
                'status' => 'error',
                'message' => 'Usuário desativado'
            ], 403);
        }

        // OK → gerar token
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => 'OK',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'CPF ou senha inválidos'
    ], 401);
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
