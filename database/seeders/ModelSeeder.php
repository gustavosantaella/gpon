<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Model;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::factory(100)->create();
    }
}
