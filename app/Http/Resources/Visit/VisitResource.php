<?php

declare(strict_types=1);

namespace App\Http\Resources\Visit;

use App\Http\Resources\IncludeRelatedEntitiesResourceTrait;
use App\Http\Resources\User\UserIdentifierResource;
use App\Http\Resources\User\UserResource;
use App\Models\Visit;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
{
    use IncludeRelatedEntitiesResourceTrait;

    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => Visit::MODEL_TYPE,
            'attributes' => [
                'name' => $this->name,
                'come' => format_date_time($this->come),
                'quit' => format_date_time($this->quit),
                'minutes' => $this->minutes,
                'date' => format_date($this->date)
            ],
            'relationships' => [
                'user' => [
                    'data' => new UserIdentifierResource($this->whenLoaded('user')),
                    'links' => [
                        'self' => route('visits.relationships.user', ['id' => $this->id]),
                        'related' => route('visits.user', ['id' => $this->id])
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
            UserResource::class => $this->whenLoaded('user')
        ];
    }
}
