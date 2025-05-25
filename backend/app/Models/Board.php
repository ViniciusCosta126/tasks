<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['titulo', 'user_id', 'ativo'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
