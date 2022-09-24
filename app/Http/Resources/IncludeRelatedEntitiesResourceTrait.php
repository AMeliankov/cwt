<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait IncludeRelatedEntitiesResourceTrait
{
    /**
     * @param $request
     * @return array
     */
    public function with($request)
    {
        $with = [];

        if ($this->included($request)->isNotEmpty()) {
            $with['included'] = $this->included($request);
        }

        return $with;
    }

    /**
     * @param $request
     * @return Collection
     */
    public function included($request): Collection
    {
        return collect($this->prepareRelations())
            ->filter(function ($resource) {
                return $resource->collection !== null;
            })
            ->flatMap(function ($resource) use ($request) {
                return $resource->flatten($request);
            });
    }

    /**
     * @return array
     */
    protected function prepareRelations(): array
    {
        $relations = [];

        foreach ($this->relations() as $key => $relation) {
            if ($relation instanceof Model) {
                $relations[] = $key::collection([$relation]);
            }
            if ($relation instanceof Collection) {
                $relations[] = $key::collection($relation);
            }
        }

        return $relations;
    }
}
