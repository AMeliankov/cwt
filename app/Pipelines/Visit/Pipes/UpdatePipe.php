<?php

declare(strict_types=1);

namespace App\Pipelines\Visit\Pipes;

use App\Repositories\Visit\VisitRepositoryInterface;

final class UpdatePipe
{
    protected VisitRepositoryInterface $visitRepository;

    public function __construct(VisitRepositoryInterface $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $attributes = data_get($data, 'data.attributes');

        $visit = data_get($data, 'model');

        $this->visitRepository->update($visit, $attributes);

        return $next($data);
    }
}
