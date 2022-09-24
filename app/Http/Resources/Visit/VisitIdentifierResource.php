<?php

namespace App\Http\Resources\Visit;

use App\Models\Visit;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitIdentifierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => Visit::MODEL_TYPE
        ];
    }
}
