<?php

namespace App\Actions\City;

use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCityAction
{
    use AsAction;
    public function __construct(
        private readonly CityRepositoryInterface $repository
    )
    {
    }

    public function handle(array $payload): City
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
