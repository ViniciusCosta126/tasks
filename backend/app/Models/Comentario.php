<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['comentario', 'user_id', 'task_id'];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
