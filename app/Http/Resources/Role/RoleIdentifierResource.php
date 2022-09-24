<?php

namespace App\Http\Resources\Role;

use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleIdentifierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => Role::MODEL_TYPE
        ];
    }
}
