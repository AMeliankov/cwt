<?php

declare(strict_types=1);

namespace App\Services\Entities;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Pipelines\User\UserPipeline;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class UserService
{
    private UserRepositoryInterface $userRepository;
    private UserPipeline $userPipeline;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPipeline $userPipeline
    ) {
        $this->userRepository = $userRepository;
        $this->userPipeline = $userPipeline;
    }

    public function index(): Collection
    {
        return $this->userRepository->index();
    }

    public function show(int $id): Model
    {
        return $this->userRepository->show($id);
    }

    public function store(StoreRequest $request): Model
    {
        $data = $request->validated();

        return $this->userPipeline->store($data);
    }

    public function update(UpdateRequest $request, int $id): Model
    {
        $data = $request->validated();

        data_set($data, 'model', User::findOrFail($id));

        return $this->userPipeline->update($data);
    }

    public function destroy(int $id): bool
    {
        $data = [];

        data_set($data, 'model', User::findOrFail($id));

        return $this->userPipeline->destroy($data);
    }
}
