<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::all()->each(function (Shop $shop){
            $products = [];
            $product_ids = Product::all()->pluck("id");
            foreach ($product_ids as $product_id){
                $products[$product_id] = ["quantity"=> rand(10, 100)];
            }
            $shop->products()->sync($products);
        });
    }
}
