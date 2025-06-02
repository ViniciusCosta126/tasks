<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\BoardResource;
use App\Models\Board;

class BoardService
{
    public function getAllBoardsActive()
    {
        $boards = Board::with(['colunas'])->where('ativo', 1)->orderBy('id')->get();
        return BoardResource::collection($boards);
    }

    public function createBoard($data): BoardResource
    {
        $board = Board::create($data);
        return new BoardResource($board);
    }

    public function getBoardById($id): ?Board
    {
        $board = Board::with(['colunas'])->where('id', $id)->first();
        if (!$board) {
            throw new NotFoundException("Board com id:$id não encontrado.");
        }

        return $board;
    }

    public function updateBoard(Board $board, $data): BoardResource
    {
        $board->update($data);
        return new BoardResource($board);
    }

    public function deleteBoard(Board $board)
    {
        $board->delete();
    }
}