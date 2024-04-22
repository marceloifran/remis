<?php

namespace Database\Seeders;

use App\Models\zonas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class zonaseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        zonas::create([
            'nombre' => 'zona1',
            'zona' => 'zona1',
            'precio' => 100

        ]);
        zonas::create([
            'nombre' => 'zona2',
            'zona' => 'zona2',
            'precio' => 200
        ]);

        zonas::create([
            'nombre' => 'zona3',
            'zona' => 'zona3',
            'precio' => 300
        ]);
    }
}
