<?php

declare(strict_types=1);

namespace App\Repositories\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class EloquentRoleRepository implements RoleRepositoryInterface
{
    public function store(array $attributes): Model
    {
        return Role::query()->create($attributes);
    }

    public function update(Role $role, array $attributes): Model
    {
        $role->update($attributes);

        return $role;
    }

    public function destroy(Role $role): bool
    {
        return $role->delete();
    }

    public function index(): Collection
    {
        return QueryBuilder::for(Role::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('slug', 'slug'),
            ])
            ->allowedIncludes([
                'users'
            ])
            ->allowedSorts([
                'id'
            ])->get();
    }

    public function show(int $id): Model
    {
        return QueryBuilder::for(Role::class)
            ->allowedIncludes([
                'users'
            ])
            ->findOrFail($id);
    }
}
