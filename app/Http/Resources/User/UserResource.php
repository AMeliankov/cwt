<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\IncludeRelatedEntitiesResourceTrait;
use App\Http\Resources\Role\RoleIdentifierResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Visit\VisitIdentifierResource;
use App\Http\Resources\Visit\VisitResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use IncludeRelatedEntitiesResourceTrait;

    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => User::MODEL_TYPE,
            'attributes' => [
                'name' => $this->name,
                'login' => $this->login,
                'avatar' => $this->avatar,
                'phone' => $this->phone
            ],
            'relationships' => [
                'role' => [
                    'data' => new RoleIdentifierResource($this->whenLoaded('role')),
                    'links' => [
                        'self' => route('users.relationships.role', ['id' => $this->id]),
                        'related' => route('users.role', ['id' => $this->id])
                    ]
                ],
                'visits' => [
                    'data' => VisitIdentifierResource::collection($this->whenLoaded('visits')),
                    'links' => [
                        'self' => route('users.relationships.visits', ['id' => $this->id]),
                        'related' => route('users.visits', ['id' => $this->id])
                    ]
                ],
            ]
        ];
    }

    /**
     * @return array
     */
    protected function relations(): array
    {
        return [
            RoleResource::class => $this->whenLoaded('role'),
            VisitResource::class => $this->whenLoaded('visits')
        ];
    }
}
