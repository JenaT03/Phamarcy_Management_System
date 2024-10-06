<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['phone' => '0934567897', 'password' => '12345678'],
            ['phone' => '0334509797', 'password' => '12345678'],
            ['phone' => '0333987897', 'password' => '12345678'],
            ['phone' => '03678567897', 'password' => '12345678'],
            ['phone' => '0934567897', 'password' => '12345678'],
            ['phone' => '0934667897', 'password' => '12345678'],
            ['phone' => '0339967897', 'password' => '12345678'],
            ['phone' => '0939967896', 'password' => '12345678'],
        ];

        foreach ($items as $item) {
            User::updateOrCreate($item);
        }
    }
}
