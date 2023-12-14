<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::factory(5)->create([
            "city_id" => City::all()->random()->id,
        ]);
    }
}
