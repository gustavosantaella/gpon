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
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion de permisos',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'procura de materiales',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'construccion de obra',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'certificacion oc',
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
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'creacion de reserva rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'atencion de reserva rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'obra civil y posteadura rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'tendido rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'empalme y peinado rl',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'pruebas y certificacion rl',
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
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'entrega del proyecto ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'contratacion del proyecto',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'replanteo ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'creacion de reserva ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'atencion de reserva ixx',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'obra civil y posteadura ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'tendido ix',
                'end_days' => 1,
                'field_type' => 'number',
            ],

            [
                'title' => 'empalme y fusion',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'pruebas y certifiacion',
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
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion de factibilidad',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'entrega del proyecto',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion del proyecto',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'construccion de spat',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'solicitud de corte electrico',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'aprobacion de corte electrico',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'construccion de acometida',
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
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'validacion de data de abonados',
                'end_days' => 1,
                'field_type' => 'number',
            ],
            [
                'title' => 'matriz de transferencia ia',
                'end_days' => 1,
                'field_type' => 'number',
            ],


        ];

        foreach ($con_task as $task) {
            $con->tasks()->create($task);
        }

    }
}
