<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Models\Coluna;
class ColunaService
{
    public function getAllColumns()
    {
        return Coluna::all();
    }

    public function createColumn($data): Coluna
    {
        $coluna = Coluna::create($data);
        return $coluna;
    }

    public function getColumnById($id): Coluna|null
    {
        $column = Coluna::where('id', $id)->first();

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