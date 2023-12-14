<?php

namespace App\Models;

use App\Traits\HasCity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory, HasUuids, HasCity;

    protected $fillable = [
        "city_id",
        "number",
        "name",
        "address",
    ];

    protected $relations = [
        "city",
        "orders",
        "products"
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeMostSale(Builder $query)
    {
        $shop = $query
            ->withSum("orders", "total")
            ->orderByDesc("orders_sum_total")
            ->limit(1)
            ->first();

        return $query->where("id", $shop->id);

    }

}
