<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Visit\VisitCollection;
use App\Services\Entities\UserService;

class UserVisitsRelationController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(int $id): VisitCollection
    {
        $user = $this->userService->show($id);

        return new VisitCollection($user->visits);
    }
}
