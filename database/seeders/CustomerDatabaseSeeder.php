<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            ['name' => 'Phạm Thị Lan Anh', 'phone' => '0934567897', 'birth' => '2000', 'gender' => 'Nữ'],
            ['name' => 'Phạm Thị Lan', 'phone' => '0334509797', 'birth' => '2001', 'gender' => 'Nữ'],
            ['name' => 'Lý Anh', 'phone' => '0333987897', 'birth' => '1990', 'gender' => 'Nam'],
            ['name' => 'Lê Anh Tuấn', 'phone' => '03678567897', 'birth' => '1999', 'gender' => 'Nam'],
            ['name' => 'Nguyễn Gia Kiệt', 'phone' => '0934567897', 'birth' => '1996', 'gender' => 'Nam'],
            ['name' => 'Phạm Thanh Ngân', 'phone' => '0934667897', 'birth' => '1994', 'gender' => 'Nữ'],
            ['name' => 'Trần Thanh Thanh', 'phone' => '0339967897', 'birth' => '2002', 'gender' => 'Nữ'],
            ['name' => 'Mã Quốc Cường', 'phone' => '0939967896', 'birth' => '1995', 'gender' => 'Nam'],
        ];

        foreach ($items as $item) {
            Customer::updateOrCreate($item);
        }
    }
}
