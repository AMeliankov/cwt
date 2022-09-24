<?php

declare(strict_types=1);

namespace App\Console\Commands\Spec;

use App\Services\OpenApi\BundlerService;
use Illuminate\Console\Command;

final class OpenApiBuildCommand extends Command
{
    protected $signature = 'openapi-build';

    protected $description = 'Collects dock totals from sources in the spec/folder in .yaml format';

    public function handle(BundlerService $bundlerService): void
    {
        $fileName = $bundlerService->build();

        $this->info('Final documentation file ' . $fileName . ' successfully build!');
    }
}
