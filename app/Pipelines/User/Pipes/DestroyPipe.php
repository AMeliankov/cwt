<?php

declare(strict_types=1);

namespace App\Pipelines\User\Pipes;

use App\Repositories\User\UserRepositoryInterface;

final class DestroyPipe
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $user = data_get($data, 'model');

        $this->userRepository->destroy($user);

        return $next($data);
    }
}

