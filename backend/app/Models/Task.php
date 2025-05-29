<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'titulo',
        'responsavel_id',
        'criador_id',
        'data_vencimento',
        'coluna_id',
        'descricao',
        'ativa'
    ];
    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function criador()
    {
        return $this->belongsTo(User::class, 'criador_id');
    }

    public function coluna()
    {
        return $this->belongsTo(Coluna::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
