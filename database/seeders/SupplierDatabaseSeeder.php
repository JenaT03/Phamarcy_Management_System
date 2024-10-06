<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Hồng Thanh', 'address' => 'Hồ Chí Minh', 'phone' => '0398739848'],
            ['name' => 'TNT', 'address' => 'Đà Nẵng', 'phone' => '039476584930'],
            ['name' => 'CCHa', 'address' => 'Cần Thơ', 'phone' => '0283741094'],
            ['name' => 'FCD', 'address' => 'Hà Nội', 'phone' => '0384910938'],
        ];

        foreach ($items as $item) {
            Supplier::updateOrCreate($item);
        }
    }
}
