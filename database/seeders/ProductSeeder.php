<?php

namespace Database\Seeders;

use App\Enums\CategoryEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodCategory = Category::where("name", CategoryEnum::FOOD)->first();
        $fruitCategory = Category::where("name", CategoryEnum::FRUIT)->first();
        $snackCategory = Category::where("name", CategoryEnum::SNACK)->first();
        $products = [
            "رب" => $foodCategory->id,
            "آبلیمو"=> $foodCategory->id,
            "ماست"=> $foodCategory->id,
            "نوشابه"=> $foodCategory->id,
            "پفک"=> $snackCategory->id,
            "چیپس"=> $snackCategory->id,
            "هندوانه"=> $fruitCategory->id,
        ];

        foreach ($products as $name => $categoryId){
            Product::factory()->create([
                "name"=> $name,
                "user_id" => 1,
                "category_id" => $categoryId
            ]);
        }
    }
}
