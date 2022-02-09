<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gustavo = User::create([
        'name'=>'gustavo santaella',
        'email'=>'gsanta01@cantv.com.ve',
        'password'=> Hash::make('password')
                ]);

         $user = User::create([
        'name'=>'erika ortiz',
        'email'=>'eorti1@cantv.com.ve',
        'password'=> Hash::make('password')
                ]);

              $user = User::create([
        'name'=>'alexis marcano',
        'email'=>'amarca02@cantv.com.ve',
        'password'=> Hash::make('password')
                ]);

                 $user = User::create([
        'name'=>'andres sobczack',
        'email'=>'asobcz01@cantv.com.ve',
        'password'=> Hash::make('password')
                ]);

        User::factory(10)->create();

        $

        $gustavo->assignRole('SUPER USUARIO');
        // $user->management()->sync();
    }
}
