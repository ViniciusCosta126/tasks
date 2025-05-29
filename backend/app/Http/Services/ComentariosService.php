<?php

namespace App\Http\Services;

use App\Models\Comentario;

class ComentariosService
{
    public function getAllComment()
    {
        return Comentario::all();
    }

    public function createComment($data): Comentario
    {
        $comment = Comentario::create($data);
        return $comment;
    }

    public function getCommentById($id): Comentario|null
    {
        return Comentario::where('id', $id)->first();
    }

    public function updateComment(Comentario $comment, $data): Comentario
    {
        $comment->update($data);
        return $comment;
    }

    public function deleteComment(Comentario $comment)
    {
        $comment->delete();
    }
}