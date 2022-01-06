<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taks;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
    }
}
