<?php

namespace App\Repositories\Product;

use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function query(array $payload = []): QueryBuilder|Builder
    {
        return QueryBuilder::for(Product::class)
            ->allowedIncludes(["category", "shops", "creator", "orderItems", "orders"])
            ->allowedFilters([
                AllowedFilter::scope("most_bought")
            ]);
    }
}
