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
            'email' => 'admin@gmail.com.ar',
            'password' => bcrypt('123456'),

        ])->assignRole('admin');
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
            'name' => 'Angelo',
            'email' => 'ale_73011@hotmail.com',
            'password' => bcrypt('pilar330'),
        ])->assignRole('chofer');
    }
}
