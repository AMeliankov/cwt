<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Visit;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Services\Entities\VisitService;

class VisitUserRelationController extends Controller
{
    public VisitService $visitService;

    public function __construct(VisitService $visitService)
    {
        $this->visitService = $visitService;
    }

    public function show(int $id): UserResource
    {
        $visit = $this->visitService->show($id);

        return new UserResource($visit->user);
    }
}
