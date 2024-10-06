<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'TNHH Liên doanh Stellapharm', 'country' => 'Việt Nam'],
            ['name' => ' Merck Sharp & Dohme', 'country' => 'Mỹ'],
            ['name' => 'NUCOS', 'country' => 'Nhật Bản'],
            ['name' => 'ALCON LABORATORIES, INC', 'country' => 'Thụy Sĩ'],

        ];

        foreach ($items as $item) {
            Brand::updateOrCreate($item);
        }
    }
}
