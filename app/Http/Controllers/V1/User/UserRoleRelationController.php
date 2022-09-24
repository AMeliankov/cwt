<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Services\Entities\UserService;

class UserRoleRelationController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(int $id): RoleResource
    {
        $user = $this->userService->show($id);

        return new RoleResource($user->role);
    }
}
