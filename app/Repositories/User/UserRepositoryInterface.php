<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function index(): Collection;

    public function show(int $id): Model;

    public function store(array $attributes): Model;

    public function update(User $user, array $attributes): Model;

    public function destroy(User $user): bool;

    public function associateRole(User $user, int $roleId): void;
}
