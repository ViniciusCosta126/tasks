<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColunaRequest;
use App\Http\Requests\UpdateColunaRequest;
use App\Http\Services\ColunaService;
use App\Traits\TraitHttpResponses;
use Illuminate\Http\JsonResponse;

class ColunaController extends Controller
{

    public ColunaService $colunaService;
    use TraitHttpResponses;
    public function __construct(ColunaService $colunaService)
    {
        $this->colunaService = $colunaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $colunas = $this->colunaService->getAllColumns();
        return $this->success($colunas, "Colunas trazidas com suceso!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColunaRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $coluna = $this->colunaService->createColumn($validated);

        return $this->success($coluna, "Coluna criada com sucesso!", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $coluna = $this->colunaService->getColumnById($id);
        return $this->success($coluna, "Coluna trazida com sucesso!");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColunaRequest $request, $id): JsonResponse
    {
        $coluna = $this->colunaService->getColumnById($id);
        $validated = $request->validated();
        $coluna = $this->colunaService->columnUpdate($coluna, $validated);
        return $this->success($coluna, "Coluna atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $coluna = $this->colunaService->getColumnById($id);
        $this->colunaService->columnDelete($coluna);
        return $this->success("", "", 204);
    }
}
