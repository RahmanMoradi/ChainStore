<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductAction
{
    use AsAction;
    public function __construct(
        private readonly ProductRepositoryInterface $repository
    )
    {
    }

    public function handle(array $payload): Product
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
