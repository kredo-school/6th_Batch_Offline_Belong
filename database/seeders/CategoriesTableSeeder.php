<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Categoryモデルをインポート

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Play',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Watch and Learn',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Eat',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Others',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Categoryモデルを使用して挿入する
        Category::insert($categories); // Insert the lists of category to the categories table
    }
}
