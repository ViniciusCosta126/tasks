<?php

namespace App\Http\Resources;

use App\Http\Helpers\StringHelper;
use App\Http\Helpers\UserHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "titulo" => $this->titulo,
            "resposanvel_id" => $this->responsavel_id,
            "responsavel_nome" => UserHelper::getNameByUserId($this->responsavel_id),
            "criador_id" => $this->criador_id,
            "criador_nome" => UserHelper::getNameByUserId($this->criador_id),
            "descricao" => $this->descricao,
            "ativa" => (bool) $this->ativa,
            "data_vencimento" => StringHelper::convertDateDayMonthYearHours($this->data_vencimento),
            "data_criacao" => StringHelper::convertDateDayMonthYearHours($this->created_at),
            "comentarios" => ComentarioResource::collection($this->whenLoaded('comentarios'))
        ];
    }
}
