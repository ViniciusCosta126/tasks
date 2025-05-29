<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreColunaRequest extends FormRequest
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
            'titulo' => 'required|unique:colunas,titulo|max:255',
            'board_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.unique' => 'Já existe uma coluna com este título.',
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',

            'board_id.required' => 'O campo board é obrigatório.',
        ];
    }
}
