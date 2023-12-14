<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "uuid" => $this->resource->uuid,
            "name" => $this->resource->name,
            "price" => $this->resource->price,
            "inventory" => $this->resource->inventory,
            "category" => $this->whenLoaded(
                "category",
                fn() => CategoryResource::make($this->resource->category)
            ),
            "orders" => $this->whenLoaded(
                "orders",
                fn() => OrderResource::collection($this->resource->orders)
            ),
        ];
    }
}
