<?php

declare(strict_types=1);

namespace App\Pipelines\User\Pipes;

use App\Repositories\User\UserRepositoryInterface;

final class StorePipe
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $attributes = data_get($data, 'data.attributes');

        $user = $this->userRepository->store($attributes);

        $data = data_set($data, 'model', $user);

        return $next($data);
    }
}
