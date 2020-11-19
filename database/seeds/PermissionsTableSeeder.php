<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permisos_administrador = [];

      $role_administrador = Role::create(['name' => 'Administrador']);

      $permisos_administrador[] = Permission::create(['name' => 'agregar_usuario']);
      $permisos_administrador[] = Permission::create(['name' => 'editar_usuario']);
      $permisos_administrador[] = Permission::create(['name' => 'remover_usuario']);

      $role_administrador->syncPermissions($permisos_administrador);
    }
}
