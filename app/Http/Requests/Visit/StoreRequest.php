<?php

declare(strict_types=1);

namespace App\Http\Requests\Visit;

use Anik\Form\FormRequest;

class StoreRequest extends FormRequest
{
    protected function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.type' => ['required', 'string', 'in:visit'],
            'data.attributes.come' => ['required', 'string', 'date_format:d.m.Y H:s'],
            'data.attributes.date' => ['required', 'date_format:d.m.Y'],
            'data.relationships.user.data.id' => ['required', 'string', 'exists:users,id'],
            'data.relationships.user.data.type' => ['required', 'string', 'in:user']
        ];
    }
}
