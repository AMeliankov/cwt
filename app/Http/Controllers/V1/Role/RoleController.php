<?php

namespace App\Http\Controllers\V1\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Services\Entities\RoleService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class RoleController extends Controller
{
    public RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(): RoleCollection
    {
        return new RoleCollection($this->roleService->index());
    }

    public function show(int $id): RoleResource
    {
        return new RoleResource($this->roleService->show($id));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $role = $this->roleService->store($request);

        return (new RoleResource($role))
            ->response()
            ->header('Location', route('users.show', $role->id));
    }

    public function update(UpdateRequest $request, int $id): RoleResource
    {
        return new RoleResource($this->roleService->update($request, $id));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->roleService->destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
