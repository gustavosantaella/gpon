<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();
        $data = [
            ['name' => 'REGION CAPITAL', 'code' => 100],
            ['name' => 'REGION ORIENTAL', 'code' => 600],
            ['name' => 'REGION CENTRAL', 'code' => 1500],
            ['name' => 'REGION.C OCCIDENTE', 'code' => 1600],
            ['name' => 'REGION OCCIDENTE', 'code' => 1700],
            ['name' => 'REGION LOS ANDES', 'code' => 1800],
            ['name' => 'GUAYANA', 'code' => 2000    ],
        ];

        foreach($data as $i){
            Region::create($i);
        }
    }
}
