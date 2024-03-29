<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "shop_id" => Shop::factory(),
            "status" => OrderStatusEnum::PENDING,
            "total" => rand(100_000, 1_000_000),
        ];
    }
}
