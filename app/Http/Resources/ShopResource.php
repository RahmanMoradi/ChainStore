<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            "address" => $this->resource->address,
            "city" => $this->whenLoaded(
                "city",
                fn() => CityResource::make($this->resource->city)
            ),
            "orders" => $this->whenLoaded(
                "orders",
                fn() => OrderResource::make($this->resource->orders)
            )
        ];
    }
}
