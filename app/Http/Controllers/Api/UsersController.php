<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        User::all();
        return response()->json([
            'status' => 'OK',
            'users' => User::all(),                
        ], status: 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'cpf' => 'required|string|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,gerente,colaborador',
    ]);

    $data['password'] = bcrypt($data['password']);

    $user = User::create($data);

    $user->assignRole($data['role']);

    return response()->json([
        'message' => 'Usuário criado com sucesso!',
        'user' => $user,
        'roles' => $user->getRoleNames(),
    ], 201);
    }

  
    public function show(string $id)
    {
        return response()->json([
            'status' => 'OK',
            'user' => User::findOrFail($id),                
        ], status: 200);
    }

    /** 
     * Show the form for editing the specified resource.
     */
   
public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    // Validação opcional
    $validated = $request->validate([
        'name' => 'string|max:255',
        'email' => 'email|max:255',
        'cpf' => 'string|unique:users,cpf,' . $user->id,
        'password' => 'nullable|string|min:6',
        'status' => 'nullable|in:0,1',
        'role' => 'nullable|in:admin,gerente,colaborador',
    ]);

    // Atualiza os dados do usuário (exceto role)
    if (isset($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    }

    $user->update(collect($validated)->except('role')->toArray());

    // Se o usuário enviou um role novo → atualiza o role no spatie
    if ($request->has('role')) {

        // Remove todos os roles antigos
        $user->syncRoles([]);

        // Aplica o novo role
        $user->assignRole($request->role);
    }

    return response()->json([
        'status' => 'OK',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cpf' => $user->cpf,
            'status' => $user->status,
            'role' => $user->getRoleNames()->first(), // mostra o role correto
        ],
    ], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $user = User::findOrFail($id);
       $user->delete();
    }
}
