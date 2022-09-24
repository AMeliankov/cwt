<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Anik\Form\FormRequest;

class StoreRequest extends FormRequest
{
    protected function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.type' => ['required', 'string', 'in:user'],
            'data.attributes.login' => ['required', 'string', 'unique:users,login'],
            'data.attributes.password' => ['required', 'string', 'confirmed', 'min:8'],
            'data.attributes.name' => ['required', 'string'],
            'data.attributes.avatar' => ['required', 'string'],
            'data.attributes.phone' => ['required', 'string'],
            'data.relationships.role.data.id' => ['required', 'string', 'exists:roles,id'],
            'data.relationships.role.data.type' => ['required', 'in:role']
        ];
    }
}
