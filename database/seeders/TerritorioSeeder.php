<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class TerritorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = database_path('sql/territorio.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
