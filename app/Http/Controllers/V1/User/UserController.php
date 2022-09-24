<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\Entities\UserService;
use Symfony\Component\HttpFoundation\Response;

final class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): UserCollection
    {
        return new UserCollection($this->userService->index());
    }

    public function show(int $id): UserResource
    {
        return new UserResource($this->userService->show($id));
    }

    public function store(StoreRequest $request): Response
    {
        $user = $this->userService->store($request)->withoutRelations();

        return (new UserResource($user))
            ->response()
            ->withHeaders([
                'Location' => route('users.show', ['id' => $user->id])
            ]);
    }

    public function update(UpdateRequest $request, int $id): UserResource
    {
        return new UserResource($this->userService->update($request, $id));
    }

    public function destroy(int $id): Response
    {
        $this->userService->destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
