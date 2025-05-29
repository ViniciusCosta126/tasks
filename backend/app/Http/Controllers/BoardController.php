<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Services\BoardService;
use App\Traits\TraitHttpResponses;
use Illuminate\Http\JsonResponse;

class BoardController extends Controller
{
    public BoardService $boardService;
    use TraitHttpResponses;
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
        return $this->success($boards, "Boards listadas com sucesso!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoardRequest $request)
    {
        $validated = $request->validated();
        $board = $this->boardService->createBoard($validated);
        return $this->success($board, "Board criada com sucesso!", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $board = $this->boardService->getBoardById($id);
        return $this->success($board, "Board encontrada como sucesso!");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, $id)
    {
        $board = $this->boardService->getBoardById($id);
        $validated = $request->validated();
        $board = $this->boardService->updateBoard($board, $validated);

        return $this->success($board, "Board atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $board = $this->boardService->getBoardById($id);
        $this->boardService->deleteBoard($board);
        return $this->success("", "", 204);
    }
}
