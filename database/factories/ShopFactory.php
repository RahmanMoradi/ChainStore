<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "city_id" => City::factory(),
            "number" => fake()->unique()->numberBetween(1, 1000),
            "name" => fake()->name(),
            "address" => fake()->address(),
        ];
    }
}
