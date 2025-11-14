<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'      => 'string',
            'email'     => 'email|unique:users,email,' . $this->user->id,
            'password'  => 'nullable|min:6',
            'role'      => 'in:admin,manager',
            'event_ids' => 'array'
        ];
    }
}
