<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Services\BoardService;
use Illuminate\Http\JsonResponse;

class BoardController extends Controller
{
    public BoardService $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $boards = $this->boardService->getAllBoardsActive();
        return response()->json(["boards" => $boards], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoardRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $board = $this->boardService->createBoard($validated);
            return response()->json(['message' => "Board criada com sucesso!", "board" => $board], 201);
        }
        return response()->json(["message" => "Erro ao criar board, valide os campos"], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $board = $this->boardService->getBoardById($id);

        if (empty($board)) {
            return response()->json(["message" => "Board não encontrada!"], 404);
        }

        return response()->json(["message" => "Board encontrada como sucesso!", "board" => $board], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, $id)
    {
        $board = $this->boardService->getBoardById($id);

        if (empty($board)) {
            return response()->json(["message" => "Board não encontrada"], 404);
        }

        $validated = $request->validated();
        $board = $this->boardService->updateBoard($board, $validated);

        return response()->json(["message" => "Board atualizada com sucesso!", "board" => $board], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $board = $this->boardService->getBoardById($id);
        if (empty($board)) {
            return response()->json(["message" => "Board não encontrada"], 404);
        }

        $this->boardService->deleteBoard($board);
        return response()->json(["message" => "Board excluida com sucesso!"], 204);
    }
}
