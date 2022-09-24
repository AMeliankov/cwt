<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIdentifierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => User::MODEL_TYPE
        ];
    }
}
