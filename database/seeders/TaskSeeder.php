<?php

namespace Database\Seeders;

use App\Models\Taks;
use App\Models\Management;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::truncate();
        $oc =   Management::whereName('CONSTRUCCION INFRAESTRUCTURA')->first();
        $oc_task = [
            [
                'title' => 'solicitud de permiso',
                'description' => 'solicitud de permiso',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion de permisos',
                'description' => 'aprobacion de permisos',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'procura de materiales',
                'description' => 'procura de materiales',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'construccion de obra',
                'description' => 'construccion de obra',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'certificacion oc',
                'description' => 'certificacion oc',
                'end_days' => 1,
                'field_type' => 'number',
            ],

        ];

        foreach ($oc_task as $task) {
            $oc->tasks()->create($task);
        }

        $rl =   Management::whereName('CONSTRUCCION RED LOCAL')->first();
        $rl_task = [
            [
                'title' => 'replanteo rl',
                'description' => 'replanteo rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'creacion de reserva rl',
                'description' => 'creacion de reserva rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'atencion de reserva rl',
                'description' => 'atencion de reserva rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'obra civil y posteadura rl',
                'description' => 'obra civil y posteadura rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'tendido rl',
                'description' => 'tendido rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'empalme y peinado rl',
                'description' => 'empalme y peinado rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'pruebas y certificacion rl',
                'description' => 'pruebas y certificacion rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],

        ];

        foreach ($rl_task as $task) {
            $rl->tasks()->create($task);
        }

        $ix =   Management::whereName('CONSTRUCCION FIBRA OPTICA')->first();
        $ix_task = [
            [
                'title' => 'solicitud de ix',
                'description' => 'solicitud de ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'entrega del proyecto ix',
                'description' => 'entrega del proyecto ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'contratacion del proyecto',
                'description' => 'contratacion del proyecto',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'replanteo ix',
                'description' => 'replanteo ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'creacion de reserva ix',
                'description' => 'creacion de reserva ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'atencion de reserva ixx',
                'description' => 'atencion de reserva ixx',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'obra civil y posteadura ix',
                'description' => 'obra civil y posteadura ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'tendido ix',
                'description' => 'tendido ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],

            [
                'title' => 'empalme y fusion',
                'description' => 'empalme y fusion',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'pruebas y certifiacion',
                'description' => 'pruebas y certifiacion',
                'end_days' => 1,
                'field_type' => 'number',
            ],

        ];

        foreach ($ix_task as $task) {
            $ix->tasks()->create($task);
        }

        $ex =   Management::whereName('CONSTRUCCION ENERGIA')->first();
        $ex_task = [
            [
                'title' => 'solicitud de factibilidad',
                'description' => 'solicitud de factibilidad',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion de factibilidad',
                'description' => 'aprobacion de factibilidad',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'entrega del proyecto',
                'description' => 'entrega del proyecto',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion del proyecto',
                'description' => 'aprobacion del proyecto',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'construccion de spat',
                'description' => 'construccion de spat',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'solicitud de corte electrico',
                'description' => 'solicitud de corte electrico',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion de corte electrico',
                'description' => 'aprobacion de corte electrico',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'construccion de acometida',
                'description' => 'construccion de acometida',
                'end_days' => 1,
                'field_type' => 'number',
            ],


        ];

        foreach ($ex_task as $task) {
            $ex->tasks()->create($task);
        }

        $con =   Management::whereName('CONMUTACION')->first();
        $con_task = [
            [
                'title' => 'solicitud de data e abonados',
                'description' => 'solicitud de data e abonados',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'validacion de data de abonados',
                'description' => 'validacion de data de abonados',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'matriz de transferencia ia',
                'description' => 'matriz de transferencia ia',
                'end_days' => 1,
                'field_type' => 'number',
            ],


        ];

        foreach ($con_task as $task) {
            $con->tasks()->create($task);
        }

    }
}
