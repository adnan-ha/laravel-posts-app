<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'adnan',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'is_admin' => true
        ]);

        User::create([
            'name' => 'samer',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1234'),
            'is_admin' => false
        ]);
    }
}
