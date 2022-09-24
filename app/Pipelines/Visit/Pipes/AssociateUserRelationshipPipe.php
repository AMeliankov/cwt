<?php

declare(strict_types=1);

namespace App\Pipelines\Visit\Pipes;

use App\Repositories\Visit\VisitRepositoryInterface;

final class AssociateUserRelationshipPipe
{
    protected VisitRepositoryInterface $visitRepository;

    public function __construct(VisitRepositoryInterface $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function handle(array $data, \Closure $next)
    {
        $userId = (int)data_get($data, 'data.relationships.user.data.id');

        if ($userId) {
            $visit = data_get($data, 'model');
            $this->visitRepository->associateUser($visit, $userId);
        }

        return $next($data);
    }
}
