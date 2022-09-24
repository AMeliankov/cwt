<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Anik\Form\FormRequest;

class UpdateRequest extends FormRequest
{
    protected function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.type' => ['required', 'string', 'in:user'],
            'data.attributes.login' => ['string', 'unique:users,login'],
            'data.attributes.password' => ['string', 'confirmed', 'min:8'],
            'data.attributes.name' => ['string'],
            'data.attributes.avatar' => ['string'],
            'data.attributes.phone' => ['string'],
            'data.relationships.role.data.id' => ['string', 'exists:roles,id'],
            'data.relationships.role.data.type' => ['string', 'in:role']
        ];
    }
}
