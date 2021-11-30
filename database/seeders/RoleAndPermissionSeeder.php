<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Role,
    Permission
};


class RoleAndPermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


// permissions
        $permissionArray =
            [
                [
                    'name' => 'Crear gernecias',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'Editar gernecias',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'Eliminar gernecias',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'Crear usuarios',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'Eliminar usuarios',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'editar usuarios',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'consultar usuarios',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'editar configuraciones',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
        $permissionId = [];
        foreach ($permissionArray as $data):
            $permission = Permission::create($data);
            $permissionId[] = $permission->id;
        endforeach;

// roles
        $role1 = Role::create([
            'name' => 'super usuario',
            'guard_name' => 'web',
        ]);

        $role1->syncPermissions($permissionId);

        $role2 = Role::create([
            'name' => 'consultor',
            'guard_name' => 'web',
        ]);


    }

}
