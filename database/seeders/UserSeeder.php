<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Majd Yahia",
            'email' => 'majd.m4a4@gmail.com',
            'phone_number' => "796352547",
            'password' => bcrypt('password'),
        ]);
    }
}
