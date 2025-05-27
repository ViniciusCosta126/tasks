<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'responsavel_id' => 'required|exists:users,id',
            'criador_id' => 'required|exists:users,id',
            'coluna_id' => 'required|exists:colunas,id',
            'descricao' => 'required|string',
            'ativa' => 'boolean',
            'data_vencimento' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O título deve ser um texto.',
            'titulo.max' => 'O título deve ter no máximo 255 caracteres.',

            'responsavel_id.required' => 'O responsável deve ser informado.',
            'responsavel_id.exists' => 'O responsável selecionado é inválido.',

            'criador_id.required' => 'O criador deve ser informado.',
            'criador_id.exists' => 'O criador selecionado é inválido.',

            'coluna_id.required' => 'A coluna é obrigatória.',
            'coluna_id.exists' => 'A coluna selecionada é inválida.',

            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser um texto.',

            'ativa.boolean' => 'O campo ativa deve ser verdadeiro ou falso.',

            'data_vencimento.required' => 'A data de vencimento é obrigatória.',
            'data_vencimento.date' => 'A data de vencimento deve ser uma data válida.',
            'data_vencimento.after_or_equal' => 'A data de vencimento não pode ser anterior a hoje.',
        ];
    }
}
