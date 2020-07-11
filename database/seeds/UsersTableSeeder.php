<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jordan Antoni Sedano Huamán',
            'email' => 'yordan.arcangel@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'cellphone' => '939032042',
            'remember_token' => Str::random(10),
        ]);
    }
}
