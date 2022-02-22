<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Management;
class ManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Management::truncate();
        // Management::factory(400)->create();
        // Management::create([
        //     'name'=>'planificaciones',
        //     'position'=>1,
        // ]);

        // Management::create([
        //     'name'=>'fibra optica',
        //     'position'=>2,
        // ]);

        // Management::create([
        //     'name'=>'red local',
        //     'position'=>3,
        // ]);

        // Management::create([
        //     'name'=>'energia',
        //     'position'=>4,
        // ]);

        // Management::create([
        //     'name'=>'infraestructura',
        //     'position'=>5,
        // ]);

         Management::create([
            'name'=>'construccion infraestructura',
	    'position'=>6,
	    'porcent'=>20,
            'construction'=>true
        ]);

        Management::create([
            'name'=>'construccion fibra optica',
	    'position'=>7,
	    'porcent'=>20,
            'construction'=>true
        ]);

         Management::create([
            'name'=>'construccion red local',
	    'position'=>8,
	    'porcent'=>20,
            'construction'=>true
        ]);

         Management::create([
            'name'=>'construccion energia',
	    'position'=>9,
	    'porcent'=>15,
            'construction'=>true
        ]);

          Management::create([
            'name'=>'conmutacion',
	    'porcent'=>5,
            'position'=>20,
            'construction'=>true
        ]);


    }
}
