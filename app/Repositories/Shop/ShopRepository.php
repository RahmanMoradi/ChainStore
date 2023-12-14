<?php

namespace App\Repositories\Shop;

use App\Models\Shop;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{
    public function __construct(Shop $shop)
    {
        parent::__construct($shop);
    }

    public function query(array $payload = []): QueryBuilder|Builder
    {
        return QueryBuilder::for(Shop::class)
            ->allowedIncludes(["products", "orders", "city"])
            ->allowedFilters([
                AllowedFilter::scope("most_sale")
            ]);

    }
}
