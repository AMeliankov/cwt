<?php

declare(strict_types=1);

namespace App\Pipelines\Role\Pipes;

use App\Repositories\Role\RoleRepositoryInterface;

final class StorePipe
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $attributes = data_get($data, 'data.attributes');

        $user = $this->userRepository->store($attributes);

        $data = data_set($data, 'model', $user);

        return $next($data);
    }
}
