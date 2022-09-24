<?php

namespace App\Http\Resources\Visit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VisitIdentifierCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
