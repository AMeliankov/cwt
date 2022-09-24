<?php

declare(strict_types=1);

namespace App\Services\Entities;

use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use App\Pipelines\Role\RolePipeline;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class RoleService
{
    private RoleRepositoryInterface $roleRepository;
    private RolePipeline $rolePipeline;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        RolePipeline $rolePipeline,
    ) {
        $this->roleRepository = $roleRepository;
        $this->rolePipeline = $rolePipeline;
    }

    public function index(): Collection
    {
        return $this->roleRepository->index();
    }

    public function show(int $id): Model
    {
        return $this->roleRepository->show($id);
    }

    public function store(StoreRequest $request): Model
    {
        $data = $request->validated();

        return $this->rolePipeline->store($data);
    }

    public function update(UpdateRequest $request, int $id): Model
    {
        $data = $request->validated();

        data_set($data, 'model', Role::findOrFail($id));

        return $this->rolePipeline->update($data);
    }

    public function destroy(int $id): bool
    {
        $data = [];

        data_set($data, 'model', Role::findOrFail($id));

        return $this->rolePipeline->destroy($data);
    }
}
