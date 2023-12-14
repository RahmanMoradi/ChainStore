<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "user_id",
        "category_id",
        "name",
        "price",
        "quantity",
    ];

    protected $relations = [
        "category",
        "creator",
        "orders",
        "shops"
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, "order_items");
    }

    public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class , 'product_id' , 'id');
    }

    public function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class);
    }


    public function scopeMostBought(Builder $query)
    {
        $productId = OrderItem::query()
            ->orderByDesc("quantity")->limit(1)->first()->product_id;
        $query
            ->where("id", $productId);
    }

}
