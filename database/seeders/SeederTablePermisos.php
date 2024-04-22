<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            'ver-viajes',
            'crear-viajes',
            'editar-viajes',
            'eliminar-viajes',
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'ver-zonas',
            'crear-zonas',
            'editar-zonas',
            'eliminar-zonas',

        ];
        foreach ($permisos as $permiso) {
           Permission::create(['name' => $permiso]);
        }

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $role2 = Role::create(['name' => 'chofer']);
        $role2->givePermissionTo(['ver-viajes', 'crear-viajes']);


    }
}

