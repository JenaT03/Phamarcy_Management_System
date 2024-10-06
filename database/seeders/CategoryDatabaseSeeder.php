<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Thuốc'],
            ['name' => 'Thực phẩm chức năng'],
            ['name' => 'Mỹ phẩm'],
            ['name' => 'Thiết bị y tế'],
            ['name' => 'Mẹ và bé'],

        ];

        foreach ($items as $item) {
            Category::updateOrCreate($item);
        }
    }
}
