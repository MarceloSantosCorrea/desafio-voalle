<?php

namespace App\Http\Requests\Client;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'cpf'   => ['required', 'string', 'max:14', new Cpf],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'phone' => ['required', 'string', 'max:14'],
        ];
    }
}
