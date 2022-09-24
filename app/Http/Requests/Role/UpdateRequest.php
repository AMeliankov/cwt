<?php

declare(strict_types=1);

namespace App\Http\Requests\Role;

use Anik\Form\FormRequest;

class UpdateRequest extends FormRequest
{
    protected function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.type' => ['required', 'string', 'in:role'],
            'data.attributes.name' => ['string', 'unique:roles,name']
        ];
    }
}
