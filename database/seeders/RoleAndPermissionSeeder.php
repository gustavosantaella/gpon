<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Role,
    Permission,
    User
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
Permission::truncate();
Role::truncate();
        $permissionArray =
            [
                 [
                    'name' => 'acceso al sistema',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
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
                ],
                 [
                    'name' => 'crear requerimiento',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                 [
                    'name' => 'editar requerimiento',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                 [
                    'name' => 'ver requerimiento',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                  [
                    'name' => 'aprobar requirimiento',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                  [
                    'name' => 'solicitar requerimiento',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                  [
                    'name' => 'eliminar requerimiento',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                  [
                    'name' => 'aprobar respuesta',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                  [
                    'name' => 'reprobar respuesta',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                 [
                    'name' => 'editar construccion',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                 [
                    'name' => 'eliminar construccion',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'crear construccion',
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

        $role1->permissions()->attach($permissionId);
        User::whereEmail('GSANTA01@CANTV.COM.VE')->first()->assignRole($role1);

        $role2 = Role::create([
            'name' => 'consultor',
            'guard_name' => 'web',
        ]);


    }

}
