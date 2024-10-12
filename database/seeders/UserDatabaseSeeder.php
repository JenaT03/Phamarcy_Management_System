<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            ['phone' => '0934567897', 'password' => '0934567897', 'userable_id' => '1', 'userable_type' => Staff::class],
        ];

        foreach ($items as &$item) {
            $item['password'] = Hash::make($item['password']);
            $user = User::updateOrCreate($item);
            $user->roles()->attach('1');
        }
    }
}
