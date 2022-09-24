<?php

declare(strict_types=1);

return [
    [
        'interface' => \App\Repositories\User\UserRepositoryInterface::class,
        'implementation' => \App\Repositories\User\EloquentUserRepository::class
    ],
    [
        'interface' => \App\Repositories\Visit\VisitRepositoryInterface::class,
        'implementation' => \App\Repositories\Visit\EloquentVisitRepository::class
    ],
    [
        'interface' => \App\Repositories\Role\RoleRepositoryInterface::class,
        'implementation' => \App\Repositories\Role\EloquentRoleRepository::class
    ]
];
