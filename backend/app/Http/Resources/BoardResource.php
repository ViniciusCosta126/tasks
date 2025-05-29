<?php

namespace App\Http\Resources;

use App\Http\Helpers\StringHelper;
use App\Http\Helpers\UserHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'user' => $this->user_id,
            'criado_por' => UserHelper::getNameByUserId($this->user_id),
            'ativo' => (bool) $this->ativo,
            'criado_em' => StringHelper::convertDateDayMonthYear($this->created_at),
            'colunas' => ColunaResource::collection($this->whenLoaded('colunas'))
        ];
    }
}
