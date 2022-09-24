<?php

declare(strict_types=1);

namespace App\Pipelines\User\Pipes;

use App\Repositories\User\UserRepositoryInterface;

final class UpdatePipe
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $attributes = data_get($data, 'data.attributes');

        $user = data_get($data, 'model');

        $this->userRepository->update($user, $attributes);

        return $next($data);
    }
}
