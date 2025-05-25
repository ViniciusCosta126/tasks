<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColunaRequest;
use App\Http\Requests\UpdateColunaRequest;
use App\Models\Coluna;
use Illuminate\Http\JsonResponse;

class ColunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $colunas = Coluna::all();
        return response()->json(['colunas' => $colunas], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColunaRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $coluna = Coluna::create($validated);
        return response()->json(["message" => "Coluna criada com sucesso!", "coluna" => $coluna], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $coluna = Coluna::where('id', $id)->first();

        if (empty($coluna)) {
            return response()->json(['message' => "Coluna não encontrada!"], 404);
        }

        return response()->json(['coluna' => $coluna], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColunaRequest $request, $id): JsonResponse
    {
        $coluna = Coluna::where('id', $id)->first();

        if (empty($coluna)) {
            return response()->json(['message' => "Coluna não encontrada!"], 404);
        }

        $validated = $request->validated();
        $coluna->update($validated);

        return response()->json(['message' => "Coluna atualizada com sucesso!", 'coluna' => $coluna], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $coluna = Coluna::where('id', $id)->first();

        if (empty($coluna)) {
            return response()->json(['message' => "Coluna não encontrada!"], 404);
        }

        $coluna->delete();
        return response()->json(['message' => "Coluna excluida com sucesso!"], 204);
    }
}
