<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function store(array $attributes): Model
    {
        return User::query()->create($attributes);
    }

    public function update(User $user, array $attributes): Model
    {
        $user->update($attributes);

        return $user;
    }

    public function destroy(User $user): bool
    {
        return $user->delete();
    }

    public function index(): Collection
    {
        return QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('login', 'login'),
                AllowedFilter::exact('phone', 'phone'),
                AllowedFilter::exact('role_id', 'role.id'),
                AllowedFilter::exact('role_slug', 'role.slug')
            ])
            ->allowedIncludes([
                'role',
                'visits'
            ])
            ->allowedSorts([
                'id'
            ])->get();
    }

    public function show(int $id): Model
    {
        return QueryBuilder::for(User::class)
            ->allowedIncludes([
                'role',
                'visits'
            ])
            ->findOrFail($id);
    }

    public function associateRole(User $user, int $roleId): void
    {
        $role = Role::query()->findOrFail($roleId);

        $user->role()->associate($role);

        $user->save();
    }
}
