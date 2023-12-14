<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(1)->create([
            "name" => "food"
        ]);
        Category::factory(1)->create([
            "name" => "fruit"
        ]);
        Category::factory(1)->create([
            "name" => "snack"
        ]);
    }
}
