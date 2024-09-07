<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name"=> "anik",
            "email"=> "anik@gmail.com",
            "gender"=> "male",
            "phone"=> "01745994450",
            "password"=> Hash::make("123"),
        ]);

        $user->roles()->attach(2);

        $secondUser = User::create([
            "name"=> "Habib",
            "email"=> "habib@gmail.com",
            "gender"=> "male",
            "phone"=> "01933156566",
            "password"=> Hash::make("123"),
        ]);
        $secondUser->roles()->attach(1);
    }
}
