<?php

declare(strict_types=1);

namespace App\Repositories\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function index(): Collection;

    public function show(int $id): Model;

    public function store(array $attributes): Model;

    public function update(Role $role, array $attributes): Model;

    public function destroy(Role $role): bool;
}
