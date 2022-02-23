<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserManagement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $gustavo = User::whereEmail("gsanta01@cantv.com.ve")->first();
        $erika = User::whereEmail("eorti1@cantv.com.ve")->first();
        $alexis = User::whereEmail("amarca02@cantv.com.ve")->first();
        $andres = User::whereEmail("asobcz01@cantv.com.ve")->first();


        // $gustavo->management()->sync(6);
        // $erika->management()->sync(7);
        // $alexis->management()->sync(8);
        // $andres->management()->sync(10);


    }
}
