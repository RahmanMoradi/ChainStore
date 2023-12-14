<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "product" => ProductResource::make($this->resource->product),
            "order" => OrderResource::make($this->resource->order),
            "quantity" => $this->resource->quantity,
            "price" => $this->resource->price,
        ];
    }
}
