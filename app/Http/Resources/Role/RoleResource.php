<?php

declare(strict_types=1);

namespace App\Http\Resources\Role;

use App\Http\Resources\IncludeRelatedEntitiesResourceTrait;
use App\Http\Resources\User\UserIdentifierCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    use IncludeRelatedEntitiesResourceTrait;

    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => Role::MODEL_TYPE,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug
            ],
            'relationships' => [
                'users' => [
                    'data' => new UserIdentifierCollection($this->whenLoaded('users')),
                    'links' => [
                        'self' => route('roles.relationships.users', ['id' => $this->id]),
                        'related' => route('roles.users', ['id' => $this->id])
                    ]
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    protected function relations(): array
    {
        return [
            UserResource::class => $this->whenLoaded('users')
        ];
    }
}
