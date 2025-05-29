<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Models\Board;

class BoardService
{
    public function getAllBoardsActive()
    {
        return Board::where('ativo', 1)->get();
    }

    public function createBoard($data): Board
    {
        $board = Board::create($data);
        return $board;
    }

    public function getBoardById($id): ?Board
    {
        $board = Board::where('id', $id)->first();
        if (!$board) {
            throw new NotFoundException("Board com id:$id não encontrado.");
        }

        return $board;
    }

    public function updateBoard(Board $board, $data): Board
    {
        $board->update($data);
        return $board;
    }

    public function deleteBoard(Board $board)
    {
        $board->delete();
    }
}