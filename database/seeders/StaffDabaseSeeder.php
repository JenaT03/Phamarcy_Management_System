<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffDabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['code' => '0978', 'name' => 'Trần Yến Nhi', 'phone' => '0934567897', 'birth' => '2003', 'gender' => 'Nữ', 'address' => 'Trà Vinh'],

        ];

        foreach ($items as $item) {
            Staff::updateOrCreate($item);
        }
    }
}
