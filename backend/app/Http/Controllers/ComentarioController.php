<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Http\Services\ComentariosService;
use Exception;
use Illuminate\Http\JsonResponse;

class ComentarioController extends Controller
{

    public ComentariosService $comentariosService;

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
        return response()->json(['comentarios' => $comentarios], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComentarioRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $comentario = $this->comentariosService->createComment($validated);
            return response()->json(["message" => "comentario criado com sucesso", "comentario" => $comentario], 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao criar comentario.", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $comentario = $this->comentariosService->getCommentById($id);

            if (empty($comentario)) {
                return response()->json(['message' => "Comentario não econtrado"], 404);
            }

            return response()->json(["comentario", $comentario], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao buscar comentario", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComentarioRequest $request, $id)
    {
        try {
            $comentario = $this->comentariosService->getCommentById($id);

            if (empty($comentario)) {
                return response()->json(['message' => "Comentario não econtrado"], 404);
            }

            $validated = $request->validated();
            $comentario = $this->comentariosService->updateComment($comentario, $validated);
            return response()->json(["message" => "Comentario atualizado com sucesso!", "comentario" => $comentario], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao editar comentario"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $comentario = $this->comentariosService->getCommentById($id);

            if (empty($comentario)) {
                return response()->json(["message" => "Erro ao encontrar comentario"], 404);
            }
            $this->comentariosService->deleteComment($comentario);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => "Erro ao apagar comentario"], 500);
        }
    }
}
