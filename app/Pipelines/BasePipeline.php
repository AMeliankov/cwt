<?php

declare(strict_types=1);

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BasePipeline
{
    protected Pipeline $pipeline;

    protected array $storePipes;

    protected array $updatePipes;

    protected array $destroyPipes;

    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    public function store(array $data): Model
    {
        try {
            DB::beginTransaction();

            $data = $this->pipeline
                ->send($data)
                ->through($this->storePipes)
                ->thenReturn();

            DB::commit();

            return data_get($data, 'model');

        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        throw new \Exception('Script processing error');
    }

    public function update(array $data): Model
    {
        try {
            DB::beginTransaction();

            $this->pipeline
                ->send($data)
                ->through($this->updatePipes)
                ->thenReturn();

            DB::commit();

            return data_get($data, 'model');

        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        throw new \Exception('Script processing error');
    }

    public function destroy(array $data): bool
    {
        try {
            DB::beginTransaction();

            $this->pipeline
                ->send($data)
                ->through($this->destroyPipes)
                ->thenReturn();

            DB::commit();

        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return true;
    }
}
