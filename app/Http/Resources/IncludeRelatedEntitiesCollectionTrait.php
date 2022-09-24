<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;

trait IncludeRelatedEntitiesCollectionTrait
{
    /**
     * @param $request
     * @return Collection
     */
    private function mergeIncludedRelations($request): Collection
    {
        $includes = $this->collection->flatMap(function ($resource) use ($request) {
            return $resource->included($request);
        })->unique()->values();

        return $includes->isNotEmpty() ? $includes : collect();
    }
}
