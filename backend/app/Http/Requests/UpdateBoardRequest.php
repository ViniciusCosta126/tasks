<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => [
                'sometimes',
                'max:255',
                Rule::unique('boards', 'titulo')->ignore($this->board),
            ],
            'user_id' => 'sometimes|exists:users,id',
            'ativo' => 'sometimes|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',
            'titulo.unique' => 'Já existe uma board com este título.',

            'user_id.exists' => 'O usuário informado não existe.',

            'ativo.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
