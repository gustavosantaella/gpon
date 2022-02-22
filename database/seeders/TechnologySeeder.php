<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Technology::create([
            'type' => 'GPON'
        ]);
        Technology::create([
            'type' => 'NODO'
        ]);
        Technology::create([
            'type' => 'MDU'
        ]);
    }
}
