<?php

namespace App\Http\Services;

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
        return Coluna::where('id', $id)->first();
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