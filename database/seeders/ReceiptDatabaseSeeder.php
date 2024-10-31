<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['datetime' => Carbon::now(), 'staff_id' => 1, 'supplier_id' => '1', 'total' => 3500000],

        ];

        foreach ($items as $item) {
            Receipt::updateOrCreate($item);
        }
    }
}
