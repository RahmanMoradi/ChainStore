<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "uuid"=> $this->resource->uuid,
            "status"=> $this->resource->status,
            "total" => $this->resource->total,
            "user"=> $this->whenLoaded(
                "user",
                fn() => UserResource::make($this->resource->user),
                $this->resource->user_id
            ),
            "orderItem"=> $this->whenLoaded(
                "orderItem",
                fn() => OrderItemResource::collection($this->resource->orderItem)
            )
        ];
    }
}
