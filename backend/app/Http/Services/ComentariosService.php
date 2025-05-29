<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\ComentarioResource;
use App\Models\Comentario;

class ComentariosService
{
    public function getAllComment()
    {
        return ComentarioResource::collection(Comentario::all());
    }

    public function createComment($data): ComentarioResource
    {
        $comment = Comentario::create($data);
        return new ComentarioResource($comment);
    }

    public function getCommentById($id): ComentarioResource|null
    {
        $comment = Comentario::where('id', $id)->first();

        if (!$comment) {
            throw new NotFoundException("Comentario com id:$id não encontrado.");
        }

        return new ComentarioResource($comment);
    }

    public function updateComment(Comentario $comment, $data): ComentarioResource
    {
        $comment->update($data);
        return new ComentarioResource($comment);
    }

    public function deleteComment(Comentario $comment)
    {
        $comment->delete();
    }
}