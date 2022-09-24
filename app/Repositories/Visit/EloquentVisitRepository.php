<?php

declare(strict_types=1);

namespace App\Repositories\Visit;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class EloquentVisitRepository implements VisitRepositoryInterface
{
    public function store(array $attributes): Model
    {
        return Visit::query()->create($attributes);
    }

    public function update(Visit $visit, array $attributes): Model
    {
        $visit->update($attributes);

        return $visit;
    }

    public function destroy(Visit $visit): bool
    {
        return $visit->delete();
    }

    public function index(): Collection
    {
        return QueryBuilder::for(Visit::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('date', 'date'),
                AllowedFilter::exact('user_id', 'user.id')
            ])
            ->allowedIncludes([
                'user'
            ])
            ->allowedSorts([
                'id'
            ])->get();
    }

    public function show(int $id): Model
    {
        return QueryBuilder::for(Visit::class)
            ->allowedIncludes([
                'user'
            ])
            ->findOrFail($id);
    }

    public function associateUser(Visit $visit, int $userId): void
    {
        $user = User::query()->findOrFail($userId);

        $visit->user()->associate($user);

        $visit->save();
    }
}
