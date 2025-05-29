<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coluna extends Model
{
    protected $fillable = ['titulo', 'board_id'];
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
