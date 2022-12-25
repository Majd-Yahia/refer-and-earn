<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => "Majd Yahia",
            'email' => 'majd.m4a4@gmail.com',
            'phone_number' => "796352547",
            'password' => 'password',
        ]);

        $user1->assignRole('admin');
    }
}
