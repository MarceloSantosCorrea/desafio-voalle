<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        $this->merge(['is_active' => $this->get('is_active') == 'on']);

        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['max:255'],
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password'  => ['nullable', 'min:8', 'confirmed'],
        ];
    }
}
