<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleIdentifierCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
