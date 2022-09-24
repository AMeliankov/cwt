<?php

declare(strict_types=1);

namespace App\Pipelines\Visit;

use App\Pipelines\BasePipeline;
use App\Pipelines\Visit\Pipes\DestroyPipe;
use App\Pipelines\Visit\Pipes\UpdatePipe;
use App\Pipelines\Visit\Pipes\AssociateUserRelationshipPipe;
use App\Pipelines\Visit\Pipes\StorePipe;

class VisitPipeline extends BasePipeline
{
    protected array $storePipes = [
        StorePipe::class,
        AssociateUserRelationshipPipe::class
    ];

    protected array $updatePipes = [
        UpdatePipe::class,
        AssociateUserRelationshipPipe::class
    ];

    protected array $destroyPipes = [
        DestroyPipe::class
    ];
}
