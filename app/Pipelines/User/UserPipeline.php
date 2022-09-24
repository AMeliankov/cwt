<?php

declare(strict_types=1);

namespace App\Pipelines\User;

use App\Pipelines\BasePipeline;
use App\Pipelines\User\Pipes\DestroyPipe;
use App\Pipelines\User\Pipes\PreparePasswordPipe;
use App\Pipelines\User\Pipes\AssociateRoleRelationshipPipe;
use App\Pipelines\User\Pipes\StorePipe;
use App\Pipelines\User\Pipes\UpdatePipe;

class UserPipeline extends BasePipeline
{
    protected array $storePipes = [
        PreparePasswordPipe::class,
        StorePipe::class,
        AssociateRoleRelationshipPipe::class
    ];

    protected array $updatePipes = [
        PreparePasswordPipe::class,
        UpdatePipe::class,
        AssociateRoleRelationshipPipe::class
    ];

    protected array $destroyPipes = [
        DestroyPipe::class
    ];
}
