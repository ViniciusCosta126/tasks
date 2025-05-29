<?php

namespace App\Http\Resources;

use App\Http\Helpers\StringHelper;
use App\Http\Helpers\UserHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComentarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->comentario,
            "user_id" => $this->user_id,
            "user_name" => UserHelper::getNameByUserId($this->user_id),
            "task_id" => $this->id,
            "criado_em" => StringHelper::convertDateDayMonthYearHours($this->created_at)
        ];
    }
}
