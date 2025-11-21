<?php

namespace App\Http\Controllers\Obras;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Obras;

class ObrasController extends BaseController
{
    public function __construct()
    {
        // Somente admin e gerente podem criar, atualizar e excluir
        $this->middleware(['auth:sanctum', 'role:admin|gerente'])
        ->only(['store', 'update', 'destroy']);

        // Qualquer usuário autenticado pode visualizar
        $this->middleware(['auth:sanctum'])
            ->only(['index', 'show']);
    }

    public function index()
    {
        return response()->json([
            'obras' => Obras::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nome_obra' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date',
            'fim_real' => 'nullable|date',
            'status' => 'required|in:Em Planejamento,Em Andamento,Cancelada,Concluída',
        ]);

        $validateData['user_id'] = Auth::id();

        $obra = Obras::create($validateData);

        return response()->json([
            'message' => 'Obra criada com sucesso!',
            'obra' => $obra,
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json([
            'obra' => Obras::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $obra = Obras::findOrFail($id);
        $obra->update($request->all());

        return response()->json([
            'message' => 'Obra atualizada com sucesso!',
            'obra' => $obra,
        ]);
    }

    public function destroy(string $id)
    {
        $obra = Obras::findOrFail($id);
        $obra->delete();

        return response()->json([
            'message' => 'Obra excluída com sucesso!'
        ]);
    }
}
