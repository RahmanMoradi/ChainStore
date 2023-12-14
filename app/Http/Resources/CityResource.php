<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            "users" => $this->whenLoaded(
                "users",
                fn() => UserResource::collection($this->resource->users)
            ),
            "shops" => $this->whenLoaded(
                "shops",
                fn() => ShopResource::collection($this->resource->shops)
            )
        ];
    }
}
