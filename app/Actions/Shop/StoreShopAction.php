<?php

namespace App\Actions\Shop;

use App\Models\Shop;
use App\Repositories\Shop\ShopRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreShopAction
{
    use AsAction;
    public function __construct(
        private readonly ShopRepositoryInterface $repository
    )
    {
    }

    public function handle(array $payload): Shop
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
