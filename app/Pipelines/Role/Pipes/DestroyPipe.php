<?php

declare(strict_types=1);

namespace App\Pipelines\Role\Pipes;

use App\Repositories\Role\RoleRepositoryInterface;

final class DestroyPipe
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $user = data_get($data, 'model');

        $this->roleRepository->destroy($user);

        return $next($data);
    }
}

