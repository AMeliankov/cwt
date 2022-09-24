<?php

declare(strict_types=1);

namespace App\Http\Resources\Role;

use App\Http\Resources\IncludeRelatedEntitiesCollectionTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    use IncludeRelatedEntitiesCollectionTrait;

    public function toArray($request)
    {
        $included = $this->mergeIncludedRelations($request);

        return [
            'data' => $this->collection,
            'included' => $this->when($included->isNotEmpty(), $included),
//            'links' => [
//                'self' => route('roles.index')
//            ]
        ];
    }
}
