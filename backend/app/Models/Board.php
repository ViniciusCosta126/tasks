<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['titulo', 'user_id', 'ativo'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colunas()
    {
        return $this->hasMany(Coluna::class);
    }
}
