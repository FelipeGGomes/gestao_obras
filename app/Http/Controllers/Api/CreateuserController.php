<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CreateuserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            ]);

        return response()->json([
                'status' => 'OK',
                'user' => $user,                
            ], status: 201);    
    }
}
