<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'titulo' => 'sometimes|required|string|max:255',
            'responsavel_id' => 'sometimes|required|exists:users,id',
            'coluna_id' => 'sometimes|required|exists:colunas,id',
            'descricao' => 'sometimes|required|string',
            'ativa' => 'sometimes|boolean',
            'data_vencimento' => 'sometimes|required|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório quando enviado.',
            'titulo.string' => 'O título deve ser um texto.',
            'titulo.max' => 'O título deve ter no máximo 255 caracteres.',

            'responsavel_id.required' => 'O responsável deve ser informado quando enviado.',
            'responsavel_id.exists' => 'O responsável selecionado é inválido.',

            'coluna_id.required' => 'A coluna é obrigatória quando enviada.',
            'coluna_id.exists' => 'A coluna selecionada é inválida.',

            'descricao.required' => 'A descrição é obrigatória quando enviada.',
            'descricao.string' => 'A descrição deve ser um texto.',

            'ativa.boolean' => 'O campo ativa deve ser verdadeiro ou falso.',

            'data_vencimento.required' => 'A data de vencimento é obrigatória quando enviada.',
            'data_vencimento.date' => 'A data de vencimento deve ser uma data válida.',
            'data_vencimento.after_or_equal' => 'A data de vencimento não pode ser anterior a hoje.',
        ];
    }
}
