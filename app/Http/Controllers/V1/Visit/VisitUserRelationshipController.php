<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Visit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Visit\VisitIdentifierResource;
use App\Services\Entities\VisitService;

class VisitUserRelationshipController extends Controller
{
    public VisitService $visitService;

    public function __construct(VisitService $visitService)
    {
        $this->visitService = $visitService;
    }

    public function show(int $id): VisitIdentifierResource
    {
        $visit = $this->visitService->show($id);

        return new VisitIdentifierResource($visit->user);
    }
}
