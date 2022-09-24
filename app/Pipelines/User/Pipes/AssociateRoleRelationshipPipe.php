<?php

declare(strict_types=1);

namespace App\Pipelines\User\Pipes;

use App\Repositories\User\UserRepositoryInterface;

final class AssociateRoleRelationshipPipe
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $roleId = (int)data_get($data, 'data.relationships.role.data.id');

        if ($roleId) {
            $user = data_get($data, 'model');
            $this->userRepository->associateRole($user, $roleId);
        }

        return $next($data);
    }
}
