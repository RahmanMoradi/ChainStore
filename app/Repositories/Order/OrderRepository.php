<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Order::class)
            ->allowedIncludes(["roles", "movies", "tickets"])
            ->allowedFilters([
                AllowedFilter::scope("most_sale"),
                AllowedFilter::scope("userx")
            ]);

    }
}
