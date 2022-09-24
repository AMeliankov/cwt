<?php

namespace App\Http\Controllers\V1\Visit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Visit\StoreRequest;
use App\Http\Requests\Visit\UpdateRequest;
use App\Http\Resources\Visit\VisitCollection;
use App\Http\Resources\Visit\VisitResource;
use App\Services\Entities\VisitService;
use Symfony\Component\HttpFoundation\Response;

final class VisitController extends Controller
{
    public VisitService $visitService;

    public function __construct(VisitService $visitService)
    {
        $this->visitService = $visitService;
    }

    public function index(): VisitCollection
    {
        return new VisitCollection($this->visitService->index());
    }

    public function show(int $id): VisitResource
    {
        return new VisitResource($this->visitService->show($id));
    }

    public function store(StoreRequest $request): Response
    {
        $visit = $this->visitService->store($request)->withoutRelations();

        return (new VisitResource($visit))
            ->response()
            ->withHeaders([
                'Location' => route('visits.show', ['id' => $visit->id])
            ]);
    }

    public function update(UpdateRequest $request, int $id): VisitResource
    {
        return new VisitResource($this->visitService->update($request, $id));
    }

    public function destroy(int $id): Response
    {
        $this->visitService->destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
