<?php

declare(strict_types=1);

namespace App\Pipelines\Visit\Pipes;

use App\Repositories\Visit\VisitRepositoryInterface;

final class DestroyPipe
{
    protected VisitRepositoryInterface $visitRepository;

    public function __construct(VisitRepositoryInterface $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $visit = data_get($data, 'model');

        $this->visitRepository->destroy($visit);

        return $next($data);
    }
}

