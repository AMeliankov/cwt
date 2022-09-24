<?php

declare(strict_types=1);

namespace App\Http\Requests\Role;

use Anik\Form\FormRequest;

class StoreRequest extends FormRequest
{
    protected function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.type' => ['required', 'string', 'in:role'],
            'data.attributes.name' => ['required', 'string', 'unique:roles,name']
        ];
    }
}
