<?php

declare(strict_types=1);

namespace App\Pipelines\Role;

use App\Pipelines\BasePipeline;
use App\Pipelines\Role\Pipes\PrepareRelationsPipe;
use App\Pipelines\Role\Pipes\DestroyPipe;
use App\Pipelines\Role\Pipes\PreparePasswordPipe;
use App\Pipelines\Role\Pipes\StorePipe;
use App\Pipelines\Role\Pipes\UpdatePipe;

class RolePipeline extends BasePipeline
{
    protected array $storePipes = [
        PreparePasswordPipe::class,
        StorePipe::class
    ];

    protected array $updatePipes = [
        PrepareRelationsPipe::class,
        PreparePasswordPipe::class,
        UpdatePipe::class
    ];

    protected array $destroyPipes = [
        DestroyPipe::class
    ];
}
