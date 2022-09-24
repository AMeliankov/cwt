<?php

declare(strict_types=1);

namespace App\Http\Resources\Visit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VisitCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
//            'links' => [
//                'self' => route('visits.index')
//            ]
        ];
    }
}
