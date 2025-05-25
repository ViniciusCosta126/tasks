<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\Board;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $boards = Board::where('ativo', 1)->get();
        return response()->json(["boards" => $boards], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoardRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $board = Board::create($validated);
            return response()->json(['message' => "Board criada com sucesso!", "board" => $board], 201);
        }
        return response()->json(["message" => "Erro ao criar board, valide os campos"], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $board = Board::where('id', $id)->first();

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
        $board = Board::where('id', $id)->first();
        if (empty($board)) {
            return response()->json(["message" => "Board não encontrada"], 404);
        }

        $validated = $request->validated();
        $board->update($validated);

        return response()->json(["message" => "Board atualizada com sucesso!", "board" => $board], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $board = Board::where('id', $id)->first();
        if (empty($board)) {
            return response()->json(["message" => "Board não encontrada"], 404);
        }

        $board->delete();
        return response()->json(["message" => "Board excluida com sucesso!"], 204);
    }
}
