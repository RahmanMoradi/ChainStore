<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::all()->each(function (Order $order){
            $products = [];
            $product_ids = Product::all()->pluck("id");
            foreach ($product_ids as $product_id){
                $products[$product_id] = ["quantity"=> rand(10, 100)];
            }
            $order->products()->sync($products);
        });
    }
}
