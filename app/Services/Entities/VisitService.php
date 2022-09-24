<?php

declare(strict_types=1);

namespace App\Services\Entities;

use App\Http\Requests\Visit\StoreRequest;
use App\Http\Requests\Visit\UpdateRequest;
use App\Models\Visit;
use App\Pipelines\Visit\VisitPipeline;
use App\Repositories\Visit\VisitRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class VisitService
{
    private VisitRepositoryInterface $visitRepository;
    private VisitPipeline $visitPipeline;

    public function __construct(
        VisitRepositoryInterface $visitRepository,
        VisitPipeline $visitPipeline
    ) {
        $this->visitRepository = $visitRepository;
        $this->visitPipeline = $visitPipeline;
    }

    public function index(): Collection
    {
        return $this->visitRepository->index();
    }

    public function show(int $id): Model
    {
        return $this->visitRepository->show($id);
    }

    public function store(StoreRequest $request): Model
    {
        $data = $request->validated();

        return $this->visitPipeline->store($data);
    }

    public function update(UpdateRequest $request, int $id): Model
    {
        $data = $request->validated();

        data_set($data, 'model', Visit::findOrFail($id));

        return $this->visitPipeline->update($data);
    }

    public function destroy(int $id): bool
    {
        $data = [];

        data_set($data, 'model', Visit::findOrFail($id));

        return $this->visitPipeline->destroy($data);
    }
}
