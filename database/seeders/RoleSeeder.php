<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);

        Permission::create(['name' => 'admin.general','description' => 'General'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.listado','description' => 'Roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.camioneta','description' => 'Camioneta'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.habitaciones','description' => 'Habitaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.terceros','description' => 'Terceros'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.personal','description' => 'Personal'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.usuarios','description' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tareas','description' => 'Tareas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.reportes','description' => 'Reportes'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.operaciones','description' => 'Operaciones'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'admin.gastosfijos','description' => 'Gastos Fijos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rrhh','description' => 'RR.HH'])->syncRoles([$role1]);
    }
}
 