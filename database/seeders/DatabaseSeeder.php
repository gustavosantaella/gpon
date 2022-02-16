<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	 $this->call(RoleAndPermissionSeeder::class);     
        $this->call(UserSeeder::class);
        $this->call(ManagementSeeder::class);
        $this->call(UserManagement::class);
        $this->call(TaskSeeder::class);
        }
}
