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
            ['staff_number' => '0978', 'name' => 'Trần Yến Nhi', 'phone' => '0934567897', 'birth' => '2003', 'gender' => 'Nữ', 'address' => 'Trà Vinh'],
            ['staff_number' => '2366', 'name' => 'Lê Thanh Tú', 'phone' => '0930067822', 'birth' => '2001', 'gender' => 'Nữ', 'address' => 'Cần Thơ'],
            ['staff_number' => '0476', 'name' => 'Nguyễn Minh Dũng', 'phone' => '0334567986', 'birth' => '2002', 'gender' => 'Nam', 'address' => 'Cần Thơ'],

        ];

        foreach ($items as $item) {
            Staff::updateOrCreate($item);
        }
    }
}
