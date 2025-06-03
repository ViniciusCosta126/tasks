<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\ColunaResource;
use App\Models\Coluna;
class ColunaService
{
    public function getAllColumns()
    {
        $colunas = Coluna::with(['board', 'tasks'])->get();
        return ColunaResource::collection($colunas);
    }

    public function createColumn($data): ColunaResource
    {
        $coluna = Coluna::create($data);
        return new ColunaResource($coluna);
    }

    public function getColumnById($id): Coluna|null
    {
        $column = Coluna::with(['board', 'tasks'])->where('id', $id)->first();

        if (!$column) {
            throw new NotFoundException("Coluna não encontrada!");
        }
        return $column;
    }

    public function columnUpdate(Coluna $column, $data): Coluna
    {
        $column->update($data);
        return $column;
    }

    public function columnDelete(Coluna $column)
    {
        $column->delete();
    }
}