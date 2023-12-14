<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUser;
    use HasUuids, SoftDeletes;

    protected $fillable = [
        "user_id",
        "shop_id",
        "status",
        "total",
    ];

    protected $relations = [
        "user",
        "shop",
        "products",
        "orderItem",
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "order_item");
    }

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeMostSale(Builder $query, string $productName)
    {
        $orderId = OrderItem::query()
            ->whereHas("product", function (Builder $query) use ($productName) {
                $query->where("name", $productName);
            })->orderByDesc("quantity")->limit(1)->first()->order->id;

        return $query
            ->with("orderItem", function ($query) use ($productName) {
                $query->whereHas("product", function ($query) use ($productName) {
                    $query->where("name", $productName);
                });
            })
            ->where("id", $orderId);
    }

}

