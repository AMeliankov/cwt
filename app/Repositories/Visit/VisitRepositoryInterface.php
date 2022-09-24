<?php

declare(strict_types=1);

namespace App\Repositories\Visit;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface VisitRepositoryInterface
{
    public function index(): Collection;

    public function show(int $id): Model;

    public function store(array $attributes): Model;

    public function update(Visit $visit, array $attributes): Model;

    public function destroy(Visit $visit): bool;

    public function associateUser(Visit $visit, int $userId): void;
}
