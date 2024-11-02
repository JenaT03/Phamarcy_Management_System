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
            ['name' => 'TNHH Liên doanh Stellapharm', 'country' => 'Việt Nam', 'img' => 'logo-brand1.png', 'highlight' => true],
            ['name' => ' Merck Sharp & Dohme', 'country' => 'Mỹ', 'img' => 'logo-brand2.png', 'highlight' => true],
            ['name' => 'NUCOS', 'country' => 'Nhật Bản', 'img' => 'logo-brand3.png', 'highlight' => true],
            ['name' => 'ALCON LABORATORIES, INC', 'country' => 'Thụy Sĩ', 'img' => 'logo-brand4.png', 'highlight' => true],

        ];

        foreach ($items as $item) {
            Brand::updateOrCreate($item);
        }
    }
}
