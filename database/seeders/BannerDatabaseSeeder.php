<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['img' => 'banner1.png'],
            ['img' => 'banner2.png'],
            ['img' => 'banner3.png'],

        ];
        foreach ($items as $item) {
            Banner::updateOrCreate($item);
        }
    }
}
