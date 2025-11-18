<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();

        return response()->json([
                'status' => 'OK',
                'user' => $user,                
            ], status: 200);
    }
}
