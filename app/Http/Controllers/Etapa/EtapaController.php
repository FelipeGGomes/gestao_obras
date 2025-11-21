<?php

namespace App\Http\Controllers\Etapa;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Etapas;


class EtapaController extends BaseController
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
            'etapas' => Etapas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nome_etapa' => 'required|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date',
            'fim_real' => 'nullable|date',
            'status' => 'required|in:Nao Iniciada,Em progresso,Bloqueada,Concluída',
            'obra_id' => 'required|exists:obras,id',
        ]);

        $validateData['user_id'] = Auth::id();

        $etapa = Etapas::create($validateData);

        return response()->json([
            'message' => 'Etapa criada com sucesso!',
            'etapa' => $etapa,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'etapa' => Etapas::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $etapa = Etapas::findOrFail($id);
        $etapa->update($request->all());

        return response()->json([
            'message' => 'Etapa atualizada com sucesso!',
            'etapa' => $etapa,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etapa = Etapas::findOrFail($id);
        $etapa->delete();

        return response()->json([
            'message' => 'Etapa excluída com sucesso!'
        ]);
    }

}