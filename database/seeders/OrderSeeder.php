<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(20)->create([
            "user_id" => User::all()->random()->id,
            "shop_id" => Shop::all()->random()->id,
        ]);
    }
}
