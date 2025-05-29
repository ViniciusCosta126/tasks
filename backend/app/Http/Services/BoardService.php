<?php

namespace App\Http\Services;

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
        return Board::where('id', $id)->first();
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