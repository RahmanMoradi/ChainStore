<?php

namespace App\Repositories\City;

use App\Models\City;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $city)
    {
        parent::__construct($city);
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(City::class)
            ->allowedIncludes(["roles", "movies", "tickets"])
            ->allowedFilters([
                AllowedFilter::scope("role"),
            ]);

    }
}
