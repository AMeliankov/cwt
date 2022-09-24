<?php

declare(strict_types=1);

namespace App\Pipelines\User\Pipes;

use Illuminate\Support\Facades\Hash;

final class PreparePasswordPipe
{
    public function handle(array $data, \Closure $next)
    {
        $password = data_get($data, 'data.attributes.password');

        if (isset($password)) {
            $data = data_set($data, 'data.attributes.password', Hash::make($password));
        }

        return $next($data);
    }
}
