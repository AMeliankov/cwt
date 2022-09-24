<?php

declare(strict_types=1);

namespace App\Http\Requests\Visit;

use Anik\Form\FormRequest;

class UpdateRequest extends FormRequest
{
    protected function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.type' => ['required', 'string', 'in:visit'],
            'data.attributes.quit' => ['required', 'string', 'date_format:d.m.Y H:s']
        ];
    }
}
