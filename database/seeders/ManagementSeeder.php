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
        Management::create([
            'name'=>'planificaciones',
            'acronym'=>'pcc',
            'position'=>1,
        ]);

        Management::create([
            'name'=>'fibra optica',
            'acronym'=>'fo',
            'position'=>2,
        ]);

        Management::create([
            'name'=>'red local',
            'acronym'=>'rl',
            'position'=>3,
        ]);

        Management::create([
            'name'=>'energia',
            'acronym'=>'em',
            'position'=>4,
        ]);

        Management::create([
            'name'=>'infraestructura',
            'acronym'=>'if',
            'position'=>5,
        ]);

         Management::create([
            'name'=>'construccion infraestructura',
            'acronym'=>'cif',
            'position'=>6,
            'construction'=>true
        ]);

        Management::create([
            'name'=>'construccion fibra optica',
            'acronym'=>'cfo',
            'position'=>7,
            'construction'=>true
        ]);

         Management::create([
            'name'=>'construccion red local',
            'acronym'=>'crl',
            'position'=>8,
            'construction'=>true
        ]);

         Management::create([
            'name'=>'construccion energia',
            'acronym'=>'ceg',
            'position'=>9,
            'construction'=>true
        ]);

          Management::create([
            'name'=>'implementacion',
            'acronym'=>'imp',
            'position'=>10,
            'construction'=>true
        ]);


    }
}
