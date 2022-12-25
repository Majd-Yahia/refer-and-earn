<?php

namespace Database\Seeders;

use App\Models\Referal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'majd.m4a4@gmail.com')->first();
        request()->referal_code = $admin->code;

        for ($i=0; $i < 25; $i++) {
            User::create([
                'name' => 'Test ' . $i,
                'email' => 'test'. $i . '@test.com',
                'phone_number' => '962796' . $i . '3114' . $i,
                'password' => 'password',
            ]);

            Referal::create([
                'user_id' => $admin->id,
                'ip' => '134.114.671.3'. $i,
            ]);
        }

    }
}
