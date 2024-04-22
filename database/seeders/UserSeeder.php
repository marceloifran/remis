<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),

        ])->assignRole('admin');
        User::create([
            'name' => 'chofer',
            'email' => 'chofer@gmail.com',
            'password' => bcrypt('1234'),
        ])->assignRole('chofer');
        User::create([
            'name' => 'chofer 2',
            'email' => 'chofer2@gmail.com',
            'password' => bcrypt('1234'),
        ])->assignRole('chofer');
    }
}
