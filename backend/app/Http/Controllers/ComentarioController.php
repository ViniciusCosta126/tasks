<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Http\Services\ComentariosService;
use App\Traits\TraitHttpResponses;
use Illuminate\Http\JsonResponse;

class ComentarioController extends Controller
{

    public ComentariosService $comentariosService;
    use TraitHttpResponses;

    public function __construct(ComentariosService $comentariosService)
    {
        $this->comentariosService = $comentariosService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $comentarios = $this->comentariosService->getAllComment();
        return $this->success($comentarios, "Comentarios listados com sucesso!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComentarioRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $comentario = $this->comentariosService->createComment($validated);
        return $this->success($comentario, "Comentario criado com sucesso!", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $comentario = $this->comentariosService->getCommentById($id);
        return $this->success($comentario, "Comentario listado com sucesso!");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComentarioRequest $request, $id)
    {
        $comentario = $this->comentariosService->getCommentById($id);
        $validated = $request->validated();
        $comentario = $this->comentariosService->updateComment($comentario, $validated);
        return $this->success($comentario, "Comentario atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $comentario = $this->comentariosService->getCommentById($id);
        $this->comentariosService->deleteComment($comentario);
        return $this->success('', '', 204);
    }
}
