<?php

declare(strict_types=1);

namespace App\Pipelines\Visit\Pipes;

use App\Repositories\Visit\VisitRepositoryInterface;

final class StorePipe
{
    protected VisitRepositoryInterface $visitRepository;

    public function __construct(VisitRepositoryInterface $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $attributes = data_get($data, 'data.attributes');

        $visit = $this->visitRepository->store($attributes);

        $data = data_set($data, 'model', $visit);

        return $next($data);
    }
}
