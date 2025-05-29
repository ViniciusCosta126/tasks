<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComentarioRequest extends FormRequest
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
            'comentario' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'task_id' => 'required|integer|exists:tasks,id',
        ];
    }

    public function messages(): array
    {
        return [
            'comentario.required' => 'O campo comentário é obrigatório.',
            'comentario.string' => 'O campo comentário deve ser um texto.',

            'user_id.required' => 'O campo usuário é obrigatório.',
            'user_id.integer' => 'O campo usuário deve ser um número inteiro.',
            'user_id.exists' => 'O usuário informado não existe.',

            'task_id.required' => 'O campo tarefa é obrigatório.',
            'task_id.integer' => 'O campo tarefa deve ser um número inteiro.',
            'task_id.exists' => 'A tarefa informada não existe.',
        ];
    }
}
