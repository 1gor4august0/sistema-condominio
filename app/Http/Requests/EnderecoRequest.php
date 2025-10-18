<?php

namespace App\Http\Requests;

use App\Rules\UsuarioRule;
use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
{
    protected $rule;

    public function __construct(UsuarioRule $rule)
    {
        $this->rule = $rule;
    }

    public function authorize(): bool
    {
        $isProprietario = $this->rule->isProprietario();
        return $isProprietario;
    }

    public function rules(): array
    {
        return [
            'cep' => 'required|string|min:9|max:9',
            'logradouro' => 'required|string',
            'complemento' => 'required|string',
            'bairro' => 'required|string',
            'cidade_id' => 'required|exists:cidades,id'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => 'O campo :attribute deve ter no máximo :max.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.'
        ];
    }
}
